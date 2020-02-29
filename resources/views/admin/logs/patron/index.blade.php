@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1> Patron Logs </h1> 
                    
                    <table id="log-patron-table" class="table table-bordered" style="width:100%">
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
                                <th>Actions</th>
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
<script defer>
    $(function() {
        $('#log-patron-table').DataTable({
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('logs.patron.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'issued_by', name: 'issued_by', searchable: true, sortable : true, visible: true },
                { data: 'action', name: 'action', searchable: false, sortable : true, visible: true },
                { data: 'role', name: 'role', searchable: false, sortable : true, visible: true},
                { data: 'patron_id', name: 'patron_id', searchable: false, sortable : true, visible: true },
                { data: 'name', name: 'name', searchable: true, sortable : true, visible: false }, 
                { data: 'deactivated', name: 'deactivated', searchable: false, sortable : true, visible: true }, 
                { data: 'created_at', name: 'created_at', searchable: false, sortable : true, visible: true }, 
                { data: 'actions', name: 'actions', searchable: false, sortable : false, visible: true }, 
            ]
        });
    });
</script>
@endsection