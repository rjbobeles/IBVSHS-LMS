@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    @if(count($logUsers) > 0)
        <table>
            <tr>
                <th>Actor ID</th>
                <th>Action</th>
                <th>User ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Username</th>
                <th>Contact No</th>
                <th>Password</th>
                <th>Deactivated</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            @foreach ($logUsers as $logUser)
                <tr>
                    <td>{{$logUser->actor_id}}</td>
                    <td>{{$logUser->action}}</td>
                    <td>{{$logUser->user_id}}</td>
                    <td>{{$logUser->firstname}}</td>
                    <td>{{$logUser->middlename}}</td>
                    <td>{{$logUser->lastname}}</td>
                    <td>{{$logUser->role}}</td>
                    <td>{{$logUser->username}}</td>
                    <td>{{$logUser->contactno}}</td>
                    <td>{{$logUser->password}}</td>
                    <td>{{$logUser->deactivated}}</td>
                    <td>{{$logUser->email}}</td>
                    <td>{{$logUser->created_at}}</td>
                    <td>{{$logUser->update_at}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No User Logs</p>
    @endif
@endsection