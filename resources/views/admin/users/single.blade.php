@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing User: ' . $user->username)}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">User ID:</div>
                        <div class="col-5 col-md-6">{{ $user->id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Full Name:</div>
                        <div class="col-5 col-md-6">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename}}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Email:</div>
                        <div class="col-5 col-md-6">{{ $user->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Email Verified At:</div>
                        <div class="col-5 col-md-6">{{ $user->email_verified_at }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">User ID:</div>
                        <div class="col-5 col-md-6">{{ $user->contactno }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Username:</div>
                        <div class="col-5 col-md-6">{{ $user->username }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Role:</div>
                        <div class="col-5 col-md-6">{{ $user->role }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Deactivated:</div>
                        <div class="col-5 col-md-6">
                            @if($user->deactivated == 1)
                                Deactivated
                            @else
                                Active
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('users.index', $user->id) }}" class="btn btn-primary">Back Users List</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-primary" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-user-delete-{{ $user->id }}').submit(); }">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection