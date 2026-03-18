
@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Manage Routes</h2>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
              <div class="card todo-list h-100">
                <div class="card-header border-bottom-0 pb-0">
                  <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-auto">
                      <p class="text-body-emphasis"><b>Manage stock route</b></p>
                    </div>
                    <div class="col-md-auto col-sm-12 d-flex">
                      @can('route-create')
                      
                      
                      <button class="btn btn-outline-success me-1 mb-1 ms-md-auto ms-sm-0 mt-1" type="button" data-bs-toggle="modal" data-bs-target="#verticallyCentered"><i class="fa fa-plus"></i> Create New Route</button>
                      <div class="modal fade modal-lg" id="verticallyCentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Create Route</h5>
                                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <form method="POST" action="{{ route('route.store') }}">
                                    @csrf

                                    <!-- Route Name -->
                                    <div class="mb-3">
                                        <label class="form-label p-0">Route Name</label>
                                        <input type="text" name="route_name" class="form-control" required>
                                    </div>

                                    <!-- No Sub Route Checkbox -->
                                    <div class="form-check mb-3">
                                        <input name="suroute" class="form-check-input" type="checkbox" id="disableSubRoutes">
                                        <label class="form-check-label">No Sub Routes</label>
                                    </div>

                                    <!-- Sub Route Container -->
                                    <div id="route-container">

                                    <div class="row route-item mb-3">

                                    <div class="col-md-5">
                                        <label class="form-label p-0">Sub Route</label>
                                        <input type="text" name="routes[0][sub_route]" class="form-control subroute-input">
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label p-0">Assign To</label>
                                        <select name="routes[0][assigned_to]" class="form-select assign-input">
                                        <option value="">Select</option>

                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                    </div>

                                    </div>

                                    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                        <!-- Add Button -->
                                        <button type="button" id="addbtn" class="btn btn-success mb-3">
                                        + Add More
                                        </button>

                                        <br>

                                        <button type="submit" class="btn btn-primary">
                                        Submit
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
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
                            <th>Sub Routes</th>
                                  @can('route-edit')
                            <th>Action</th>
                                @endcanany
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach ($route as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->route_name }}</td>
                            <td>
                                
                                @php
                                    $subRoutes = explode(',', $r->sub_routes);
                                    $assignedUsers = explode(',', $r->assigned_users);
                                @endphp

                                @foreach ($subRoutes as $index => $sub)
                                    @php
                                        $routeid = $r->rd ? explode(',', $r->rd)[$index] ?? null : null;
                                        $userId = $assignedUsers[$index] ?? null;
                                        $user = $users->firstWhere('id', $userId);
                                    @endphp


                                    <span class="badge badge-phoenix badge-phoenix-primary mb-2">
                                        {{ trim($sub) }}     
                                        -
                                        {{ $user?->name ?? 'Unassigned' }}
                                        <a href="#" class="badge bg-primary-dark ms-1" type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $routeid }}"><i class="fas fa-pencil-alt btn-lg"></i></a>
                                        <a href="{{ route('route.sub.delete',$routeid) }}" class="badge bg-primary-dark ms-1"><i class="fas fa-trash-alt btn-lg"></i></a>
                                    </span>
                                    <!-- <a href="" class="btn "><i class="fas fa-pencil-alt btn-sm"></i></a> -->
                                <br>
                                <!-- edit route modal start -->
                                  <div class="modal fade modal-lg" id="edit{{ $routeid }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Create Route</h5>
                                                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <form method="POST" action="{{ route('route.sub.update', $routeid) }}">
                                                        @csrf
                                                        <input type="hidden" name="subid" value="{{ $routeid }}">
                                                        <!-- Route Name -->
                                                        <div class="mb-3">
                                                            <label class="form-label p-0">Route Name</label>
                                                            <input type="text" name="route_name" class="form-control" value="{{ $r->route_name }}" required>
                                                        </div>

                                                        <!-- Dynamic Container -->
                                                        <div">
                                                            <div class="row route-item mb-3">

                                                                <!-- Sub Route -->
                                                                <div class="col-md-5">
                                                                    <label class="form-label p-0">Sub Route</label>
                                                                    <input type="text" value="{{ trim($sub) }}"
                                                                        name="sub_route"
                                                                        class="form-control" placeholder="jj"
                                                                        required>
                                                                </div>

                                                                <!-- Assign To -->
                                                                <div class="col-md-5">
                                                                    <label class="form-label p-0">Assign To</label>
                                                                    <select name="assigned_to" class="form-select" required>
                                                                        <option value="">Select</option>
                                                                        @foreach($users as $user)
                                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>

                                                        </div>

                                                        <br>

                                                        <button type="submit" class="btn btn-primary">
                                                            Update
                                                        </button>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- edit route modal end -->
                                @endforeach
                               
                            </td>
                            <td> 
                                <a href="" class="btn btn-outline-primary rounded-pill btn-sm me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#routeedit{{ $r->id }}"><i class="fas fa-plus btn-sm"></i></a>
                                <a href="{{ route('route.delete', $r->route_name) }}" class="btn btn-outline-danger rounded-pill btn-sm me-1 mb-1" onclick="return confirm('Are you sure you want to delete this route?')"><i class="fas fa-trash btn-sm"></i></a>


                                @can('route-edit')
                                     <div class="modal fade modal-lg" id="routeedit{{ $r->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Create Route</h5>
                                                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <form method="POST" action="{{ route('route.sub.store') }}">
                                                        @csrf

                                                        <!-- Route Name -->
                                                        <div class="mb-3">
                                                            <label class="form-label p-0">Route Name</label>
                                                            <input type="text" name="route_name" class="form-control" value="{{ $r->route_name }}" required>
                                                        </div>

                                                        <!-- Dynamic Container -->
                                                        <div">
                                                            <div class="row route-item mb-3">

                                                                <!-- Sub Route -->
                                                                <div class="col-md-5">
                                                                    <label class="form-label p-0">Sub Route</label>
                                                                    <input type="text"
                                                                        name="sub_route"
                                                                        class="form-control"
                                                                        required>
                                                                </div>

                                                                <!-- Assign To -->
                                                                <div class="col-md-5">
                                                                    <label class="form-label p-0">Assign To</label>
                                                                    <select name="assigned_to" class="form-select" required>
                                                                        <option value="">Select</option>
                                                                        @foreach($users as $user)
                                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                            </div>

                                                        </div>

                                                        <br>

                                                        <button type="submit" class="btn btn-primary">
                                                            Update
                                                        </button>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endcan
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
@push('scripts')

<script>

let index = 1;

// ADD ROW
document.getElementById('addbtn').addEventListener('click', function () {

    if(document.getElementById('disableSubRoutes').checked){
        return;
    }

    let container = document.getElementById('route-container');
    let firstRow = document.querySelector('.route-item');
    let newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('input, select').forEach(function (el) {

        if (el.name.includes('sub_route')) {
            el.name = `routes[${index}][sub_route]`;
            el.value = '';
        }

        if (el.name.includes('assigned_to')) {
            el.name = `routes[${index}][assigned_to]`;
            el.selectedIndex = 0;
        }

    });

    container.appendChild(newRow);

    index++;

});

// REMOVE ROW
document.addEventListener('click', function(e) {

    if (e.target.classList.contains('remove-btn')) {

        let rows = document.querySelectorAll('.route-item');

        if (rows.length > 1) {
            e.target.closest('.route-item').remove();
        }

    }

});


// DISABLE SUB ROUTES
document.getElementById('disableSubRoutes').addEventListener('change', function(){

    let disabled = this.checked;

    document.querySelectorAll('.subroute-input').forEach(function(el){
        el.disabled = disabled;
    });

    // document.querySelectorAll('.assign-input').forEach(function(el){
    //     el.disabled = disabled;
    // });

    document.getElementById('addbtn').disabled = disabled;

});

</script>


@endpush