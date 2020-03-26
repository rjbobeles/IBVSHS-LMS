@extends('layouts.app')

@section('content')
<body class="patronIndex">
<div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">Ignacio B. Villamor - Senior High School</h1>
            <h4 class="mb-5">Library Management System</h3>
            <hr class="mb-2"/>
        </div>
    </div>

        <form action="{{ route('patron.book.index') }}" method="get" class="text-center mt-3">
            <input class="patronIndex" type="text" name="s" id="search" placeholder="Search Books..." class="form-control">
            <input class="patronIndex" type="submit" value="&#xf002;">
        </form>

        <br/>
        
        <div class="center patronIndex">

            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="thumbnail d-flex justify-content-center flex-column">
                        <a href="{{ route('patron.book.index') }}"> 
                            <img src="{{ asset('images/icons/030-book-25.png') }}" id="ViewBooks" style="width:42%" class="center patronIndex img-responsive">
                            <div class="caption mt-4">
                                <h6>View all books</h6>
                            </div>
                         </a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="thumbnail d-flex justify-content-center flex-column">
                        <a href="{{ route('patron.book.records') }}">
                            <img src="{{ asset('images/icons/022-book-17.png') }}" id="BorrowedBooks" style="width:42%" class="center patronIndex img-responsive">
                            <div class="caption mt-4">
                                <h6>My Borrowed Books</h6>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>

        </div>
    </body>
@endsection