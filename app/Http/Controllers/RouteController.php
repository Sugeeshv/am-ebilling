<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\route;
use App\Models\routeondate;
use App\Models\product;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RouteController extends Controller
{

    function __construct()
    {
        // View routes
        $this->middleware('permission:route-view')->only(['index']);
        // Create route
        $this->middleware('permission:route-create')->only(['store']);
        // Update route
        $this->middleware('permission:route-edit')->only(['update']);
        // Delete route
        $this->middleware('permission:route-delete')->only(['distroy']);

    }
    public function index(Request $request){
        $users = User::all();
        
        $route = Route::select(
                'route_name',
                DB::raw('MIN(id) as id'),
                DB::raw('GROUP_CONCAT(sub_route) as sub_routes'),
                DB::raw('GROUP_CONCAT(assigned_to) as assigned_users'),
                DB::raw('GROUP_CONCAT(id) as rd')
            )
            ->groupBy('route_name')
            ->get();
        // dd($route);

        return view('route.index', compact('users', 'route'));
    }

    // delete sub_route
    public function subdelete(Request $request, $id){
        $route = route::findOrFail($id);
        $route->delete();
        return back()->with('success', 'Deleted successfully.');
    }

    // sub_route update
    public function subupdate(Request $request, $id){
        $request->validate([
            'route_name' => 'required|string|max:255',
            'sub_route' => 'required',
            'assigned_to' => 'required',
        ]);
        $route = route::findOrFail($id);
        $route->route_name = $request->route_name;
        $route->sub_route = $request->sub_route;
        $route->assigned_to = $request->assigned_to;
        $route->save();
        return back()->with('success', 'Updated successfully.');
    }

    public function substore(Request $request){

    //     // Validate the request data
        $request->validate([
            'route_name' => 'required|string|max:255',
            'sub_route' => 'required',
            'assigned_to' => 'required',
        ]);

        $route = new route();
        $route->route_name = $request->route_name;
        $route->sub_route = $request->sub_route;
        $route->assigned_to = $request->assigned_to;
        $route->save();
    return back()->with('success', 'Saved Successfully');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'routes' => 'required|array',
            // 'routes.*.sub_route' => 'required|string|max:255',
            'routes.*.assigned_to' => 'required|exists:users,id',
        ]);
    





       if (empty($request->suroute)) {

    foreach ($request->routes as $route) {
        Route::create([
            'route_name' => $request->route_name,
            'assigned_to' => $route['assigned_to'] ?? null,
        ]);
    }

} else {

    foreach ($request->routes as $route) {
        Route::create([
            'route_name' => $request->route_name,
            'sub_route' => $route['sub_route'] ?? null,
            'assigned_to' => $route['assigned_to'] ?? null,
        ]);
    }

}
    

    return back()->with('success', 'Saved Successfully');
    }
    public function updates(Request $request)
{
    dd($request);
    $request->validate([
        'route_name' => 'required|string',
        'sub_route' => 'required|array',
        'sub_route.*' => 'required|string',
        'assigned_to' => 'nullable|array',
    ]);

    // Get existing route (for old route_name)
    $route = Route::findOrFail($id);

    // Delete all old rows with same route_name
    Route::where('route_name', $route->route_name)->delete();

    // Insert new rows
    foreach ($request->sub_route as $index => $sub) {

        Route::create([
            'route_name'  => $request->route_name,
            'sub_route'   => $sub,
            'assigned_to' => $request->assigned_to[$index] ?? null,
        ]);
    }

    return redirect()->route('route.index')
        ->with('success', 'Route updated successfully');
    }

    // delete route
  public function delete($id)
{
    $route = Route::findOrFail($id);
    $route->delete();

    return redirect()->back()->with('success', 'Route deleted successfully.');
}

}
