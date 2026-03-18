<!-- 
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
@endif

<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control" multiple="multiple">
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form> -->

@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Admin Management</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-none border my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom bg-body">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-body mb-0" data-anchor="data-anchor" id="basic-example">Create User<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#basic-example" style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h4>
                      </div>
                      <div class="col col-md-auto">
                        <nav class="nav justify-content-end doc-tab-nav align-items-center" role="tablist">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-primary me-1 mb-1" type="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                            <!-- <a class="btn btn-sm btn-phoenix-primary code-btn ms-2 collapsed" href="{{ route('users.index') }}" role="button"><span class="text-body fs-5 uil uil-step-backward"></span></a></nav> -->
                      </div>
                    </div>
                  </div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                  <div class="p-4 code-to-copy">
                      <div class="mb-3">
                        <label class="form-label ps-0" for="exampleTextarea">Full name </label>
                        <input type="text" name="name" placeholder="Name" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label ps-0" for="exampleTextarea">Email address</label>
                        <input type="email" name="email" placeholder="name@example.com" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label ps-0" for="exampleTextarea">Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label ps-0" for="exampleTextarea">Confirm Password</label>
                        <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label ps-0" for="exampleTextarea">Confirm Password</label>
                        <div class="form-group">
                            <strong>Role:</strong>
                            <select name="roles[]" class="form-control" multiple="multiple">
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"> Submit</button>
                      </div>
                   </div>
                </form>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
    </main>

    
@endsection