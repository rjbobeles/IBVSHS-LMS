@extends('layouts.app')

@section('content')
<div class="container" id="homepage">
    <form action="#" class="searchbar">
        <input type="search" name="search" id="search" placeholder="Search Books...">
        <input type="submit" value="&#xf002;" style="display:none;">
    </form>
    <br/>
    <div class="container center">
        <div class="row">
            <div class="col-sm-6">
                <br/>
                <div class="thumbnail">
                    <a href="{{ route('books.index') }}"> 
                        <img src="{{ asset('images/library/managelibicon.png') }}" title="ManageLibrary" alt="managelib" class="center">
                        <div class="caption">
                            <h6><a href="{{ route('books.index') }}">Manage Library</a></h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <br/>
                <div class="thumbnail">
                    <a href="Book Issuance.html">
                        <img src="{{ asset('images/library/bookissuance.png') }}" title="BookIssuance" alt="bookIssuance" class="center">
                        <div class="caption">
                            <h6 class="adjust"><a href=''>Book Issuance<br/> (Borrow Book)</a></h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-sm-6">
                <br/>
                <div class="thumbnail">
                    <a href="returnbooks.html">
                        <img src="{{ asset('images/library/returnabook.png') }}" title="ReturnBooks" alt="returnBooks" class="center">
                        <div class="caption">
                            <h6 class="adjust"><a href='returnbooks.html'>Return A Book</a></h6>
                        </div>
                    </a>
                </div>
            </div> 
            <div class="col-sm-6">
                <br/>
                <div class="thumbnail">
                    <a href="Fines.html">
                        <img src="{{ asset('images/library/penalities.png') }}" title="OverduePenalties" alt="overduePenalities" class="center">
                        <div class="caption">
                            <h6><a href='Fines.html'>Fines</a></h6>
                        </div>
                    </a>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection