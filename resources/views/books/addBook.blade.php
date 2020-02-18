@extends('layouts.app')

@section('content')
    <h1>Add Book</h1>
    {!! Form::open(['action' => 'BookController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-6">
                <!--Call Number Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('callnumber', 'Call Number') }}
                    {{ Form::text('callnumber', '', ['class' => 'form-control', 'placeholder' => 'Call Number']) }}
                </div>
                <!--Title Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
                </div>
                <!--Author Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('author', 'Author') }}
                    {{ Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author']) }}
                </div>
                <!--ISBN Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('isbn', 'ISBN') }}
                    {{ Form::text('isbn', '', ['class' => 'form-control', 'placeholder' => 'ISBN']) }}
                </div>
                <!--Volume Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('volume', 'Volume') }}
                    {{ Form::text('volume', '', ['class' => 'form-control', 'placeholder' => 'Volume']) }}
                </div>
                <!--Edition Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('edition', 'Edition') }}
                    {{ Form::text('edition', '', ['class' => 'form-control', 'placeholder' => 'Edition']) }}
                </div>
            </div>
            <div class="col-6">
                <!--Year Published Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('year_published', 'Year Published') }} <br>
                    {{ Form::text('year_published', '', ['class' => 'form-control', 'placeholder' => 'e.g., 2015'] ) }}
                </div>
                <!--Publisher Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('publisher', 'Publisher') }}
                    {{ Form::text('publisher', '', ['class' => 'form-control', 'placeholder' => 'Publisher']) }}
                </div>
                <!--Genre Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('genre', 'Genre') }}
                    {{ Form::text('genre', '', ['class' => 'form-control', 'placeholder' => 'Genre']) }}
                </div>
                <!--Condition Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('condition', 'Condition') }}
                    {{ Form::text('condition', '', ['class' => 'form-control', 'placeholder' => 'Condition']) }}
                </div>
                <!--Status Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::text('status', '', ['class' => 'form-control', 'placeholder' => 'Status']) }}
                </div>
                <!--Book Image Label and Text Input-->
                <div class="form-group">
                    {{ Form::label('book_image', 'Book Image') }} <br>
                    {{ Form::file('book_image') }}
                </div>
            </div>
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}        
    {!! Form::close() !!}
@endsection
