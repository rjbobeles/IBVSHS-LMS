@extends('layouts.app')
@section('content')
    <form action="record.blade.php" method="GET" role="search">
        <input type="text" class="form-control" name="search" placeholder="Search a record...">
            <button class="btn btn-default-sm" type="submit">
                <i class="fa fa-search">search</i>
            </button>
    </form>
<table>
        <tr>
            <td>Last Name</td>
            <td>First Name</td>
            <td>Book Title</td>
            <td>Author</td>
            <td>Date Issued</td>
            <td>Date Due</td>
            <td>Status</td>
        </tr>
        @if (count($record) > 0)
            @foreach ($record as $row)
            <tr>
                <td>{{ $row->lastname }}</td>
                <td>{{ $row->firstname }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->author }}</td>
                <td>{{ $row->dateissued }}</td>
                <td>{{ $row->datedue }}</td>
                <td>{{ $row->status }}</td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection