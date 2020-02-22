@extends('layouts.app')

@section('content')
<div class="container">

<div class="card-header">
    <h1>Add Patron</h1>
</div>
<div class="card-body">
    <form method="post" action="{{route('patrons.store')}}">
    @csrf
    <div class="form-group">
    <label>Role:</label>
        <select class="form-control" name="role">
            <option value="">Select Role...</option>
            <option value="Student">Student</option>
            <option value="Admin">Teacher</option>
        </select>
    </div>
    <div class="form-group">
    <label>First Name:</label>
        <input type="text" class="form-control" name="firstname" required/>
    </div>

    
    <div class="form-group">
    <label>Middle Name:</label>
        <input type="text" class="form-control" name="middlename" required/>
    </div>

    
    <div class="form-group">
    <label>Last Name:</label>
        <input type="text" class="form-control" name="lastname" required/>
    </div>
    
    <div class="form-group">
    <label>Contact Number: </label>
        <input type="text" class="form-control" name="contactno" required/>
    </div>

    <div class="form-group">
    <label>Email: </label>
        <input type="text" class="form-control" name="email" required/>
    </div>

    <input type="submit" class="btn btn-primary" name="submit">
    </form>
    <br/>
    <div class="row">
        <div class="col">
            <a href="{{route('patrons.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>
    </div>
</div>
</div>
@endsection