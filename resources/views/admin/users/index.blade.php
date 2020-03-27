@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')
                    
                    <h1 class="page-title d-inline-block"> Users </h1>
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-lms">+ Add User</a>  
                                    
                    <table id="users-table" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script defer>
    $(function() {
        $('#users-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv' ],
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('users.index.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: true, sortable : true, visible: true },
                { data: 'name', name: 'name', searchable: false, sortable : true, visible: true },
                { data: 'email', name: 'email', searchable: true, sortable : true, visible: true },
                { data: 'role', name: 'role', searchable: false, sortable : true, visible: true},
                { data: 'deactivated', name: 'deactivated', searchable: false, sortable : true, visible: true },
                { data: 'actions', name: 'actions', searchable: false, sortable : false, visible: true },
                { data: 'firstname', name: 'firstname', searchable: true, sortable : true, visible: false },
                { data: 'middlename', name: 'middlename', searchable: true, sortable : true, visible: false },
                { data: 'lastname', name: 'lastname', searchable: true, sortable : true, visible: false }, 
            ]
        });
    });
</script>
@endsection