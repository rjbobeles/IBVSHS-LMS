@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-header">{{ __('Viewing Patron: ' . $patron->lastname .', '. $patron->firstname) }}</div>
                <div class="card-body">

                <div class="row">
                    <div class="col-5 col-md-4 text-right">Patron ID:</div>
                    <div class="col-5 col-md-6">{{ $patron->id }}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-md-4 text-right">Full Name:</div>
                    <div class="col-5 col-md-6">{{ $patron->lastname }}, {{ $patron->firstname }} {{ $patron->middlename}}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-md-4 text-right">Email:</div>
                    <div class="col-5 col-md-6">{{ $patron->email }}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-md-4 text-right">Contact Number:</div>
                    <div class="col-5 col-md-6">{{ $patron->contactno }}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-md-4 text-right">Role:</div>
                    <div class="col-5 col-md-6">{{ $patron->role }}</div>
                </div>
                @if($patron->role == "Student")
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">LRN Number:</div>
                        <div class="col-5 col-md-6">{{ $patron->lrn }}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-5 col-md-4 text-right">Deactivated:</div>
                    <div class="col-5 col-md-6">
                        @if($patron->deactivated == 1)
                            Deactivated
                        @else
                            Active
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center" style="padding-top: 20px;">
                        <a href="{{ route('admin.patrons.index', $patron->id) }}" class="btn btn-primary">Back to Patrons List</a>
                        <a href="{{ route('admin.patrons.edit', $patron->id) }}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-primary" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-patrons-delete-{{ $patron->id }}').submit(); }">
                            @if($patron->deactivated == 1)
                                Activate Patron
                            @else
                                Deactivate Patron
                            @endif
                            <form id="action-patrons-delete-{{ $patron->id }}" method="POST" action="{{ route('admin.patrons.destroy', $patron->id ) }}">
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
@endsection
