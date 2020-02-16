@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    @if(count($logBooks) > 0)
        <table>
            <tr>
                <th>Actor ID</th>
                <th>Action</th>
                <th>Book ID</th>
                <th>Call Number</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Volume</th>
                <th>Edition</th>
                <th>Year Published</th>
                <th>Publisher</th>
                <th>Genre</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Barcode No</th>
                <th>Book Image</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            @foreach ($logBooks as $logBook)
                <tr>
                    <td>{{$logBook->actor_id}}</td>
                    <td>{{$logBook->action}}</td>
                    <td>{{$logBook->book_id}}</td>
                    <td>{{$logBook->callnumber}}</td>
                    <td>{{$logBook->title}}</td>
                    <td>{{$logBook->author}}</td>
                    <td>{{$logBook->isbn}}</td>
                    <td>{{$logBook->volume}}</td>
                    <td>{{$logBook->edition}}</td>
                    <td>{{$logBook->year_published}}</td>
                    <td>{{$logBook->publisher}}</td>
                    <td>{{$logBook->genre}}</td>
                    <td>{{$logBook->condition}}</td>
                    <td>{{$logBook->status}}</td>
                    <td>{{$logBook->barcodeno}}</td>
                    <td>{{$logBook->book_image}}</td>
                    <td>{{$logBook->created_at}}</td>
                    <td>{{$logBook->update_at}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No Book Logs</p>
    @endif
@endsection