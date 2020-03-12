@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    <h1 class="page-title"> Transaction Logs </h1> 

                    <table id="log-transaction-table" class="table table-bordered" style="width:100%">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('#log-transaction-table').DataTable({
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('logs.transaction.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'issued_by', name: 'issued_by', searchable: true, sortable : true, visible: true },
                { data: 'action', name: 'action', searchable: false, sortable: true, visible: true },
                { data: 'transaction_id', name: 'transaction_id', searchable: true, sortable: true, visible: true },
                { data: 'created_at', name: 'created_at', searchable: false, sortable: true, visible: true },
                { data: 'actions', name: 'actions', searchable: false, sortable: false, visible: true },
            ]
        });
    });
</script>
@endsection
