@extends('layouts.app')

@section('content')
		<?php $bookCountNum=0; ?>
        <div class="container">
            <h4><b>View All Books</b></h4>
            <div class="navbooks">
                <a class="active" href="#">All Books</a></li>
                <a href="#">Available Books</a></li>
                <a href="#">Unavailable Books</a></li>
			</div>

            <form action="{{ route('patron.book.index') }}" method="get">
                <input class="viewBooks" type="text" name="s" id="search" placeholder="Search Books..." aria-describedby="button-addon2">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" style="font-size:12px">Filter<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Available</a></li>
                    <li><a href="#">Author</a></li>
                    <li><a href="#">Year</a></li>
                </ul>
                @if($message != null)
                    <div class="alert alert-danger">    
                        {{ $message }}
                    </div>
                @endif
            </form>

            @if (count($books) > 0)
				@foreach($books as $book)
				<div class="card" style="margin-bottom:12px;">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							<h6><?php $bookCountNum++; echo "$bookCountNum" ?>. 
								<div class="center patronIndex">
									<a href="bookDetails.html"><img src="{{$book->book_image}}" style="width:50%;"></a>
								</div>
							</h6>
						</div>
						<div class="col-lg-9">
							<div class="container-fluid" style="margin-top:34px;">
								<h4 style="text-decoration:underline"><b><a class="details" href="bookDetails.html">{{$book->title}}</a></b></h4>
								<p>by <a style="text-decoration:underline">{{$book->author}}</a></p>
								<div class="row">
									<div class="col-lg-6">
										<p><b>ISBN:</b> {{$book->isbn}}</p>
										<p><b>Volume:</b> {{$book->volume}}</p>
										<p><b>Edition:</b> {{$book->edition}}</p>
										<p><b>Year Published:</b> {{$book->year_published}}</p>
									</div>
									<div class="col-lg-6">
										<p><b>Publisher:</b> {{$book->publisher}}</p>
										<p><b>Genre:</b> {{$book->genre}}</p>
										<p><b>Condition:</b> {{$book->condition}}</p>
										<p><b>Status:</b> {{$book->status}}</p>
									</div>
								</div>
								<hr/>
								<p><b>Held by Ignacio B. Villamor Senior High School</b></p>
							</div>
						</div>
					</div>
				</div>
			</div>
				@endforeach
            @else 
                <h1 class="text-center m-5"> No books found! Contact your administrator.</h1>
            @endif
        </div>
@endsection