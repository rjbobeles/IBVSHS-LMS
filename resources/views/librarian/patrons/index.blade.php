@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="col-md-12">
		@include('inc.messages')
        <h1 class="page-title"><strong>Patrons</strong><a href="{{route('patrons.create') }}" class="btn btn-lms btn-sm">Add Patron</a></h1>
        <hr/>
        <div class="row mt-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover shadow" id="data-table">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
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
        $('#patrons-table').DataTable({
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('patrons.index.data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: true, sortable : true, visible: true },
                { data: 'name', name: 'name', searchable: false, sortable : true, visible: true },
                { data: 'email', name: 'email', searchable: true, sortable : true, visible: true },
                { data: 'role', name: 'role', searchable: false, sortable : true, visible: true},
                { data: 'deactivated', name: 'deactivated', searchable: false, sortable : true, visible: true },
                { data: 'actions', name: 'actions', searchable: false, sortable : false, visible: true },
                { data: 'lrn', name: 'lrn', searchable: true, sortable : false, visible: false },
                { data: 'firstname', name: 'firstname', searchable: true, sortable : true, visible: false },
                { data: 'middlename', name: 'middlename', searchable: true, sortable : true, visible: false },
                { data: 'lastname', name: 'lastname', searchable: true, sortable : true, visible: false }, 
            ]
        });
    });
</script>
@endsection
