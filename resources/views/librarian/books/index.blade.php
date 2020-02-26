@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Display Books </h1> 
                    
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6">
                            <div class="row" style="margin-left:5px;">
                                Filter:
                                <div class="dropdown" style="text-align: center; margin-left:10px;">
                                    <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="condition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Book Condition
                                    </a>
        
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="condition">
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => 'vgd', 'stts' => request('stts')]) }}">Very Good</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => 'gd', 'stts' => request('stts')]) }}">Good</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => 'fn', 'stts' => request('stts')]) }}">Fine</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => 'fr', 'stts' => request('stts')]) }}">Fair</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => 'pr', 'stts' => request('stts')]) }}">Poor</a>
                                    </div>
                                </div>
        
                                <div class="dropdown" style="text-align: center; margin-left:10px;">
                                    <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Book Status
                                    </a>
        
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="status">
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => request('cndtn'), 'stts' => 'avlbl']) }}">Available</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => request('cndtn'), 'stts' => 'rsrvd']) }}">Reserved</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => request('cndtn'), 'stts' => 'brrwd']) }}">Borrowed</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => request('cndtn'), 'stts' => 'archv']) }}">Archived</a>
                                        <a class="dropdown-item" href="{{ route('librarian.books.index',['cndtn' => request('cndtn'), 'stts' => 'mssng']) }}">Archived</a>
                                    </div>
                                </div>
                                <div style="text-align: center; margin-left:10px;">
                                    <a class="btn btn-sm btn-danger" href="{{ route('librarian.books.index') }}">Clear Filter</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            Sort: 
                            <a href="{{ route('librarian.books.index', ['cndtn' => request('cndtn'), 'stts' => request('stts'), 'srt' => 'asc']) }}">Ascending</a>
                            <a href="{{ route('librarian.books.index', ['cndtn' => request('cndtn'), 'stts' => request('stts'), 'srt' => 'desc']) }}">Descending</a>
                        </div>
                    </div>

                    
                    

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($books) > 0)
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->condition }}</td>
                                        <td>{{ $book->status }}</td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="bookDetails" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bookDetails">
                                                    <a class="dropdown-item" href="#">View Details</a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" style="text-align: center;"><b>No Books Found!</b></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{$books->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection