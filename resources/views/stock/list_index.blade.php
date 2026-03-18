
@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Manage Stock</h2>
        <div class="row">
        <div class="col-md-8">
                <div class="card shadow-none border my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom bg-body">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-body mb-0" data-anchor="data-anchor" id="basic-example">Stock<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#basic-example" style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h4>
                      </div>
                      <div class="col-3 ">
                        <form class="input-group " method="POST" action="{{ route('stocks.filter') }}">
                          @csrf
                          <input class="form-control" type="date" name="date" value="{{ $date ?? '' }}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                          <button type="submit" class="input-group-text" id="basic-addon2">Go</button>
                        </form>
                      </div>
                      <div class="col col-md-auto">
                        <nav class="nav justify-content-end doc-tab-nav align-items-center" role="tablist">
                            <a href="" class="btn btn-outline-primary me-1 mb-1" type="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                            <!-- <a class="btn btn-sm btn-phoenix-primary code-btn ms-2 collapsed" href="{{ route('users.index') }}" role="button"><span class="text-body fs-5 uil uil-step-backward"></span></a></nav> -->
                      </div>
                    </div>
                  </div><div class="card-body py-0 scrollbar  mb-8 pb-0">
                  <div class="hover-actions-trigger py-3 border-translucent border-top">
                        <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Route Name</th>
                                  <th>Sub Routes</th>
                                  <th>Total Orders</th>
                              </tr>
                          </thead>
                         <tbody>
                          @foreach($routes as $index => $route)
                              <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{{ $route->route_name }}</td>
                                  <td>
                                      @php
                                          $subRoutes = explode(',', $route->sub_routes);
                                          $totalrouteorderss=0;
                                          $total=0;
                                          $today = \Carbon\Carbon::now()->toDateString();
                                      @endphp

                                      @foreach($subRoutes as $subIndex => $sub)
                                          <button class="btn btn-primary mb-1" type="button" data-bs-toggle="modal" data-bs-target="#sub_route_{{ $index }}_{{ $subIndex }}">
                                            @if(!empty($routes->sub_routes))
                                               
                                                {{ $route->route_name }}
                                            @else
                                                {{ $sub }}
                                            @endif
                                          </button>
                                          <div class="modal fade" id="sub_route_{{ $index }}_{{ $subIndex }}" tabindex="-1" aria-labelledby="sub_route_{{ $index }}_{{ $subIndex }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="sub_route_{{ $index }}_{{ $subIndex }}Label">{{ $route->route_name }} - {{ $sub }}</h5><button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  @php
                                                      $totalrouteorder = 0;
                                                  @endphp

                                                  <table class="table table-sm fs-9 mb-5 mt-4">
                                                      <thead>
                                                          <tr>
                                                              <th class="sort border-top border-translucent ps-3">Item Name</th>
                                                              <th class="sort border-top border-translucent">QTY</th>
                                                          </tr>
                                                      </thead>

                                                      <tbody class="list">
                                                          @foreach($stocks as $stock)
                                                          @php
                                                            $stockdate = \Carbon\Carbon::parse($stock->created_at)->toDateString();
                                                          @endphp
                                                              @if($stock->routedate_id )

                                                                  <tr>
                                                                      <td class="ps-3">{{ $stock->item_name }}</td>
                                                                      <td>{{ $stock->quantity }}</td>
                                                                  </tr>

                                                                  @php
                                                                    $totalrouteorder += $stock->quantity;
                                                                    $totalrouteorderss += $stock->quantity;
                                                                  @endphp

                                                              @endif

                                                          @endforeach

                                                          <!-- Total Row -->
                                                          <tr class="border-top border-translucent bg-light">
                                                              <td class="ps-3"><strong>Total</strong></td>
                                                              <td><strong>{{ $totalrouteorder }}</strong></td>
                                                          </tr>

                                                      </tbody>
                                                  </table>
                                                </div>
                                                <div class="modal-footer"><button class="btn btn-primary" type="button">Okay</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                              </div>
                                            </div>
                                          </div>
                                      @endforeach
                                  </td>
                                  <td>{{$totalrouteorderss}}</td>
                                  @php
                                      $total+=$totalrouteorderss;
                                  @endphp
                              </tr>
                          @endforeach
                          </tbody>
                          <tfoot> 
                            <tr>
                              <td></td>
                              <td><b>Total</b></td>
                              <td></td>
                              <td class="text-right"><b>{{ $total }}</b></td>
                            </tr>
                      </table>
                  </div>
                </div>
            </div>

        </div>

        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2025 &copy;<a class="mx-1" href="https://themewagon.com/">Themewagon</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v1.24.0</p>
            </div>
          </div>
        </footer>
      </div>
    </main>
    
@endsection