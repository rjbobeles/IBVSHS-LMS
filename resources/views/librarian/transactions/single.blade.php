@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing Transaction: ' . $transaction->id) }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Transaction ID:</div>
                        <div class="col-5 col-md-6">{{ $transaction->id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Borrower:</div>
                        <div class="col-5 col-md-6">{{ $transaction->patronTransaction->lrn }} | {{ $transaction->patronTransaction->lastname }}, {{ $transaction->patronTransaction->firstname }} {{ $transaction->patronTransaction->middlename }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Borrower Position:</div>
                        <div class="col-5 col-md-6">{{ $transaction->patronTransaction->role }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Book:</div>
                        <div class="col-5 col-md-6">{{ $transaction->bookTransaction->barcodeno }} | {{ $transaction->bookTransaction->title }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Issued:</div>
                        <div class="col-5 col-md-6">{{ $transaction->date_issued }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Due:</div>
                        <div class="col-5 col-md-6">{{ $transaction->date_due }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Date Returned:</div>
                        <div class="col-5 col-md-6">{{ $transaction->date_returned }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Transaction Status:</div>
                        <div class="col-5 col-md-6">
                            @if($transaction->date_returned != "" || $transaction->date_returned != null)
                                Returned
                            @else
                                Not Returned
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('transactions.index') }}" class="btn btn-primary">Back to Transactions List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection