@extends('layouts.app')
@section('content')
<form action="search.blade.php" method="GET" role="search">
        <input type="text" class="form-control" name="search" placeholder="Search...">
            <button class="btn btn-default-sm" type="submit">
                <i class="fa fa-search">search</i>
            </button>
    </form>
    @if(isset($search))
        <table>
            <tr>
                <td>Title</td>
                <td>Author</td>
                <td>ISBN</td>
                <td>Genre</td>
                <td>Publisher</td>
                <td>Year Published</td>
                </tr>
                @if (count($search) > 0)
                @foreach ($search as $book)
                <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->year_published }}</td>
                </tr>
                @endforeach
                @endif
        </table>
    @elseif(isset($message))
    @endif
@endsection