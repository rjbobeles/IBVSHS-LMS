@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Transaction Logs </h1> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>Transaction ID</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logTransactions) > 0)
                                @foreach($logTransactions as $logTransaction)
                                    <tr>
                                        <td>{{ $logTransaction->id }}</td>
                                        <td>{{ $logTransaction->actor_id }} | {{ $logTransaction->userLogTransaction->username }}</td>
                                        <td>{{ $logTransaction->action }}</td>
                                        <td>{{ $logTransaction->transaction_id }}</td>
                                        <td>{{ $logTransaction->created_at }}</td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $logTransaction->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $logTransaction->id }}">
                                                    <a class="dropdown-item" href="{{ route('logs.transaction.show', $logTransaction->id) }}">View Details</a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center;"><b>No Transaction Logs Found!</b></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection