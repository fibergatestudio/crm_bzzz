<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Image;
use Storage;
use App\GoodCategory;
use App\Good;
use App\Provider;
use App\Stock;
use App\StockGood;
use App\Purchase;
use App\PurchaseGood;
use App\Sites;
use App\Order;
use App\Client;
use App\Currency;
use App\OrderGood;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function categories()
    {
        $categories = GoodCategory::orderBy('name')->get();
        return view('admin.categories', [
            'categories' => $categories
        ]);
    }

    public function categoriesCreate()
    {
        $categories = GoodCategory::orderBy('name')->get();
        return view('admin.forms.category', [
            'categories' => $categories
        ]);
    }

    public function categoriesEdit($id)
    {
        $category = GoodCategory::findOrFail($id);
        $categories = GoodCategory::orderBy('name')->get();
        return view('admin.forms.category', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function categoriesUpdate(Request $request)
    {
        if (empty($request->id)) {
            $category = new GoodCategory;
        } else {
            $category = GoodCategory::findOrFail($request->id);
        }
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('categories::edit', ['id' => $category->id])->with('status', '1');
    }

    public function goods()
    {
        $categories = GoodCategory::orderBy('name')->get()->keyBy('id');
        $goods = Good::orderBy('name')->paginate(50);
        return view('admin.goods', [
            'categories' => $categories,
            'goods' => $goods
        ]);
    }

    public function goodsCreate()
    {
        $categories = GoodCategory::orderBy('name')->get();
        return view('admin.forms.good', [
            'categories' => $categories
        ]);
    }

    public function goodsEdit($id)
    {
        $good = Good::findOrFail($id);
        $categories = GoodCategory::orderBy('name')->get();
        return view('admin.forms.good', [
            'good' => $good,
            'categories' => $categories
        ]);
    }

    public function goodsUpdate(Request $request)
    {
        if (empty($request->id)) {
            $good = new Good;
        } else {
            $good = Good::findOrFail($request->id);
        }
        $good->name = $request->name;
        $good->slug = str_slug($request->name);
        $good->category_id = $request->category_id;
        $good->weight = $request->weight;
        $good->price = str_replace(',', '.', $request->price);
        if (!empty($request->img)) {            
            $image = Image::make($request->img);
            if (empty($builder->img)) {
                $good->img = str_random(12);
            }
            Storage::disk('public')->put('images/goods/' . $good->img . '.jpg', $image->encode('jpg', 100));
            $image->fit(150, 150);
            Storage::disk('public')->put('images/goods/' . $good->img . '_sm.jpg', $image->encode('jpg', 100));
        }
        $good->save();
        return redirect()->route('goods::edit', ['id' => $good->id])->with('status', '1');
    }

    public function providers()
    {
        $providers = Provider::orderBy('name')->get();
        return view('admin.providers', [
            'providers' => $providers
        ]);
    }

    public function providersCreate()
    {
        return view('admin.forms.provider');
    }

    public function providersEdit($id)
    {
        $provider = Provider::findOrFail($id);
        return view('admin.forms.provider', [
            'provider' => $provider
        ]);
    }

    public function providersUpdate(Request $request)
    {
        if (empty($request->id)) {
            $provider = new Provider;
        } else {
            $provider = Provider::findOrFail($request->id);
        }
        $provider->name = $request->name;
        $provider->save();
        return redirect()->route('providers::edit', ['id' => $provider->id])->with('status', '1');
    }

    public function stocks()
    {
        $stocks = Stock::orderBy('name')->get();
        return view('admin.stocks', [
            'stocks' => $stocks
        ]);
    }

    public function stocksCreate()
    {
        return view('admin.forms.stock');
    }

    public function stocksEdit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('admin.forms.stock', [
            'stock' => $stock
        ]);
    }

    public function stocksUpdate(Request $request)
    {
        if (empty($request->id)) {
            $stock = new Stock;
        } else {
            $stock = Stock::findOrFail($request->id);
        }
        $stock->name = $request->name;
        $stock->save();
        return redirect()->route('stocks::edit', ['id' => $stock->id])->with('status', '1');
    }

    public function purchases()
    {
        $purchases = Purchase::orderBy('id')->get();
        return view('admin.purchases', [
            'purchases' => $purchases
        ]);
    }

    public function purchasesCreate()
    {
        $goods = Good::orderBy('name')->get();
        $stocks = Stock::orderBy('name')->get();
        return view('admin.forms.purchase', [
            'goods' => $goods,
            'stocks' => $stocks
        ]);
    }

    public function purchasesEdit(Request $request)
    {
        if (!empty($request->id)) {
            $inserts = array();
            //dd($request);
            foreach ($request->goods as $key => $val) {
                if (!empty($request->stocks[$key]) && !empty($request->quantity[$key]) && is_int(intval($request->quantity[$key]))) {
                    $inserts[] = array('good_id' => $val, 'stock_id' => $request->stocks[$key], 'quantity' => $request->quantity[$key]);
                }
            }
            if (!empty($inserts)) {
                $purchase = new Purchase;
                $purchase->save();
                foreach ($inserts as $insert) {
                    $purchaseGood = new PurchaseGood;
                    $purchaseGood->order_id = $purchase->id;
                    $purchaseGood->good_id = $insert['good_id'];
                    $purchaseGood->stock_id = $insert['stock_id'];
                    $purchaseGood->quantity = $insert['quantity'];
                    $purchaseGood->save();
                    $stockGood = StockGood::where([
                        ['stock_id', $insert['stock_id']],
                        ['good_id', $insert['good_id']]
                    ])->first();
                    if (!empty($stockGood->id)) {
                        $stockGood->quantity = $stockGood->quantity + $insert['quantity'];
                        $stockGood->save();
                    } else {
                        $stockGood = new StockGood;
                        $stockGood->stock_id = $insert['stock_id'];
                        $stockGood->good_id = $insert['good_id'];
                        $stockGood->quantity = $insert['quantity'];
                        $stockGood->save();
                    }
                }
            }
        }
        return redirect()->route('purchases::read', ['id' => $purchase->id])->with('status', '1');
    }

    public function purchasesRead($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchaseGoods = PurchaseGood::where('order_id', $purchase->id)->get()->keyBy('good_id');
        $goodsIds = array();
        foreach ($purchaseGoods as $purchaseGood) {
            $goodsIds[] = $purchaseGood->good_id;            
        }
        $goods = Good::whereIn('id', $goodsIds)->orderBy('name')->get();
        $stocks = Stock::orderBy('name')->get()->keyBy('id');
        return view('admin.read.purchase', [
            'purchase' => $purchase,
            'purchaseGoods' => $purchaseGoods,
            'goods' => $goods,
            'stocks' => $stocks
        ]);
    }

    public function orders()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        $sites = Sites::orderBy('name')->get()->keyBy('id');
        return view('admin.orders', [
            'orders' => $orders,
            'sites' => $sites
        ]);
    }

    public function ordersEdit($id)
    {
        $order = Order::findOrFail($id);
        $client = Client::find($order->client_id);
        $orderGoods = OrderGood::where('order_id', $order->id)->get()->keyBy('good_id');
        $showGoods = array();
        foreach ($orderGoods as $orderGood) {
            $showGoods[] = $orderGood->good_id;
        }
        $goods = Good::whereIn('id', $showGoods)->orderBy('name')->get();
        return view('admin.forms.order', [
            'order' => $order,
            'goods' => $goods,
            'orderGoods' => $orderGoods,
            'client' => $client
        ]);
    }

    public function ordersRead($id)
    {
        $order = Order::findOrFail($id);
        $client = Client::find($order->client_id);
        $orderGoods = OrderGood::where('order_id', $order->id)->get()->keyBy('good_id');
        $showGoods = array();
        foreach ($orderGoods as $orderGood) {
            $showGoods[] = $orderGood->good_id;
        }
        $goods = Good::whereIn('id', $showGoods)->orderBy('name')->get();
        $sites = Sites::orderBy('name')->get()->keyBy('id');
        return view('admin.read.order', [
            'order' => $order,
            'goods' => $goods,
            'sites' => $sites,
            'orderGoods' => $orderGoods,
            'client' => $client
        ]);
    }

    public function ordersUpdate(Request $request)
    {
        if (empty($request->id)) {
            $order = new Order;
        } else {
            $order = Order::findOrFail($request->id);
        }
        $order->delivery_type = $request->delivery_type;
        $order->order_type = $request->order_type;
        $order->order_pay = $request->order_pay;
        $order->com = $request->com;
        $order->save();
        return redirect()->route('orders::edit', ['id' => $order->id])->with('status', '1');
    }

    public function clients()
    {
        $clients = Client::orderBy('tel')->get();
        return view('admin.clients', [
            'clients' => $clients
        ]);
    }

    public function clientsCreate()
    {
        return view('admin.forms.client');
    }

    public function clientsEdit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.forms.client', [
            'client' => $client
        ]);
    }

    public function clientsUpdate(Request $request)
    {
        if (empty($request->id)) {
            $client = new Client;
        } else {
            $client = Client::findOrFail($request->id);
        }
        $client->name = $request->name;
        $client->tel = $request->tel;
        $client->email = $request->email;
        $client->save();
        return redirect()->route('clients::edit', ['id' => $client->id])->with('status', '1');
    }

    public function currencies()
    {
        $currencies = Currency::orderBy('name')->get();
        return view('admin.currencies', [
            'currencies' => $currencies
        ]);
    }

    public function currenciesCreate()
    {
        return view('admin.forms.currency');
    }

    public function currenciesEdit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.forms.currency', [
            'currency' => $currency
        ]);
    }

    public function currenciesUpdate(Request $request)
    {
        if (empty($request->id)) {
            $currency = new Currency;
        } else {
            $currency = Currency::findOrFail($request->id);
        }
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->save();
        return redirect()->route('currencies::edit', ['id' => $currency->id])->with('status', '1');
    }

    public function makeNP()
    {
        $url = "https://api.novaposhta.ua/v2.0/json/";
        /*$data = array(
            "apiKey" => "7308cf8ce134a329a969f0058701b25c",
            "modelName" => "Counterparty",
            "calledMethod" => "getCounterparties",
            "methodProperties" => array(
                "CounterpartyProperty" => "Sender",
                "Page" => "1"
            )
        );
        $content = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);
        dd($response);
        exit();*/
        /*$data = array(
            "apiKey" => "7308cf8ce134a329a969f0058701b25c",
            "modelName" => "InternetDocument",
            "calledMethod" => "save",
            "methodProperties" => array(
                "NewAddress" => "1",
                "PayerType" => "Sender",
                "PaymentMethod" => "Cash",
                "CargoType" => "Cargo",
                "VolumeGeneral" => "0.1",
                "Weight" => "10",
                "ServiceType" => "WarehouseDoors",
                "SeatsAmount" => "1",
                "Description" => "абажур",
                "Cost" => "500",
                "CitySender" => "8d5a980d-391c-11dd-90d9-001a92567626",
                "Sender" => "2e68ddde-09cf-11e9-8b24-005056881c6b",
                "SenderAddress" => "01ae2633-e1c2-11e3-8c4a-0050568002cf",
                "ContactSender" => "46994b37-09db-11e9-8b24-005056881c6b",
                "SendersPhone" => "380991768077",
                "RecipientCityName" => "київ",
                "RecipientArea" => "",
                "RecipientAreaRegions" => "",
                "RecipientAddressName" => "Столичне шосе",
                "RecipientHouse" => "20",
                "RecipientFlat" => "37",
                "RecipientName" => "Тест Тест Тест",
                "RecipientType" => "PrivatePerson",
                "RecipientsPhone" => "380938027377",
                "DateTime" => "12.01.2019"
            )
        );
        $content = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);
        dd($response);*/
    }

    public function sends()
    {
        return view('admin.sends');
    }

    public function sendsNp()
    {
        $url = "https://api.novaposhta.ua/v2.0/json/";
        /*$data = array(
            "apiKey" => "7308cf8ce134a329a969f0058701b25c",
            "modelName" => "Counterparty",
            "calledMethod" => "getCounterparties",
            "methodProperties" => array(
                "CounterpartyProperty" => "Sender",
                "Page" => "1"
            )
        );
        $content = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);
        dd($response);
        exit();*/
        $data = array(
            "apiKey" => "7308cf8ce134a329a969f0058701b25c",
            "modelName" => "InternetDocument",
            "calledMethod" => "save",
            "methodProperties" => array(
                "NewAddress" => "1",
                "PayerType" => "Sender",
                "PaymentMethod" => "Cash",
                "CargoType" => "Cargo",
                "VolumeGeneral" => "0.1",
                "Weight" => "10",
                "ServiceType" => "WarehouseDoors",
                "SeatsAmount" => "1",
                "Description" => "абажур",
                "Cost" => "500",
                "CitySender" => "8d5a980d-391c-11dd-90d9-001a92567626",
                "Sender" => "2e68ddde-09cf-11e9-8b24-005056881c6b",
                "SenderAddress" => "01ae2633-e1c2-11e3-8c4a-0050568002cf",
                "ContactSender" => "46994b37-09db-11e9-8b24-005056881c6b",
                "SendersPhone" => "380991768077",
                "RecipientCityName" => "київ",
                "RecipientArea" => "",
                "RecipientAreaRegions" => "",
                "RecipientAddressName" => "Столичне шосе",
                "RecipientHouse" => "20",
                "RecipientFlat" => "37",
                "RecipientName" => "Тест Тест Тест",
                "RecipientType" => "PrivatePerson",
                "RecipientsPhone" => "380938027377",
                "DateTime" => "12.01.2019"
            )
        );
        $content = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($json_response, true);
        //dd($response);
        return view('admin.stocksNp', [
            'response' => $response
        ]);
    }

    public function sendsSms()
    {
        DB::connection('turbosms')->table('alfakher21')->insert(['number' => '380507619585', 'sign' => 'Msg', 'message' => 'Номер ТТН Вашего заказа: 20450107120929. C Уважением, al-fakher.com.ua', 'send_time' => date('Y-m-d H:i:s')]);
        $sms = DB::connection('turbosms')->table('alfakher21')->orderBy('id', 'desc')->limit(10)->get();
        return view('admin.stocksSms', [
            'sms' => $sms
        ]);
    }
}