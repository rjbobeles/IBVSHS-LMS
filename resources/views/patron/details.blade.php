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
            <tr>
            <td>{{ $books->title }}</td>
            <td>{{ $books->author }}</td>
            <td>{{ $books->isbn }}</td>
            <td>{{ $books->genre }}</td>
            <td>{{ $books->publisher }}</td>
            <td>{{ $books->year_published }}</td>
            </tr>
    </table>
@endsection