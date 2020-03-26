@extends('layouts.app')

@section('content')
<div class="row text-center page-heading">
        <div class="col">
            <h1 class="mt-4 ">View My Library Record</h1>
            <p class="mb-5">You can view the books you have borrowed and are currently borrowing by providing your name and email address below.</p>
            <hr class="mb-5"/>
        </div>
    </div>
<div class="card">
    <div class="card-body">
        @include('inc.messages')
        <form method="POST" action="{{ route('patron.book.records') }}">
            @csrf
            <div class="row">
                <div class="col-3">
                    <!--Last Name Label and Text Input-->
                    <div class="form-group">
                        <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                        <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" placeholder="Last Name">
                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-3">                 
                    <!--First Name Label and Text Input-->
                    <div class="form-group">
                        <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                        <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" placeholder="First Name">
                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
 
                </div>
                <div class="col-3">
                    <!--Email Label and Text Input-->
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <br>
                    <button type="submit" name="submit" class="btn btn-lms-solid mt-2">
                        {{ __('View Library Record') }}
                    </button>
                </div>
            </div>
        </form>
        <br>
        <!--View Library Records Table-->
        @if ($records != NULL)
            <h3 class="text-center">Library Record of {{ $recordsName->patronTransaction->firstname }} {{ $recordsName->patronTransaction->lastname }}</h3>
            @if (count($records) > 0)
                <br>
                <table class="table table-striped">
                    <tr>
                        <th>Book Title</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->bookTransaction->title }}</td>
                            <td>
                                @if ($record->date_returned != NULL)
                                    Returned
                                @elseif (Carbon\Carbon::now()->toDateString() > $record->date_due)
                                    Overdue                     
                                @else
                                    Currently Borrowing
                                @endif
                            </td>
                            </tr>
                    @endforeach
                </table>            
            @else
                <p>You have no records</p>
            @endif
        @endif
    </div>
</div>
@endsection