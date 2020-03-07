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
            @if (count($getbook) > 0)
            <tr>
            <td>{{ $getbook->title }}</td>
            <td>{{ $getbook->author }}</td>
            <td>{{ $getbook->isbn }}</td>
            <td>{{ $getbook->genre }}</td>
            <td>{{ $getbook->publisher }}</td>
            <td>{{ $getbook->year_published }}</td>
            </tr>
            @endif
    </table>
@endsection