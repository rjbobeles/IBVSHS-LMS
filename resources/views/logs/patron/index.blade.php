@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    @if(count($logPatrons) > 0)
        <table>
            <tr>
                <th>Actor ID</th>
                <th>Action</th>
                <th>Role</th>
                <th>Patron ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Deactivated</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            @foreach ($logPatrons as $logPatron)
                <tr>
                    <td>{{$logPatron->actor_id}}</td>
                    <td>{{$logPatron->action}}</td>
                    <td>{{$logPatron->role}}</td>
                    <td>{{$logPatron->patron_id}}</td>
                    <td>{{$logPatron->firstname}}</td>
                    <td>{{$logPatron->middlename}}</td>
                    <td>{{$logPatron->lastname}}</td>
                    <td>{{$logPatron->email}}</td>
                    <td>{{$logPatron->contactno}}</td>
                    <td>{{$logPatron->deactivated}}</td>
                    <td>{{$logPatron->created_at}}</td>
                    <td>{{$logPatron->update_at}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No Patron Logs</p>
    @endif
@endsection