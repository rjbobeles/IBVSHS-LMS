@extends('layouts.app')

@section('content')
<div class="mt-5 text-center">
    <h3><strong style="font-family: Raleway;">{{ __('Reset Password') }}</strong></h3>
    <br/><br/><hr/><br/>
    <div class="container">
        <div class="col-12 mx-auto"></div>
            <div class="card shadow">
                <div class="card-header" id="card-header">
                    <h5>Reset Password</h5>
                </div>
                <div class="card-body">
                    <br/>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf           
                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p >E-Mail Address:&nbsp;</p>
                                </strong>
                            </div>
                            <div class="col mr-lg-5 my-auto" id="form-input-right">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row mt-4">
                            <div class="col" id="form-right">
                                <a href="user.html" class="btn shadow" id="add-edit-btn">Back</a>
                            </div>
                            <div class="col" id="form-left">
                                <button type="submit" class="btn shadow" id="add-edit-btn" >Send Password Reset Link</button>
                            </div>
                            <br/><br/><br/>
                        </div>
                    </form>
                </div>
            </div>  
        </div> 
        <br/><br/><br/><br/><br/><br/>
    </div>
@endsection