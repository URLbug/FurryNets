@extends('app.app')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{ asset('/img/registr.png') }}"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" />
                <label class="form-label" for="email">Email address</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="login" class="form-control form-control-lg"
                        placeholder="Enter a valid login" />
                    <label class="form-label" for="login">Login</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control form-control-lg"
                    placeholder="Enter a valid password" />
                    <label class="form-label" for="password">Password</label>
                </div>
    
                <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="remember-me" />
                    <label class="form-check-label" for="remember-me">
                    Remember me
                    </label>
                </div>
                </div>
    
                <div class="text-center text-lg-start mt-4 pt-2">
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Have you an account? <a href="{{ route('login') }}"
                    class="link-danger">Login</a></p>
                </div>
    
            </form>
            </div>
        </div>
        </div>
    </section>
@endsection