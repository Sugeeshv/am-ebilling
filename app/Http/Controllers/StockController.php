<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\stock;
use App\Models\User;
use App\Models\route;

use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    function __construct()
    {
        // View outlet routes
        $this->middleware('permission:add-stock')->only('add_stock');
        // Create outlet route
        $this->middleware('permission:stock-create')->only('create_stock');
        // Delete outlet route
        $this->middleware('permission:stock-delete')->only('delete_stock');
        // Get stock
        $this->middleware('permission:stock-view')->only('index');

        }
    public function add_stock($id)
    {
        $usid = auth()->id();
        $products = product::all();
        $stocks = Stocks::where('routedate_id', $id)->get();
        return view('stock.index',compact('products','stocks','id'));
    }
    public function create_stock(Request $request)
    {
        // dd($request->route_id);
        $productIds = $request->product_id ?? [];
        $quantities = $request->quantity ?? [];

        foreach ($productIds as $key => $productId) {

            if (!empty($productId) && isset($quantities[$key])) {
                $product = Product::find($productId);

                if ($product) {
                    // 🔎 Check if stock already exists for today + route + product
                    $stock = Stock::where('routedate_id', $request->route_id)
                                ->where('item_name', $product->item_name)
                                ->whereDate('created_at', Carbon::today())
                                ->first();
                    // dd($stock);

                    if ($stock) {
                        // ✅ UPDATE
                        
                        $stock->quantity = $quantities[$key];
                        $stock->total_price = $quantities[$key] * $product->unit_price;
                        $stock->save();

                    } else {
                        // ✅ CREATE
                        $stock = new Stock();
                        $stock->item_name = $product->item_name;
                        $stock->unit_price = $product->unit_price;
                        $stock->routedate_id = $request->route_id;
                        $stock->quantity = $quantities[$key];
                        $stock->total_price = $quantities[$key] * $product->unit_price;
                        $stock->status = 'pending';
                        $stock->save();
                    }
                }
            }
        }
        $tab=$request->route_id;

        $userid=auth()->user()->id;
        $routeid = Route::where('assigned_to', $userid)->get();
        // dd($routeid);
        // $routeid = $routeid[0]->id;
        $products = product::all();
        $date = Carbon::now()->toDateString();
        $stocks = Stock::whereDate('created_at', $date)->get();
        // dd($tab);
       return view('home',compact('stocks','products','routeid','tab'));
    }
    public function delete_stock(Request $request,$id)
    {
        $stock = stock::findOrFail($id);
        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
    public function index(Request $request)
    {

        $stocks = Stock::whereDate('created_at', Carbon::today())->get();
        // dd($stocks);
        $routes = DB::table('routes')
            ->select('route_name', DB::raw('GROUP_CONCAT(sub_route) as sub_routes'))
            ->groupBy('route_name')
            ->get();

    // dd($stocks);
        return view('stock.list_index',compact('stocks','routes'));
    }
    public function filterstock(Request $request)
    {
        $date = $request->date;
        $stocks = Stock::whereDate('created_at', $date)->get();
        // dd($stocks);
        $routes = DB::table('routes')
            ->select('route_name', DB::raw('GROUP_CONCAT(sub_route) as sub_routes'))
            ->groupBy('route_name')
            ->get();    
        // dd($stocks);
        return view('stock.list_index',compact('stocks','routes','date'));
    }
}
