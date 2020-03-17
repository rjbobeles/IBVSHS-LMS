@extends('layouts.app')

@section('content')

<div class="mt-5 text-center">
    <h3><strong style="font-family: Raleway;">Forgot Password</strong></h3>
    <br/><br/><hr/><br/>
    <div class="container">
        <div class="col-12 mx-auto"></div>
            <div class="card shadow">
                <div class="card-header" id="card-header">
                    <h5>Account Details</h5>
                </div>
                <div class="card-body">
                    <br/>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}"> 

                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p>Email:&nbsp;</p>
                                </strong>
                            </div>
                            <div class="col mr-lg-5 my-auto" id="form-input-right">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p >Password:&nbsp;</p>
                                </strong>
                            </div>
                            <div class="col mr-lg-5" id="form-input-right">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p >Confirm Password:&nbsp;</p>
                                </strong>
                            </div>
                            <div class="col mr-lg-5 my-auto" id="form-input-right">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row mt-4">
                            <div class="col" id="form-right">
                                <a href="user.html" class="btn shadow" id="add-edit-btn">Back</a>
                            </div>
                            <div class="col" id="form-left">
                                <button type="submit" class="btn shadow" id="add-edit-btn" >Reset Password</button>
                            </div>
                            <br/><br/><br/>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <br/><br/><br/><br/><br/><br/>
    </div>



{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
