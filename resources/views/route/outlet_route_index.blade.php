
@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Outlet</h2>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
              <div class="card todo-list h-100">
                <div class="card-header border-bottom-0 pb-0">
                  <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-auto">
                      <p class="text-body-emphasis"><b>Manage stock route</b></p>
                    </div>
                    <div class="col-md-auto col-sm-12 d-flex mb-3">
                      
                      <button class="btn btn-outline-success me-1 mb-1 ms-md-auto ms-sm-0 mt-1" type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered"><i class="fa fa-plus"></i> Create Route on date</button>
                      <div class="modal fade" id="verticallyCentered" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="verticallyCenteredModalLabel">Create Route on date</h5><button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                             <form method="POST" action="{{ route('route.store') }}">
                              @csrf
                              <div class="p-4 code-to-copy">
                                  <div class="mb-3">
                                      <label class="form-label ps-0" for="exampleTextarea"> Route Name </label>
                                       <select name="route" class="form-select" id="">
                                         <option >Select</option>
                                          @foreach($routeondate as $routeondate)
                                         <option value="{{ $routeondate->id }}">{{ $routeondate->route_name }}</option>
                                        @endforeach
                                       </select>
                                  </div>
                                  <div class="mb-3">
                                      <label class="form-label ps-0" for="exampleTextarea"> Assign to </label>
                                      <input type="date" name="start_point" placeholder="Assign to" class="form-control">
                                  </div>
                                  <div class=" mt-8">
                                    <hr class="mb-4">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                                    </div>
                                  </div>
                              </form>
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
                </div>
                <div class="card-body py-0 scrollbar  mb-8 pb-0">
                  <div class="d-flex hover-actions-trigger py-3 border-translucent border-top">
                    <!-- {{$users}} -->
                    <table class="table table-striped fs-9 mb-0 pb-0" id="myTable">
                      <thead>
                        <tr class="bg-body-highlight border-top border-translucent">
                            <th>#No</th>
                            <th>Route Name</th>
                            <th>Route Assign to</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach($routeondate as $key => $routeondates)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $routeondates->route_id }}</td>
                                <td>{{ $routeondates->date }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>

                    </table>
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