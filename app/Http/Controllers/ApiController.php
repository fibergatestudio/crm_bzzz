<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use App\GoodCategory;
use App\SiteCategory;
use App\SiteGood;
use App\StockGood;
use App\Sites;
use App\Order;
use App\OrderGood;
use App\Client;

class ApiController extends Controller
{
    public function getCategories()
    {
        $categories = GoodCategory::orderBy('parent_id')->orderBy('name')->get();
        return response()->json($categories);
    }

    public function saveCategory(Request $request)
    {
        if (!empty($request->siteId) && is_numeric($request->siteId) && !empty($request->categoryId) && is_numeric($request->categoryId) && !empty($request->siteCategoryId) && is_numeric($request->siteCategoryId)) {
            $category = GoodCategory::where('id', $request->categoryId)->first();
            if (!empty($category->id)) {
                $checkCategory = SiteCategory::where([
                    ['site_id', $request->siteId],
                    ['category_id', $category->id]
                ])->first();
                if (!empty($checkCategory->id)) {
                    if ($checkCategory->site_category_id != $request->siteCategoryId) {
                        $checkCategory->site_category_id = $request->siteCategoryId;
                        $checkCategory->save();
                    }
                } else {
                    $siteCategory = new SiteCategory;
                    $siteCategory->site_id = $request->siteId;
                    $siteCategory->category_id = $request->categoryId;
                    $siteCategory->site_category_id = $request->siteCategoryId;
                    $siteCategory->save();
                }
            }
        }
    }

    public function getGoods()
    {
        $goodsToImport = array();
        $goods = Good::where('price', '>', 0)->get();
        foreach ($goods as $good) {
            $inStock = StockGood::where('good_id', $good->id)->sum('quantity');
            if (!empty($inStock)) {
                $goodsToImport[$good->id] = array('id' => $good->id, 'category_id' => $good->category_id, 'name' => $good->name, 'img' => $good->img, 'price' => $good->price, 'quantity' => $inStock);
            }
        }
        return response()->json($goodsToImport);
    }

    public function saveGood(Request $request)
    {
        if (!empty($request->siteId) && is_numeric($request->siteId) && !empty($request->goodId) && is_numeric($request->goodId) && !empty($request->siteGoodId) && is_numeric($request->siteGoodId)) {
            $good = Good::where('id', $request->goodId)->first();
            if (!empty($good->id)) {
                $checkGood = SiteGood::where([
                    ['site_id', $request->siteId],
                    ['good_id', $good->id]
                ])->first();
                if (!empty($checkGood->id)) {
                    if ($checkGood->site_good_id != $request->siteGoodId) {
                        $checkGood->site_good_id = $request->siteGoodId;
                        $checkGood->save();
                    }
                } else {
                    $siteGood = new SiteGood;
                    $siteGood->site_id = $request->siteId;
                    $siteGood->good_id = $request->goodId;
                    $siteGood->site_good_id = $request->siteGoodId;
                    $siteGood->save();
                }
            }
        }
    }

    public function getSiteCategories(Request $request)
    {
        $categories = SiteCategory::where('site_id', $request->id)->get();
        return response()->json($categories);
    }

    public function getOrders()
    {
        $sites = Sites::get();
        foreach ($sites as $site) {
            $lastOrder = Order::where('site_id', $site->id)->orderBy('site_order', 'desc')->first();
            if (empty($lastOrder->id)) {
                $lastOrderId = 0;
            } else {
                $lastOrderId = $lastOrder->id;
            }
            $orders = json_decode(file_get_contents($site->domain . '/crmsync.php?module=orders&lid=' . $lastOrderId));
            foreach ($orders as $order) {
                $checkOrder = Order::where([
                    ['site_id', $site->id],
                    ['site_order', $order->order_id]
                ])->first();
                if (empty($checkOrder->id)) {
                    $checkClient = Client::where('tel', $order->telephone)->first();
                    if (!empty($checkClient->id)) {
                        $client = $checkClient;
                    } else {
                        $client = new Client;
                        $client->tel = $order->telephone;
                        $client->email = $order->email;
                        $client->name = $order->firstname;
                        $client->save();
                    }
                    $newOrder = new Order;
                    $newOrder->site_id = $site->id;
                    $newOrder->client_id = $client->id;
                    $newOrder->site_order = $order->order_id;
                    $newOrder->save();
                    foreach ($order->goods as $good) {
                        $checkGood = SiteGood::where([
                            ['site_id', $site->id],
                            ['site_good_id', $good->product_id]
                        ])->first();
                        if (!empty($checkGood->id)) {
                            $originalGood = Good::find($checkGood->good_id);
                            $newOrderGood = new OrderGood;
                            $newOrderGood->order_id = $newOrder->id;
                            $newOrderGood->good_id = $originalGood->id;
                            $newOrderGood->quantity = $good->quantity;
                            $newOrderGood->price = $originalGood->price;
                            $newOrderGood->site_good_id = $good->product_id;
                            $newOrderGood->site_good_price = $good->price;
                            $newOrderGood->save();
                        }
                    }
                }
            }
        }
    }
}
