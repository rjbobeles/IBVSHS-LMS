@extends('layouts.app')

@section('content')
<div class="mt-5 text-center">
    <h3><strong style="font-family: Raleway;">Change Password</strong></h3>
    <br/><br/><hr/><br/>
    <div class="container">
        <div class="col-12 mx-auto"></div>
            <div class="card shadow">
                <div class="card-header" id="card-header">
                    <h5>Account Details</h5>
                </div>
                <div class="card-body">
                    <br/>
                    <form method="POST" action="{{ route('changepassword.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p>Old Password:&nbsp;</p>
                                </strong>
                            </div>
                            <div class="col mr-lg-5 my-auto" id="form-input-right">
                                <input id="old-password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old-password" required autocomplete="old-password">

                                @error('old-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col my-auto" id="form-label-left" >
                                <strong>
                                    <p >New Password:&nbsp;</p>
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
                            <div class="col" id="form-left">
                                <button type="submit" class="btn shadow" id="add-edit-btn" >Update</button>
                            </div>
                            <br/><br/><br/>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <br/><br/><br/><br/><br/><br/>
    </div>
</div>  
@endsection