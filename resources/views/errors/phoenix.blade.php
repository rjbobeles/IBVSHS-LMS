@extends('layouts.app')

@section('title', '- File not found!')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center error-row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-center align-items-center flex-column error-container">
                <img class="error-image" src="{{ asset('images/error/oops_txtr.png') }}"/> <!-- Oops, Uh Oh, 500, 404, 403 variations inside img folder  -->
                    
                    <h1 class="m-1">@yield('code') - @yield('message')</h1>
                    If you think this is a mistake, contact your system administrator!
                </div>
            </div>
        </div>
    </div>
@endsection