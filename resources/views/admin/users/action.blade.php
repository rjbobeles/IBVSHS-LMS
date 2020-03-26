<div class="dropdown dropleft table-action-menu" style="text-align: center;">
    <a class="btn btn-sm dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="action-{{ $id }}">
        <a class="dropdown-item" href="{{ route('users.show', $id) }}">View Details</a>
        <a class="dropdown-item" href="{{ route('users.edit', $id) }}">Edit user</a>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-user-delete-{{ $id }}').submit(); }">
            @if($deactivated == 1)
                Activate User
            @else
                Deactivate User
            @endif
            
            <form id="action-user-delete-{{ $id }}" method="POST" action="{{ route('users.destroy', $id ) }}">
                @csrf
                @method('DELETE')
            </form>
        </a>
    </div>
</div>