@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Book Logs </h1> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Status</th>
                                <th>Barcode No</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logBooks) > 0)
                                @foreach($logBooks as $logBook)
                                    <tr>
                                        <td>{{ $logBook->id }}</td>
                                        <td>{{ $logBook->actor_id }} | {{ $logBook->userLogBook->username }}</td>
                                        <td>{{ $logBook->action }}</td>
                                        <td>{{ $logBook->book_id }}</td>
                                        <td>{{ $logBook->title }}</td>
                                        <td>{{ $logBook->author }}</td>
                                        <td>{{ $logBook->isbn }}</td>
                                        <td>{{ $logBook->status }}</td>
                                        <td>{{ $logBook->barcodeno }}</td>
                                        <td>{{ $logBook->created_at }}</td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $logBook->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $logBook->id }}">
                                                    <a class="dropdown-item" href="{{ route('logs.book.show', $logBook->id) }}">View Details</a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" style="text-align: center;"><b>No Book Logs Found!</b></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection