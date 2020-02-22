@extends('layouts.app')

@section()
<div class="card-header">{{ __('Edit a User') }}</div>
    <div class="container">
        <form method="POST" action="{{ route('patrons.update', $patron->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                <div class="col-md-6">
                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $patron->firstname }}" required autocomplete="firstname">
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
                        <div class="col-md-6">
                            <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ $patron->middlename }}" required autocomplete="middlename">

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>

                <div class="form-group row">
                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $patron->lastname }}" required autocomplete="lastname">

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $patron->username }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contactno" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                    <div class="col-md-6">
                        <input id="contactno" type="text" class="form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ $patron->contactno }}" required autocomplete="contactno">

                                @error('contactno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $patron->email }}" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Patron') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection