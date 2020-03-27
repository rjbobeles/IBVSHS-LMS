@extends('layouts.app')

@section('content')
    <div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">Return a Book</h1>
            <p class="mb-5">Mark a borrowed book as returned. <br /> 
                If a book is being returned in a damaged state, fill in the necessary details to create a Damage Report. 
            </p>
            <hr class="mb-5"/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <!--Borrowed Book Label with image, title, and author-->
            <div class="card book-input-box">
                <div class="card-body text-center">
                    <img class="pb-4" style="width:50%;" src="@if($transactions->bookTransaction->book_image == 'no-image.png') {{ asset('images/no-image.png') }}  @else {{ asset('storage/book_images/' . $transactions->bookTransaction->book_image) }} @endif "/>
                    <h6><b>{{ $transactions->bookTransaction->title }}</b></h6>
                    <small>by {{ $transactions->bookTransaction->author }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <form method="POST" id="return_book_store" action="{{ route('transactions.returnBookStore', $transactions->id) }}">
                @csrf
                <!--Borrowing User Label and Read Only Text Input-->
                <label for="borrowing_user" class="form-label">Borrower:</label>
                <input type="text" name="borrowing_user" id="borrowing_user" class="form-control book-input-box" 
                    value="{{ $transactions->patronTransaction->lastname }}, {{ $transactions->patronTransaction->firstname }} {{ $transactions->patronTransaction->middlename }}" readonly/><br>
                <div class="row">
                    <div class="col-6">
                        <!--Borrow Date Label and Read Only Date Input-->
                        <label for="borrow_date" class="form-label">Borrow Date:</label>
                        <input type="date" name="borrow_date" id="borrow_date" class="form-control book-input-box" 
                            value="{{ $transactions->date_issued }}" readonly />
                    </div>
                </div>
                <!--patron_id hidden field-->
                <input type="text" name="patron_id" id="patron_id" value="{{ $transactions->patron_id }}" hidden/>
                <!--book_id hidden field-->
                <input type="text" name="book_id" id="book_id" value="{{ $transactions->book_id }}" hidden/>
                <br>
                <div class="row">
                    <div class="col-6">
                        <!--Condition Label and Text Input-->
                        <div class="form-group">
                            <label for="condition" class="form-label">{{ __('Book Condition:') }}</label>
                            <select id="condition" name="condition" class="form-control book-input-box">
                                <option @if($transactions->bookTransaction->condition == "Fine") selected @endif value="Fine">Fine</option>
                                <option @if($transactions->bookTransaction->condition == "Very Good") selected @endif value="Very Good">Very Good</option>
                                <option @if($transactions->bookTransaction->condition == "Good") selected @endif value="Good">Good</option>
                                <option @if($transactions->bookTransaction->condition == "Fair") selected @endif value="Fair">Fair</option>
                                <option @if($transactions->bookTransaction->condition == "Poor") selected @endif value="Poor">Poor</option>
                            </select>
                            @error('condition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <!--Status Label and Text Input-->
                        <div class="form-group">
                            <label for="status" class="form-label">{{ __('Book Status:') }}</label>
                            <select id="status" name="status" class="form-control book-input-box">
                                <option value="Available">Returned</option>
                                <option value="Missing">Missing</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!--Submit hidden field-->
                <input type="submit" id="submit_form" hidden/>
            </form>
            <br>
            <!--Damage Report Textarea Input-->
            {{-- <textarea name="comment" rows="7" class="form-control book-input-box" form="return_book_store" placeholder="Damage Report...">
            </textarea> --}}
        </div>
    </div>
    <hr class="mt-5"/> 
    <div class="row">
        <div class="container pt-3">
            <h3 class="d-block"><strong>Damage Report</strong></h3>
            Fill in the details below only if the book is being returned in <strong> a damaged state</strong> compared to when it was issued. 
            <div class="col-12 mx-auto pt-4"></div>
                <div class="card shadow ">
                    <div class="card-body">
                        <form action="{{ route('transactions.returnBookStore', $transactions->id) }}" method="POST">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-row mb-3">
                                        <label for="booktitle">Book Title</label>
                                        <input type="text" name="booktitle" id="booktitle" class="form-control" value="{{ $transactions->bookTransaction->title }}" readonly>
                                    </div> 
                                    <div class="form-row mb-3">
                                        <label for="date_damaged">Date Damage was Discovered</label>
                                        <input type="date" name="date_returned" id="date_damaged" 
                                        class="form-control book-input-box @error('date_returned') is-invalid @enderror" 
                                        value="{{ $transactions->date_issued }}" readonly />
                                    </div>
                                    <div class="form-row mb-3">
                                        <label for="borrower_dr">Borrower</label>
                                        <input type="text" name="borrower" class="form-control" id="borrower_dr"
                                        value="{{ $transactions->patronTransaction->lastname }}, {{ $transactions->patronTransaction->firstname }} {{ $transactions->patronTransaction->middlename }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row mb-3">
                                        <label for="comment_dr">Comment</label>
                                        <textarea name="comment" id="comment_dr" class="form-control" placeholder="Describe the damage..." form="return_book_store"></textarea>
                                    </div>
                                </div>
                            </div> 
                            <br/>
                        </form>
                    </div>
                </div>  
            </div>
            <br/><br/><br/>

        <br>
        <!--Submit label linked to submit hidden field-->
    </div>
        <div class="row mt-5">
            <div class="col-md-12 justify-content-end d-flex mt-3">
            <label for="submit_form" class="btn btn-lms-solid confirm" tabindex="0">{{ __('Confirm Returned Book') }}</label>
            </div>
            
        </div>
@endsection

@section('scripts')
<script src="{{ asset('js/ajax.js') }}"></script>
@endsection