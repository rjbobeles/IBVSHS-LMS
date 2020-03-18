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
                            <h2 class="mb-4 login-heading">Sign Up</h2>
                            
                            <div class="form-group row">
                                <div class="col">
                                    <input id="firstname" placeholder="first name" type="text" class="mt-3 form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="middlename" placeholder="middle name" type="text" class="mt-3 form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autocomplete="middlename">

                                    @error('middlename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="lastname" placeholder="last name" type="text" class="mt-3 form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="username" placeholder="username" type="text" class="mt-3 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="contactno" placeholder="contact number" type="text" class="mt-3 form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno') }}" required autocomplete="contactno">

                                    @error('contactno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="email" placeholder="email" type="email" class="mt-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="password" placeholder="password" type="password" class="mt-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="password-confirm" placeholder="confirm password" type="password" class="mt-3 form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col text-lg-right">
                                    <button type="submit" class="px-4 btn btn-lms-solid">
                                        {{ __('Register') }}
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
