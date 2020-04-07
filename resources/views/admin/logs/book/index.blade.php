@extends('layouts.app')

@section('title', '- Book Logs')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')

                    <h1 class="page-title"> Book Logs </h1> 

                    <table id="log-books-table" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Issued By</th>
                                <th>Action</th>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>ISBN</th>
                                <th>Status</th>
                                <th>Barcode No</th>
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
        $('#log-books-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv' ],
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('logs.book.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'issued_by', name: 'issued_by', searchable: true, sortable : true, visible: true },
                { data: 'action', name: 'action', searchable: false, sortable: true, visible: true },
                { data: 'book_id', name: 'book_id', searchable: false, sortable: true, visible: true },
                { data: 'title', name: 'title', searchable: true, sortable: true, visible: true },
                { data: 'isbn', name: 'isbn', searchable: true, sortable: true, visible: true },
                { data: 'status', name: 'status', searchable: false, sortable: true, visible: true },
                { data: 'barcodeno', name: 'barcodeno', searchable: true, sortable: false, visible: true },
                { data: 'created_at', name: 'created_at', searchable: false, sortable: true, visible: true },
                { data: 'actions', name: 'actions', searchable: false, sortable: false, visible: true },
            ]
        });
    });
</script>
@endsection
                    