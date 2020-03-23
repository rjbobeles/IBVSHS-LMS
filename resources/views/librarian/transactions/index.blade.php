@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')

                    <h1 class="page-title"> Borrowed Books </h1>
                    
                    <table id="transactions-table" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patron</th>
                                <th>Book</th>
                                <th>Status</th>
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
        $('#transactions-table').DataTable({
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('transactions.index.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: true, sortable : true, visible: true },
                { data: 'patron', name: 'patron', searchable: true, sortable : true, visible: true },
                { data: 'book', name: 'book', searchable: true, sortable : true, visible: true },
                { data: 'status', name: 'status', searchable: false, sortable: true, visible: true},
                { data: 'actions', name: 'actions', searchable: false, sortable : false, visible: true },
                { data: 'patron_id', name: 'patron_id', searchable: true, sortable : false, visible: false },
                { data: 'book_id', name: 'book_id', searchable: true, sortable : false, visible: false },
            ]
        });
    });
</script>
@endsection