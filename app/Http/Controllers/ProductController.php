<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    function __construct()
    {
        
        $this->middleware('permission:product-list',   ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

        }
    public function index()
    {   
        $products=product::all();
        return view('product.index',compact('products'));
    }
    public function destroy($id): RedirectResponse
    {
        $product = product::find($id);
        $product->delete();
        return redirect()->route('product.view')
            ->with('success', 'Product deleted successfully');
    }
}
