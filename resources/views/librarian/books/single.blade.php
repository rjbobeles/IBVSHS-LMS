@extends('layouts.app')

@section('title', '- Book')
@section('content')
<div class="container">
    <h4>
        <strong>{{ $book->title}}</strong>
    </h4>
    
    <hr/><br/>
    
    <div class="row">
        <div class="col-lg-6 center">
            <div class="gallery">
                <div class="gallery" style="border: 10px solid #6e080f; width:107%; margin-left:3px; background-color:#6e080f;">
                <img class="img-fluid" src="@if($book->book_image == 'no-image.png') {{ asset('images/no-image.png') }}  @else {{ asset('storage/book_images/' . $book->book_image) }} @endif " alt="Book Picture" style="margin-left:3px;">
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:center">
            <br/><br/>

            <h6>    
                <b>Author:</b> {{ $book->author }}
            </h6>
            
            <br/>
            
            <h6>   
                <b>ISBN:</b> {{ $book->isbn }} 
            </h6>
            
            <br/>
            
            <div class="row">
                <div class="col-lg-6 center"><h6><b>Edition:</b> {{ $book->edition }}</h6></div>
                <div class="col-lg-6 center"><h6><b>Volume:</b> {{ $book->volume }} </h6></div>
            </div>
        
            <div class="row">
                <div class="col-lg-6 center"><h6><b>Publishing Year:</b> {{ $book->year_published }}</h6></div>
                <div class="col-lg-6 center"><h6><b>Publisher:</b> {{ $book->publisher }} </h6></div>
            </div>

            <div class="row">
                <div class="col-lg-6 center"><h6><b>Condition:</b> {{ $book->condition }}</h6></div>
                <div class="col-lg-6 center"><h6><b>Status:</b>  {{ $book->status }} </h6></div>
            </div>
            
            <br/><br/>

            <center>
                <div class="card">
                    <div class="card-body">
                        <?php echo DNS1D::getBarcodeSVG($book->barcodeno, "EAN13") ?>
                    </div>
                </div>

                <br/>
                <a href="{{ route('books.barcode', $book->id) }}" class="btn btn-secondary">Download Barcode</a>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to books list</a>
            </center>
        </div>
    </div>
    <br><br><br>
    <hr>
    <h4>Borrowing Log</h4> 
                    
    <table id="books-table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patron</th>
                <th>Date Issued</th>
                <th>Date Due</th>
                <th>Date Returned</th>
            </tr>
        </thead>
    </table>
    <br><br><br>
    <hr>
    <h4>Damage Report Log</h4> 
                    
    <table id="damage-table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patron</th>
                <th>Issued By</th>
                <th>Comments</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script defer>
    $(function() {
        $('#books-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv'],
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('books.show.data', $book->id) !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'patron', name: 'patron', searchable: true, sortable : true, visible: true },
                { data: 'date_issued', name: 'date_issued', searchable: true, sortable : true, visible: true },
                { data: 'date_due', name: 'date_due', searchable: true, sortable : false, visible: true },
                { data: 'date_returned', name: 'date_due', searchable: true, sortable : false, visible: true },
            ]
        });

        $('#damage-table').DataTable({
            dom:  "<'row'<'col-sm-12 col-md-6'B>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [ 'print', 'csv'],
            processing: true,
            serverside: true,
            responsive: true,
            "scrollX": true,
            ajax: '{!! route('damage.show.data', $book->id) !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, sortable : true, visible: true },
                { data: 'patron', name: 'patron', searchable: true, sortable : true, visible: true },
                { data: 'actor', name: 'actor', searchable: true, sortable : true, visible: true },
                { data: 'comment', name: 'comment', searchable: false, sortable : false, visible: true },
            ]
        });

    });
</script>
@endsection