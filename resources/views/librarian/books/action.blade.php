<div class="dropdown dropleft table-action-menu" style="text-align: center;">
    <a class="btn btn-sm dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>


    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="bookDetails">
        <a class="dropdown-item" href="{{ route('books.show', $id) }}">View Details</a>
        <a class="dropdown-item" href="{{ route('books.edit', $id) }}">Edit Details</a>
    </div>
</div>