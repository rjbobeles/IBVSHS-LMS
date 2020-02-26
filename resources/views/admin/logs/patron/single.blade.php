@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing User: '. $logPatron->id )}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Issued By:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->actor_id }} | {{ $logPatron->userLogPatron->username }} </div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Action:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->action }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Role:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->role }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Patron ID:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->patron_id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Name:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->lastname }}, {{ $logPatron->firstname }} {{ $logPatron->middlename }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Email:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Contact No.:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->contactno }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Status:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->deactivated }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Created At:</div>
                        <div class="col-5 col-md-6">{{ $logPatron->created_at }}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('logs.patron.index') }}" class="btn btn-primary">Back Patron Logs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection