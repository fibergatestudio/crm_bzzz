<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\GoodParse;
use App\Good;
use App\GoodCategory;

class ParserController extends Controller
{
    public function goods()
    {
        $xml = file_get_contents('https://al-fakher.com.ua/sitemap.xml');
        $xmlData = explode('<url>', $xml);        
        $k = 0;
        foreach ($xmlData as $xmlSingle) {
            if (strpos($xmlSingle, '<priority>1.0</priority>') !== false) {
                $link = str_after($xmlSingle, '<loc>');
                $link = str_before($link, '</loc>');
                if (!empty($link)) {
                    ++$k;
                    $checkParse = GoodParse::where('link', $link)->first();
                    if (empty($checkParse->id)) {
                        $toParse = new GoodParse;
                        $toParse->link = $link;
                        $toParse->save();
                    }
                }
            }
        }
    }

    public function goodsSingle()
    {
        $good = GoodParse::where([
            ['parsed', 0],
            ['link', 'not like', '%index.php%']
        ])->first();
        if (!empty($good->id)) {
            $html = file_get_contents($good->link);
            $link = explode('/', $good->link);
            $link = end($link);
            $name = str_after($html, '<h1>');
            $name = str_before($name, '</h1>');
            $breadcrumb = str_after($html, '<div class="breadcrumb">');
            $breadcrumb = str_before($breadcrumb, '</div>');
            $breadcrumbs = explode('<b>&raquo;</b>', $breadcrumb);
            $categories = array();
            foreach ($breadcrumbs as $key => $breadcrumb) {
                if ($key != 0) {
                    $category = trim(strip_tags($breadcrumb));
                    if (!empty($category) && ($category != $name)) {
                        $categories[] = $category;
                    }
                }
            }
            $image = str_after($html, '<div class="main-img">');
            $image = str_after($image, '<a href="');
            $image = str_before($image, '"');
            var_dump($categories);
            var_dump($link);
            var_dump($name);
            var_dump($image);
            $good->slug = $link;
            $good->name = $name;
            $good->categories = '[' . implode('][', $categories) . ']';
            $good->image = $image;
            $good->parsed = 1;
            $good->save();
            //dd($html);
        }
    }

    public function goodsBase()
    {
        $good = GoodParse::where('parsed', 1)->first();
        if (!empty($good->id)) {
            $checkGood = Good::where('name', $good->name)->first();
            if (empty($checkGood->id)) {
                if (!empty($good->categories)) {
                    $categories = explode('][', $good->categories);
                    foreach ($categories as $category) {
                        $categoryName = str_replace(array('[', ']'), '', $category);
                        $checkCategory = GoodCategory::where([
                            ['name', $categoryName],
                            ['parent_id', (!empty($category_id) ? $category_id : 0)]
                        ])->first();
                        if (!empty($checkCategory->id)) {
                            $category_id = $checkCategory->id;
                        } else {
                            $newCategory = new GoodCategory;
                            $newCategory->parent_id = (!empty($category_id) ? $category_id : 0);
                            $newCategory->slug = str_slug($categoryName);
                            $newCategory->name = $categoryName;
                            $newCategory->save();
                            $category_id = $newCategory->id;
                        }
                    }
                }
                $newGood = new Good;
                $newGood->category_id = $category_id;
                $newGood->slug = $good->slug;
                $newGood->name = $good->name;
                $imageName = str_random(12);
                if (!empty($good->image) && (strpos($good->image, 'http') !== false)) {
                    $imageUrl = explode('/', $good->image);
                    $imageFullUrl = '';
                    foreach ($imageUrl as $imgUrl) {
                        if (!empty($imageFullUrl)) {
                            $imageFullUrl .= '/';
                        }                
                        $imageFullUrl .= urlencode($imgUrl);
                    }
                    $imageFullUrl = str_replace(array('%3A', '+'), array(':', '%20'), $imageFullUrl);
                    //dd($imageFullUrl);
                    $image = Image::make($imageFullUrl);
                    Storage::disk('public')->put('images/goods/' . $imageName . '.jpg', $image->encode('jpg', 100));
                    $image->fit(150, 150);
                    Storage::disk('public')->put('images/goods/' . $imageName . '_sm.jpg', $image->encode('jpg', 100));
                    $newGood->img = $imageName;                    
                }
                $newGood->save();
                $good->parsed = 2;
                $good->save();
            } else {
                $good->parsed = 2;
                $good->save();
            }
        }
    }
}
