<div class="dropdown dropright" style="text-align: center;">
    <a class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-none" href="#" role="button" id="action-{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ...
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-{{ $id }}">
        <a class="dropdown-item" href="{{ route('logs.transaction.show', $id) }}">View Details</a>
    </div>
</div>