@extends('layouts.app')

@section('content')
    <div class="well well-lg">
        <h1>{{ __('Viewing Patron: ' . $patrons->lastname .', '. $patrons->firstname)}}</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-5 col-md-4 text-right">Patrons ID:</div>
            <div class="col-5 col-md-6">{{ $patrons->id }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Full Name:</div>
            <div class="col-5 col-md-6">{{ $patrons->lastname }}, {{ $patrons->firstname }} {{ $patrons->middlename}}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Email:</div>
            <div class="col-5 col-md-6">{{ $patrons->email }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Email Verified At:</div>
            <div class="col-5 col-md-6">{{ $patrons->email_verified_at }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">User ID:</div>
            <div class="col-5 col-md-6">{{ $patrons->contactno }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Username:</div>
            <div class="col-5 col-md-6">{{ $patrons->username }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Role:</div>
            <div class="col-5 col-md-6">{{ $patrons->role }}</div>
        </div>
        <div class="row">
            <div class="col-5 col-md-4 text-right">Deactivated:</div>
            <div class="col-5 col-md-6">
                @if($patrons->deactivated == 1)
                    Deactivated
                @else
                    Active
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col text-center" style="padding-top: 20px;">
                <a href="{{ route('patrons.index', $patrons->id) }}" class="btn btn-primary">Back to Patrons List</a>
                <a href="{{ route('patrons.edit', $patrons->id) }}" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-primary" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-patrons-delete-{{ $patrons->id }}').submit(); }">
                    @if($patrons->deactivated == 1)
                        Activate patrons
                    @else
                        Deactivate patrons
                    @endif
                    <form id="action-patrons-delete-{{ $patrons->id }}" method="POST" action="{{ route('patrons.destroy', $patrons->id ) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </a>
        </div>
    </div>
</div>
@endsection
