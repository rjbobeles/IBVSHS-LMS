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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script defer>
    $(function() {
        $('#transactions-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv'],
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