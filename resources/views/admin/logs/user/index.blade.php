@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> User Logs </h1> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>User ID</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logUsers) > 0)
                                @foreach($logUsers as $logUser)
                                    <tr>
                                        <td>{{ $logUser->id}} </td>
                                        <td>{{ $logUser->actor_id}} | {{ $logUser->userLogUserActor->username }} </td>
                                        <td>{{ $logUser->action}} </td>
                                        <td>{{ $logUser->user_id}} </td>
                                        <td>{{ $logUser->created_at}} </td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $logUser->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $logUser->id }}">
                                                    <a class="dropdown-item" href="{{ route('logs.user.show', $logUser->id) }}">View Details</a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center;"><b>No User Logs Found!</b></td>
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