@extends('layouts.app')
@section('content')
    <form action="{{URL::to('/viewBooks')}}" method="get">
        <div class="form-group">
            <input type="search" class="form-control" name="search" placeholder="Search...">
            <button class="btn btn-default" type="submit">
                Search
            </button>
        </div>
    </form>
    <table>
        @if (isset($books))
        @if (count($books) > 0)
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>ISBN</td>
            <td>Genre</td>
            <td>Publisher</td>
            <td>Year Published</td>
        </tr>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->year_published }}</td>
                </tr>
            @endforeach
        @else <p>{{$message}}</p>
        @endif
        @endif
    </table>
@endsection