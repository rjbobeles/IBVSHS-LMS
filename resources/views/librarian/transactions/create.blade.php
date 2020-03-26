@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">Issue a Book</h1>
            <p class="mb-5">Issue a book to a students or teachers with an existing Library Record <br /> 
                If student or teacher does not have an existing record with the library, <a href="{{route('patrons.create') }}">Create a Patron Record</a> first. 
            </p>
            <hr class="mb-5"/>
        </div>
    </div>
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-5 shadow">
               

                <div class="card-body my-4">
                    <form method="POST" action="{{ route('transactions.store') }}" autocomplete="off">
                        @csrf
                        <div class=row>
                            <div class="col-md-4">
                                <!--Borrower Label and Text Input-->
                                <div class="form-group">
                                    <label for="borrower" class="form-label">{{ __('Borrower:') }}</label>
                                    <input type="text" name="borrower" id="borrower" class="form-control book-input-box @error('borrower') is-invalid @enderror" value="{{ old('borrower') }}" required placeholder="Enter Borrower's Name" autocomplete="off"/>
                                    @error('borrower')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="patronList" style="position:relative"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!--Book Label and Text Input-->
                                <div class="form-group">
                                    <label for="book" class="form-label">{{ __('Book:') }}</label>
                                    <input type="text" name="book" id="book" class="form-control book-input-box @error('book') is-invalid @enderror" value="{{ old('book') }}" required placeholder="Enter Book Title" autocomplete="off"/>
                                    @error('book')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="bookList" style="position:relative"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!--Date Due Label and Text Input-->
                                <div class="form-group">
                                    <label for="date_due" class="form-label">{{ __('Return Date:') }}</label>
                                    <input type="date" name="date_due" id="date_due" class="form-control book-input-box @error('date_due') is-invalid @enderror" value="{{ old('date_due') }}" required placeholder="YYYY-MM-DD" />
                                    @error('date_due')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-lms-solid confirm ml-auto mt-2">
                                {{ __('Issue Book') }}
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div> 
@endsection

