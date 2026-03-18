
@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Stock</h2>
        <div class="row">
            <div class="col-12 col-xl-7 col-xxl-8">
              <div class="card todo-list h-100">
                <div class="card-header border-bottom-0 pb-0">
                  <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-auto">
                      <h3 class="text-body-emphasis">Manage Stock</h3>
                    </div>
                    <div class="col-md-auto col-sm-12 d-flex">
                      <button class="btn btn-outline-success me-1 mb-1 ms-md-auto ms-sm-0 mt-1" type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered"><i class="fa fa-plus"></i> Create New Order</button>
                      <div class="modal fade" id="verticallyCentered" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="verticallyCenteredModalLabel">Create Stock</h5><button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                             <form method="POST" action="{{ route('create.stock',$id) }}">
                              <input name="route_date_id" value="{{$id}}" type="hidden">
                              
                              @csrf
                              <div class="p-4 code-to-copy">
                                  <div class="mb-3">
                                      <label class="form-label ps-0" for="exampleTextarea"> Item name </label>
                                      <select class="form-select" name="product" aria-label="Default select example">
                                        <option selected>Select Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                                        @endforeach
                                      </select> 
                                  </div>
                                  <div class="mb-3">
                                      <label class="form-label ps-0" for="exampleTextarea"> Quantity </label>
                                      <input type="text" name="quantity" placeholder="In liters" class="form-control">
                                  </div>
                                  <div class=" mt-8">
                                    <hr class="mb-4">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                                    </div>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>
                <div class="card-body py-0 scrollbar  mb-8 pb-0">
                  <div class="d-flex hover-actions-trigger py-3 border-translucent border-top">
                    <table class="table table-striped fs-9 mb-0 pb-0" id="myTable">
                      <thead>
                        <tr class="bg-body-highlight border-top border-translucent">
                            <th>No</th>
                            <th>Product name</th>
                            <th>price</th>
                            <th>order date</th>
                            <th>Total Price</th>
                            <th>quantity</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                     <tbody class="list">
                        @foreach($stocks as $key => $stock)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $stock->item_name }}</td>
                            <td>₹{{ $stock->unit_price }}</td>
                            <td>{{ $stock->created_at->format('d-m-Y') }}</td>
                            <td>₹{{ $stock->total_price }}</td>
                            <td>{{ $stock->total_quantity }}</td>
                            <td>
                                <a href="{{ route('stock.delete', $stock->id) }}" class="btn btn-outline-danger btn-sm" type="button"> <span class="fas fa-trash"></span></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @if ($errors->any())
                        <div style="color:red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  </div>
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