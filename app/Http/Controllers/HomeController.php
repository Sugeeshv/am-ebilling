<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\stock;
use App\Models\route;
use App\Models\product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid=auth()->user()->id;
        $routeid = Route::where('assigned_to', $userid)->get();
        // dd($routeid);
        // $routeid = $routeid[0]->id;
        $products = product::all();
        $date = Carbon::now()->toDateString();
        $stocks = Stock::whereDate('created_at', $date)->get();
        // dd($stocks);
            return view('home',compact('stocks','products','routeid'));
    }
    public function filter(Request $request){
        $tab = '';
        $date= $request->date;
        $stocks = Stock::whereDate('created_at', $request->date)->get();
        $userid=auth()->user()->id;
        $routeid = Route::where('assigned_to', $userid)->get();
        // $routeid = $routeid[0]->id;
        // dd($routeid);
        $products = product::all();
            return view('home',compact('stocks','products','routeid','date','tab'));
    }
}
