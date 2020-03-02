<div class="dropdown dropleft" style="text-align: center;">
    <a class="btn btn-sm btn-lms-solid dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ...
    </a>

    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="action-{{ $id }}">
        <a class="dropdown-item" href="{{ route('patrons.show', $id) }}">View Details</a>
        <a class="dropdown-item" href="{{ route('patrons.edit', $id) }}">Edit patron</a>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('action-patron-delete-{{ $id }}').submit(); }">
            @if($deactivated == 1)
                Activate Patron
            @else
                Deactivate Patron
            @endif
            <form id="action-patron-delete-{{ $id }}" method="POST" action="{{ route('patrons.destroy', $id ) }}">
                @csrf
                @method('DELETE')
            </form>
        </a>
    </div>
</div>
