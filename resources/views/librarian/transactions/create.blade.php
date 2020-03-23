@extends('layouts.app')

@section('content')
    @include('inc.messages')
    <form method="POST" action="{{ route('transactions.store') }}" autocomplete="off">
        @csrf
        <div class=row>
            <div class="col-4">
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
            <div class="col-4">
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
            <div class="col-4">
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
        <button type="submit" class="btn btn-danger confirm">
            {{ __('Issue Books') }}
        </button>
    </form>
@endsection

