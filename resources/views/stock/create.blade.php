
@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        @include('layouts.menu')
      <div class="content">
        <h2 class="mb-4 text-body-emphasis">Manage Stock</h2>
        <div class="row">

            <div class="col-md-6">
                <div class="card shadow-none border my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom bg-body">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-body mb-0" data-anchor="data-anchor" id="basic-example">Create New Stock<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#basic-example" style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h4>
                      </div>
                      <div class="col col-md-auto">
                        <nav class="nav justify-content-end doc-tab-nav align-items-center" role="tablist">
                            <a href="{{ route('stock.index') }}" class="btn btn-outline-primary me-1 mb-1" type="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                            <!-- <a class="btn btn-sm btn-phoenix-primary code-btn ms-2 collapsed" href="{{ route('users.index') }}" role="button"><span class="text-body fs-5 uil uil-step-backward"></span></a></nav> -->
                      </div>
                    </div>
                  </div>
                    <form method="POST" action="{{ route('stock.store') }}">
                        @csrf
                    <div class="p-4 code-to-copy">
                        <div class="mb-3">
                            <label class="form-label ps-0" for="exampleTextarea"> Item name </label>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>Open this select menu</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select> 
                        </div>
                        <div class="mb-3">
                            <label class="form-label ps-0" for="exampleTextarea"> Quantity </label>
                            <input type="text" name="quantity" placeholder="Quantity" class="form-control">
                        </div>
                        <div class="mb-3">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                        </div>
                        </div>
                    </form>
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