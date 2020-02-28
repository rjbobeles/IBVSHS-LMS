@extends('layouts.app')

@section('content')
<div class="container" id="manageLibrary">
    <div class="col">
        <h4><b>Manage Book Records</b></h4>
        <!--<div class="navbooks">
            <a class="active" href="ManageLibrary.html">All Books</a></li>
            <a class="#" href="Onborrowedbooks.html">On-Borrowed Books</a></li>
            <a class="#" href="MissingBooks.html">Missing/Lost Books</a></li>
            <a class="#" href="Damagedbooks.html">Damaged Books</a></li>
            <a class="#" href="expiredcopyrightbooks.html">Expired Copyright Books</a></li>
        </div>-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="#" class="searchbar">
                <input type="search" name="search" id="search" placeholder="Search Books...">
                <input type="submit" value="&#xf002;">
            </form>
        </div>
        <div class="col-md-6">
            <div class="options">
                <a href="{{ route('librarian.books.create') }}" class="btn mr-3">
                    <i class="fa fa-plus">&nbsp;</i>Add New Book
                </a>
            </div>
        </div>
    </div>
    <div class="row filter">
        <div class="col-md-6">
            <div class="row" id="filterChoices">
                Filter:
                <div class="dropdown" id="filterChoices">
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

                <div class="dropdown" id="filterChoices">
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
                <div id="filterChoices">
                    <a class="btn btn-sm btn-danger" href="{{ route('librarian.books.index') }}">Clear Filter</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 sort">
            Sort: 
                <a href="{{ route('librarian.books.index', ['cndtn' => request('cndtn'), 'stts' => request('stts'), 'srt' => 'asc']) }}">Ascending</a>
                <a href="{{ route('librarian.books.index', ['cndtn' => request('cndtn'), 'stts' => request('stts'), 'srt' => 'desc']) }}">Descending</a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="headcolor">
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="body">
            @if(count($books) > 0)
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->condition }}</td>
                        <td>{{ $book->status }}</td>
                        <th id="action">
                            <div class="dropdown dropright">
                                <a class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $book->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $book->id }}">
                                    <a class="dropdown-item" href="#">View Book Records</a>
                                    <a class="dropdown-item" href="{{ route('librarian.books.edit', $book->id) }}">Edit</a>
                                    <a class="dropdown-item" href="#">Mark As Lost/Missing</a>
                                    <a class="dropdown-item" href="#">Report Damage</a>
                                    <a class="dropdown-item" href="#">Remove</a>
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
@endsection