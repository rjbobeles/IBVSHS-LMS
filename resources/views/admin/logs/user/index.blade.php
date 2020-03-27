@extends('layouts.app')

@section('title', '- User Logs')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1 class="page-title"> User Logs </h1> 

                    <table id="log-users-table" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>User ID</th>
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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script>
    $(function() {
        $('#log-users-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv' ],
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('logs.user.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'issued_by', name: 'issued_by', searchable: true, sortable : true, visible: true },
                { data: 'action', name: 'action', searchable: false, sortable: true, visible: true },
                { data: 'user_id', name: 'user_id', searchable: true, sortable: true, visible: true },
                { data: 'created_at', name: 'created_at', searchable: false, sortable: true, visible: true },
                { data: 'actions', name: 'actions', searchable: false, sortable: false, visible: true },
            ]
        });
    });
</script>
@endsection
        