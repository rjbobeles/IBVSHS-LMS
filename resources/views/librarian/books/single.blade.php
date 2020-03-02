@extends('layouts.app')

@section('content')

<div class="container">
    <h4>
        <strong>Harry Potter and the Philosophers Stone</strong>
    </h4>
    
    <hr/><br/>
    
    <div class="row">
        <div class="col-lg-6 center">
            <div class="gallery">
                <div class="gallery" style="border: 10px solid #6e080f; width:107%; margin-left:3px; background-color:#6e080f;">
                <img class="img-fluid" src=" {{ asset('images/no-image.png') }}" alt="HP books" style="margin-left:3px;">
                </div>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:center">
            <br/><br/>
            
            <h6>
                <b>Author:</b> J.K. Rowling
            </h6>
            
            <br/>
            
            <h6>
                <b>ISBN:</b> 118VBSHS123
            </h6>
            
            <br/>
            
            <div class="row">
                <div class="col-lg-6 center"><h6><b>Edition:</b> Standard</h6></div>
                <div class="col-lg-6 center"><h6><b>Volume:</b> 1</h6></div>
            </div>
            
            <br/>

            <div class="row">
                <div class="col-lg-6 center"><h6><b>Publishing Year:</b> 2010</h6></div>
                <div class="col-lg-6 center"><h6><b>Publisher:</b> Scholastic</h6></div>
            </div>

            <br/><br/>

            <center>
                <div class="card">
                    <div class="card-body">
                        <?php echo DNS1D::getBarcodeSVG("4445", "EAN13") ?>
                    </div>
                </div>

                <br/>
                <a href="#" class="btn btn-lms-solid">Back to books list</a>
            </center>
        </div>
    </div>
</div>
@endsection