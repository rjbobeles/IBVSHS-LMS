@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing Transaction Log: '. $logTransaction->id )}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Issued By:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->actor_id }} | {{ $logTransaction->userLogTransaction->username }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Action:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->action }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Transaction ID:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->transaction_id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Issued:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->date_issued }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Due:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->date_due }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Returned:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->date_returned }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Created At:</div>
                        <div class="col-5 col-md-6">{{ $logTransaction->created_at }}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('logs.transaction.index') }}" class="btn btn-primary">Back Transaction Logs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection