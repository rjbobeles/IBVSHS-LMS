@extends('layouts.app')

@section('content')
    <h1>{{$logTransaction->transaction_id}}</h1>
    <div>
        <p>{{$logTransaction->actor_id}}</p>
        <p>{{$logTransaction->action}}</p>
        <p>{{$logTransaction->transaction_id}}</p>
        <p>{{$logTransaction->date_issued}}</p>
        <p>{{$logTransaction->date_due}}</p>
        <p>{{$logTransaction->date_returned}}</p>
        <p>{{$logTransaction->created_at}}</p>
        <p>{{$logTransaction->updated_at}}</p>
    </div>
@endsection