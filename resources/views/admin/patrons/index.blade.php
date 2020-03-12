@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')

                    <h1 class="page-title"> Patrons <a href="{{route('admin.patrons.create') }}" class="btn btn-lms btn-sm">Add Patron</a> </h1>
                    
                    <table id="patrons-table" class="table table-bordered" style="width:100%">
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
            ajax: '{!! route('admin.patrons.index.data') !!}',
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