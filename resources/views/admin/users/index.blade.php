@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')

                    <h1> Users <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Add User</a> </h1> 
                
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
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}</td>
                                        <td>{{ $user->email }}</td>
                                        <th>{{ $user->role }}</th>
                                        <td>
                                            @if($user->deactivated == 1)
                                                Deactivated
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $user->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $user->id }}">
                                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">View Details</a>
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">Edit user</a>
                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-user-delete-{{ $user->id }}').submit(); }">
                                                        @if($user->deactivated == 1)
                                                            Activate User
                                                        @else
                                                            Deactivate User
                                                        @endif
                                                        
                                                        <form id="action-user-delete-{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id ) }}">
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
                                    <td colspan="5" style="text-align: center;"><b>No User Accounts Found!</b></td>
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