@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Admin Management</h2>
        
        <div class="mx-lg-n4 mt-3">
          <div class="row g-3">
            <div class="col-12 col-xl-6 col-xxl-8">
              <div class="card todo-list h-100">
                <div class="card-header border-bottom-0 pb-0">
                  <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-auto">
                      <h3 class="text-body-emphasis">Manage User</h3>
                    </div>
                    <div class="col-md-auto col-sm-12 d-flex">
                      <a class="btn btn-outline-primary me-1 mb-1 ms-md-auto ms-sm-0 mt-1" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
                    </div>
                  </div>
                </div>
                <div class="card-body py-0 scrollbar to-do-list-body">
                  <div class="d-flex hover-actions-trigger py-3 border-translucent border-top">
                    <table class="table table-striped fs-9 mb-0">
                      <thead>
                        <tr class="bg-body-highlight border-top border-translucent">
                          <th class="sort white-space-nowrap ps-4 text-uppercase" scope="col" data-sort="symbol" >Id</th>
                          <th class="sort pe-6 text-uppercase" scope="col" data-sort="name" >Name</th>
                          <th class="sort text-uppercase" scope="col" data-sort="price" >Email</th>
                          <th class="sort text-uppercase" scope="col" data-sort="change" >Action</th>
                          <th class="sort text-uppercase" scope="col" data-sort="change" >Role</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                      @foreach ($data as $key => $user)
                        <tr>
                            <td><p class="mb-0">{{ ++$i }}  </p></td>
                            <td><p class="mb-0">{{ $user->name }}</p></td>
                            <td><p class="mb-0">{{ $user->email }}</p></td>
                            <td>
                              @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                  <label class="badge bg-success">{{ $v }}</label>
                                @endforeach
                              @endif
                            </td>
                            <td class="pb-1 pt-2 ">
                              <a class="btn btn-success btn-sm me-1 mb-1" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-eye"></i></a>
                                <a class="btn btn-primary btn-sm me-1 mb-1" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> </a>
                                  <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                                      @csrf
                                      @method('DELETE')

                                      <button type="submit" class="btn btn-danger btn-sm me-1 mb-1"><i class="fa-solid fa-trash"></i> </button>
                                  </form>
                            </td>
                            </tr>
                            @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                  @session('success')
                  <div class="card-footer">
                        <div class="alert alert-success p-3" role="alert"> 
                            {{ $value }}
                        </div>
                  </div>
                  @endsession
              </div>
            </div>

            <div class="col-md-4">
              <div class="card" >
                <img class="card-img-top" src="{{ asset('admin/img/dashimages/manageuser.png') }}" alt="..." />
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