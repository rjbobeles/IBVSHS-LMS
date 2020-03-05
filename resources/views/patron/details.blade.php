@extends('layouts.app')
@section('content')
<table>
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>ISBN</td>
            <td>Genre</td>
            <td>Publisher</td>
            <td>Year Published</td>
            </tr>
            @if (count($books) > 0)
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
            @endif
    </table>
@endsection