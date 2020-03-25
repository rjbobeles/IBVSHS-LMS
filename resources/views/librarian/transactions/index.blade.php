@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="col-md-12">
		@include('inc.messages')
        <h1 class="page-title"><strong>Borrowed Books</strong></h1>
        <hr/>
        <div class="row mt-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover shadow" id="data-table">
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
