@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Patron Logs </h1> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>Role</th>
                                <th>Patron ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logPatrons) > 0)
                                @foreach($logPatrons as $logPatron)
                                    <tr>
                                        <td>{{ $logPatron->id }}</td>
                                        <td>{{ $logPatron->actor_id }} | {{ $logPatron->userLogPatron->username }}</td>
                                        <td>{{ $logPatron->action }}</td>
                                        <td>{{ $logPatron->role }}</td>
                                        <td>{{ $logPatron->patron_id }}</td>
                                        <td>{{ $logPatron->lastname }}, {{ $logPatron->firstname }} {{ $logPatron->middlename }}</td>
                                        <td>{{ $logPatron->deactivated }}</td>
                                        <td>{{ $logPatron->created_at }}</td>
                                        <th>
                                            <div class="dropdown dropright" style="text-align: center;">
                                                <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $logPatron->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $logPatron->id }}">
                                                    <a class="dropdown-item" href="{{ route('logs.patron.show', $logPatron->id) }}">View Details</a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center;"><b>No Patron Logs Found!</b></td>
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