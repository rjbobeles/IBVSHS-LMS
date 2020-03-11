@extends('layouts.app')

@section('content')
    <h4><b>Return Book</b></h4>
    <div class="navbooks">
        <a class="#" href="Onborrowedbooks.html">On-Borrowed Books</a></li>
        <a class="active" href="returnbooks.html">Return A Book</a></li>
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <!--Borrowed Book Label with image, title, and author-->
            <h6>Borrowed Book/s:</h6>
            <div class="card book-input-box">
                <div class="card-body text-center">
                    <img class="pb-4" style="width:50%" src="/storage/book_images/{{ $transactions->bookTransaction->book_image }}"/>
                    <h6><b>{{ $transactions->bookTransaction->title }}</b></h6>
                    <small>by {{ $transactions->bookTransaction->author }}</small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <form method="POST" id="return_book_store" action="{{ route('transactions.returnBookStore', $transactions->id) }}">
                @csrf
                <!--Borrowing User Label and Read Only Text Input-->
                <label for="borrowing_user" class="form-label">Borrowing User:</label>
                <input type="text" name="borrowing_user" id="borrowing_user" class="form-control book-input-box" 
                    value="{{ $transactions->patronTransaction->lastname }}, {{ $transactions->patronTransaction->firstname }} {{ $transactions->patronTransaction->middlename }}" readonly/><br>
                <div class="row">
                    <div class="col-6">
                        <!--Borrow Date Label and Read Only Date Input-->
                        <label for="borrow_date" class="form-label">Borrow Date:</label>
                        <input type="date" name="borrow_date" id="borrow_date" class="form-control book-input-box" 
                            value="{{ $transactions->date_issued }}" readonly />
                    </div>
                    <div class="col-6">
                        <!--Date Returned Label and Date Input-->
                        <label for="date_returned" class="form-label">{{ __('Date Returned:') }}</label>
                        <input type="date" name="date_returned" id="date_returned" 
                            class="form-control book-input-box @error('date_returned') is-invalid @enderror" 
                            value="{{ old('date_returned') }}" required placeholder="mm/dd/yyyy"/>
                        @error('date_returned')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
            <textarea name="comment" rows="7" class="form-control book-input-box" form="return_book_store" placeholder="Damage Report...">
            </textarea>
            <br>
            <!--Submit label linked to submit hidden field-->
            <label for="submit_form" class="btn btn-danger confirm" tabindex="0">{{ __('Confirm Returned Books') }}</label>
        </div>
    </div>
@endsection