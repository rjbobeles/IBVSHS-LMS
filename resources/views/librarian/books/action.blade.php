<div class="dropdown dropleft" style="text-align: center;">
    <a class="btn btn-sm btn-lms-solid dropdown-toggle dropdown-toggle-none" href="#" role="button" id="bookDetails" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ...
    </a>

    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="bookDetails">
        <a class="dropdown-item" href="{{ route('books.show', $id) }}">View Details</a>
        <a class="dropdown-item" href="{{ route('books.edit', $id) }}">Edit Details</a>
    </div>
</div>