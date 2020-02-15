@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">        
            <div class="card">
                <div class="card-body">
                    @include('inc.messages')

                    <h1> Users </h1>
                
                    @if(count($users) > 0)
                        @foreach($users as $user)
                           {{ $user->password }}
                        @endforeach
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection