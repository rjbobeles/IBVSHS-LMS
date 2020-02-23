@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing User Log: '. $logUser->id )}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Issued By:</div>
                        <div class="col-5 col-md-6">{{ $logUser->actor_id }} | {{ $logUser->userLogUserActor->username }} </div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Action:</div>
                        <div class="col-5 col-md-6">{{ $logUser->action }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">User ID:</div>
                        <div class="col-5 col-md-6">{{ $logUser->user_id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Name:</div>
                        <div class="col-5 col-md-6">{{ $logUser->lastname }}, {{ $logUser->firstname }} {{ $logUser->middlename }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Role:</div>
                        <div class="col-5 col-md-6">{{ $logUser->role }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Username:</div>
                        <div class="col-5 col-md-6">{{ $logUser->username }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Contact No:</div>
                        <div class="col-5 col-md-6">{{ $logUser->contactno }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Status:</div>
                        <div class="col-5 col-md-6">{{ $logUser->deactivated }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Email:</div>
                        <div class="col-5 col-md-6">{{ $logUser->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Created At:</div>
                        <div class="col-5 col-md-6">{{ $logUser->created_at }}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('logs.user.index') }}" class="btn btn-primary">Back User Logs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection