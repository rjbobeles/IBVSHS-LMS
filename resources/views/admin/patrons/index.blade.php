@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Patrons <a href="{{route('admin.patrons.create') }}" class="btn btn-primary btn-sm">Add Patron</a> </h1>
                    @include('inc.messages')

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($patrons) > 0)
                                @foreach($patrons as $patron)
                                    <tr>
                                        <td>{{ $patron->id }}</td>
                                        <td>{{ $patron->lastname }}, {{ $patron->firstname }} {{ $patron->middlename }}</td>
                                        <td>{{ $patron->email }}</td>
                                        <th>{{ $patron->role }}</th>
                                        <td>
                                        @if($patron->deactivated == 1)
                                            Deactivated
                                        @else
                                            Active
                                        @endif
                                        </td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $patron->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        ...
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $patron->id }}">
                                                    <a class="dropdown-item" href="{{ route('admin.patrons.show', $patron->id) }}">View Details</a>
                                                    <a class="dropdown-item" href="{{ route('admin.patrons.edit', $patron->id) }}">Edit patron</a>
                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-patron-delete-{{ $patron->id }}').submit(); }">
                                                    @if($patron->deactivated == 1)
                                                        Activate Patron
                                                    @else
                                                        Deactivate Patron
                                                    @endif
                                                    <form id="action-patron-delete-{{ $patron->id }}" method="POST" action="{{ route('admin.patrons.destroy', $patron->id ) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"><b>No Patron Accounts Found!</b></td>
                                </tr>
                            @endif
                        </tbody>
                    </table> 
                    {{ $patrons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection