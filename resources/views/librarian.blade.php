@extends('layouts.app')

@section('content')
<div class="container" id="homepage">
    <!-- <form action="#" class="searchbar">
        <input type="search" name="search" id="search" placeholder="Search Books...">
        <input type="submit" value="&#xf002;" style="display:none;">
    </form> -->
    <div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">Ignacio B. Villamor - Senior High School</h1>
            <h4 class="mb-5">Library Management System</h3>
            <hr class="mb-2"/>
        </div>
    </div>
    <div class="row text-center">
        <h5 class="d-inline-block w-100 mt-2 mb-3">Get Started</h5>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="thumbnail d-flex justify-content-center flex-column">
                <a href="{{ route('books.index') }}"> 
                    <img src="{{ asset('images/icons/030-book-25.png') }}" style="width:42%" class="center patronIndex img-responsive">
                    <div class="caption mt-4">
                        Manage Library
                    </div>
                </a>
            </div> 
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="thumbnail d-flex justify-content-center flex-column">
                <a href="{{ route('transactions.create') }}"> 
                    <img src="{{ asset('images/icons/010-shopping-cart.png') }}" style="width:42%" class="center patronIndex img-responsive">
                    <div class="caption mt-4">
                        Issue a Book
                    </div>
                </a>
            </div> 
        </div>
        <div class="col-lg-3 col-xs-12">
            <div class="thumbnail d-flex justify-content-center flex-column">
                <a href="{{ route('transactions.index') }}"> 
                    <img src="{{ asset('images/icons/014-book-11.png') }}" style="width:42%" class="center patronIndex img-responsive">
                    <div class="caption mt-4">
                        Return a Book
                    </div>
                </a>
            </div> 
        </div>
        <div class="col-lg-3 col-xs-12">
        <div class="thumbnail d-flex justify-content-center flex-column">
                <a href="{{ route('patrons.index') }}"> 
                    <img src="{{ asset('images/icons/016-book-12.png') }}" style="width:42%" class="center patronIndex img-responsive">
                    <div class="caption mt-4">
                        Manage Patrons
                    </div>
                </a>
            </div> 
        </div>
    </div>
</div>
@endsection