@extends('layouts.app')

@section('content')
<div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">Create a Book</h1>
            <p class="mb-5">Add a new book record</p>
            <hr class="mb-5"/>
        </div>
    </div>
<div id="create">
    <div class="container">
        <div class="col-11 mx-auto">
            <div class="card shadow">
                <div class="card-header" id="card-header"> {{ __('Book Details') }} </div>
                <div class="card-body pl-5 pr-5 pb-5">
                <br/>
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <!--Call Number Label and Text Input-->
                                <div class="form-group">
                                    <label for="callnumber" class="form-label">{{ __('Call Number') }}</label>
                                    <input id="callnumber" type="text" class="form-control @error('callnumber') is-invalid @enderror" name="callnumber" value="{{ old('callnumber') }}" required autocomplete="callnumber" placeholder="Call Number">
                                    @error('callnumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Title Label and Text Input-->
                                <div class="form-group">
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" placeholder="Title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Author Label and Text Input-->
                                <div class="form-group">
                                    <label for="author" class="form-label">{{ __('Author') }}</label>
                                    <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required autocomplete="author" placeholder="Author">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--ISBN Label and Text Input-->
                                <div class="form-group">
                                    <label for="isbn" class="form-label">{{ __('ISBN') }}</label>
                                    <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn') }}" required autocomplete="isbn" placeholder="ISBN">
                                    @error('isbn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Volume Label and Text Input-->
                                <div class="form-group">
                                    <label for="volume" class="form-label">{{ __('Volume') }}</label>
                                    <input id="volume" type="text" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}" autocomplete="volume" placeholder="Volume">
                                    @error('volume')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Edition Label and Text Input-->
                                <div class="form-group">
                                    <label for="edition" class="form-label">{{ __('Edition') }}</label>
                                    <input id="edition" type="text" class="form-control @error('edition') is-invalid @enderror" name="edition" value="{{ old('edition') }}" autocomplete="edition" placeholder="Edition">
                                    @error('edition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <!--Year Published Label and Text Input-->
                                <div class="form-group">
                                    <label for="year_published" class="form-label">{{ __('Year Published') }}</label>
                                    <input id="year_published" type="text" class="form-control @error('year_published') is-invalid @enderror" name="year_published" value="{{ old('year_published') }}" required autocomplete="year_published" placeholder="e.g. 2015">
                                    @error('year_published')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Publisher Label and Text Input-->
                                <div class="form-group">
                                    <label for="publisher" class="form-label">{{ __('Publisher') }}</label>
                                    <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}" required autocomplete="publisher" placeholder="Publisher">
                                    @error('publisher')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Genre Label and Text Input-->
                                <div class="form-group">
                                    <label for="genre" class="form-label">{{ __('Genre') }}</label>
                                    <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}" required autocomplete="genre" placeholder="Genre">
                                    @error('genre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Condition Label and Text Input-->
                                <div class="form-group">
                                    <label for="condition" class="form-label">{{ __('Condition') }}</label>
                                    <select id="condition" name="condition" class="form-control">
                                        <option value="Fine">Fine</option>
                                        <option value="Very Good">Very Good</option>
                                        <option value="Good">Good</option>
                                        <option value="Fair">Fair</option>
                                        <option value="Poor">Poor</option>
                                    </select>
                                    @error('condition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Status Label and Text Input-->
                                <div class="form-group">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="Available">Available</option>
                                        <option value="Reserved">Reserved</option>
                                        <option value="Borrowed">Borrowed</option>
                                        <option value="Archived">Archived</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Book Image Label and Text Input-->
                                <div class="form-group">
                                    <label for="book_image" class="form-label">{{ __('Book Image') }}</label><br>
                                    <input id="book_image" type="file" class="@error('book_image') is-invalid @enderror pt-1" name="book_image">
                                    @error('book_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <a href="{{ route('books.index')}}" class="btn shadow btn-secondary">Back</a>
                                <button type="submit" class="btn shadow btn-lms-solid">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
