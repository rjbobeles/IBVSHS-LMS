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
    <br/>
    <div class="card">
        <div class="get-started text-center mt-3">
            Get Started
        </div>
        <div class="card-body px-5 py-4">
            <div class="row">
                <div class="col-lg-3 pb-4 thb-div">
                    <a href="{{ route('books.index') }}" class="home-icon-link">
                        <img src="{{ asset('images/icons/030-book-25.png') }}" alt="managelib" class="center mt-4">
                        <div class="caption mt-4">
                            Manage Library
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 pb-4 thb-div">
                    <a href="{{ route('transactions.create') }}" class="home-icon-link">
                        <img src="{{ asset('images/icons/010-shopping-cart.png') }}" alt="bookissuance" class="center mt-4">
                        <div class="caption mt-4">
                            Issue a Book
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 pb-4 thb-div">
                    <a href="{{ route('transactions.index') }}" class="home-icon-link">
                        <img src="{{ asset('images/icons/014-book-11.png') }}" alt="bookissuance" class="center mt-4">
                        <div class="caption mt-4">
                            Return a Book
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 pb-4">
                    <a href="{{ route('patrons.index') }}" class="home-icon-link">
                        <img src="{{ asset('images/icons/016-book-12.png') }}" alt="bookissuance" class="center mt-4">
                        <div class="caption mt-4">
                            Manage Library Patrons
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection