@extends('layouts.app')
@section('content')
    <form action="{{URL::to('/record')}}" method="get">
        <div class="form-group">
            <input type="search" class="form-control" name="search" placeholder="Input lrn...">
            <button class="btn btn-default" type="submit">
                Search
            </button>
        </div>
    </form>
    <table>
        {{-- @if (isset($record)) --}}
            @if (count($record) > 0)
                <tr>
                    <td>Title</td>
                    <td>Author</td>
                    <td>ISBN</td>
                    <td>Genre</td>
                    <td>Publisher</td>
                    <td>Year Published</td>
                </tr>
                @foreach ($record as $row)
                    <tr>
                        <td>{{ $row->patron_id }}</td>
                        <td>{{ $row->book_id }}</td>
                        <td>{{ $row->firstname }}</td>
                        <td>{{ $row->lastname }}</td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->date_issued }}</td>
                        <td>{{ $row->date_due }}</td>
                        <td>{{ $row->date_returned }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endforeach
            {{-- @else <p>{{$message}}</p>
            @endif --}}
        @endif
    </table>
@endsection
