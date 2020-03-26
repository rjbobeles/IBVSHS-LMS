@extends('layouts.app')

@section('content')
<body class="patronIndex">
        <br/><br/><br/>
        <form action="{{ route('patron.book.index') }}" method="get" style="text-align:center">
            <input class="patronIndex" type="text" name="s" id="search" placeholder="Search Books..." class="form-control">
            <input class="patronIndex" type="submit" value="&#xf002;">
        </form>

        <br/><br/>
        
        <div class="center patronIndex">

            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="thumbnail">
                        <br/><br/>  
                        <a href="books"> 
                            <img src="{{ asset('images/patronbooks.png') }}" id="ViewBooks" style="width:37%" class="center patronIndex img-responsive">
                            <div class="caption">
                                <h6><a href='viewBooks'>View all books</a></h6>
                            </div>
                         </a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="thumbnail">
                    <br/><br/>
                        <a href="records">
                            <img src="{{ asset('images/patronborrowed.png') }}" id="BorrowedBooks" style="width:37%" class="center patronIndex img-responsive">
                            <div class="caption">
                                <h6><a href='viewBooks'>My Borrowed Books</a></h6>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>

        </div>
    </body>
@endsection