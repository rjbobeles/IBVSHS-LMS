@extends('layouts.appfull')

@section('content')
<div style="background-color: #92130f;" class="container-fluid m-0">
    <img src="{{ asset('images/login-photo.png') }}" id="login-img">
    <img src="{{ asset('images/book-shelf.jpg') }}" id="login-img-2">

    <div class="col">
    <div class="row" style="height: calc(100vh - 120.5px);">
        <div class="col-xl-5 my-auto text-center">
            <h1>LIBRARY</h1>
            <h3>MANAGEMENT SYSTEM</h3>
            <p>The local library system allows the librarian to easily track <br/> inventories of the school's learning materials.</p>
        </div>
        <div class="col-xl-2"></div>
        <div class="col-xl-4 my-auto">
            <div class="mx-lg-5">
                <div class="card shadow-lg p-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="mb-4 login-heading">Sign In</h2>
                            
                            <div class="form-group row">
                                <div class="col">
                                    <input id="username" placeholder="username" type="text" class="mb-3 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="password" placeholder="password" type="password" class="mt-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col my-auto text-center">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>                                      
                                </div>
                                <div class="col text-lg-right">
                                    <button type="submit" class="px-4 btn btn-lms-solid">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
</div>
</div>
@endsection


