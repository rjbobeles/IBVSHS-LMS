@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('transactions.update', $transactions->id) }}">
        @method('PUT')
        <div class=row>
            <div class="col-3">
                <!--Borrower Label and Text Input-->
                <div class="form-group">
                    <label for="borrower_name" class="form-label">{{ __('Borrower') }}</label>
                    <input type="text" name="borrower_name" id="borrower_name" class="form-control @error('borrower_name') is-invalid @enderror" value="{{ $transactions->patronTransaction->lastname }}, {{ $transactions->patronTransaction->firstname }} {{ $transactions->patronTransaction->middlename }}" required placeholder="Enter Borrower's Name" />
                    @error('borrower_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="patronList" style="position: relative"></div>
                </div>
                {{ csrf_field() }}
            </div>
            <div class="col-3">
                <!--Book Label and Text Input-->
                <div class="form-group">
                    <label for="book_title" class="form-label">{{ __('Book') }}</label>
                    <input type="text" name="book_title" id="book_title" class="form-control @error('book_title') is-invalid @enderror" value="{{ $transactions->bookTransaction->title }}" required placeholder="Enter Book Title" />
                    @error('book_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="bookList" style="position: relative"></div>
                </div>
            </div>
            <div class="col-3">
                <!--Borrow Date Label and Text Input-->
                <div class="form-group">
                    <label for="date_issued" class="form-label">{{ __('Borrow Date') }}</label>
                    <input type="date" name="date_issued" id="date_issued" class="form-control @error('date_issued') is-invalid @enderror" value="{{ $transactions->date_issued }}" required placeholder="mm/dd/yyyy" />
                    @error('date_issued')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-3">
                <!--Date Due Label and Text Input-->
                <div class="form-group">
                    <label for="date_due" class="form-label">{{ __('Return Date') }}</label>
                    <input type="date" name="date_due" id="date_due" class="form-control @error('date_due') is-invalid @enderror" value="{{ $transactions->date_due }}" required placeholder="mm/dd/yyyy" />
                    @error('date_due')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('Submit') }}
        </button>
    </form>
@endsection

