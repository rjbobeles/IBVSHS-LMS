@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($message != null)
                <div class="alert alert-danger">    
                    {{ $message }}
                </div>
            @endif

            <form action="{{ route('patron.book.index') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="s" class="form-control" placeholder="Search.." aria-describedby="button-addon2">
                    
                    <div class="input-group-append">
                    <input type="submit" class="btn btn-lms2" id="button-addon2" value="Submit">
                    </div>
                </div>
            </form>

            @if (count($books) > 0)
               More than 1 result
            @else 
                <h1 class="text-center m-5"> No books found! Contact your administrator.</h1>
            @endif
        </div>
    </div>
@endsection