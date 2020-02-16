@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    @if(count($logTransactions) > 0)
        <table>
            <tr>
                <th>Actor ID</th>
                <th>Action</th>
                <th>Transaction ID</th>
                <th>Date Issued</th>
                <th>Date Due</th>
                <th>Date Returned</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            @foreach ($logTransactions as $logTransaction)
                <tr>
                    <td>{{$logTransaction->actor_id}}</td>
                    <td>{{$logTransaction->action}}</td>
                    <td>{{$logTransaction->transaction_id}}</td>
                    <td>{{$logTransaction->date_issued}}</td>
                    <td>{{$logTransaction->date_due}}</td>
                    <td>{{$logTransaction->date_returned}}</td>
                    <td>{{$logTransaction->created_at}}</td>
                    <td>{{$logTransaction->updated_at}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No Transaction Logs</p>
    @endif
@endsection