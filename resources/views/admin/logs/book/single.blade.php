@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Viewing User: '. $logBook->id )}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Issued By:</div>
                        <div class="col-5 col-md-6">{{ $logBook->actor_id }} | {{ $logBook->userLogBook->username }} </div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Action:</div>
                        <div class="col-5 col-md-6">{{ $logBook->action }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Book ID:</div>
                        <div class="col-5 col-md-6">{{ $logBook->book_id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Call No.:</div>
                        <div class="col-5 col-md-6">{{ $logBook->callnumber }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Title:</div>
                        <div class="col-5 col-md-6">{{ $logBook->title }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Author:</div>
                        <div class="col-5 col-md-6">{{ $logBook->author }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">ISBN:</div>
                        <div class="col-5 col-md-6">{{ $logBook->isbn }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Volume:</div>
                        <div class="col-5 col-md-6">{{ $logBook->volume }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Edition:</div>
                        <div class="col-5 col-md-6">{{ $logBook->edition }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Year Published:</div>
                        <div class="col-5 col-md-6">{{ $logBook->year_published }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Publisher:</div>
                        <div class="col-5 col-md-6">{{ $logBook->publisher }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Genre:</div>
                        <div class="col-5 col-md-6">{{ $logBook->genre }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Condition:</div>
                        <div class="col-5 col-md-6">{{ $logBook->condition }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Status:</div>
                        <div class="col-5 col-md-6">{{ $logBook->status }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Barcode No.:</div>
                        <div class="col-5 col-md-6">{{ $logBook->barcodeno }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Book Image:</div>
                        <div class="col-5 col-md-6">{{ $logBook->book_image }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5 col-md-4 text-right">Created At:</div>
                        <div class="col-5 col-md-6">{{ $logBook->created_at }}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col text-center" style="padding-top: 20px;">
                            <a href="{{ route('logs.book.index') }}" class="btn btn-primary">Back Book Logs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection