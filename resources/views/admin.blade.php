@extends('layouts.appfull')

@section('content')
    
    <body style="margin:0px;color: #424242;">
            <div class="homepage-body">
                <div class="container m-0">
                    <div class="row">
                        <div class="col-xl">
                            W E L C O M E ,
                            <h1>ADMIN</h1>
                            <p> 
                                Only the admin (you) can manage accounts of library users, authenticate registered <br/> accounts, and view books as well as all the transaction records.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homepage-footer">
                <div class="container m-0 mx-auto mt-5">
                    <div class="row">
                        <div class="col-lg"><hr/>
                            <h6><strong>USER ACCOUNTS</strong></h6> <br id="footer-br"/><hr/>
                            <a href="user.html" id="footer-text">Add users</a> <br/>
                            <a href="user.html" id="footer-text">Update users</a> <br/>
                            <a href="user.html" id="footer-text">Reset Password</a> <br/>
                            <a href="user.html" id="footer-text">Deactivate Accounts</a>
                            <br/><br/><hr/>
                        </div>
                        <div class="col-lg">
                            <h6><strong>INFORMATION</strong></h6> <br id="footer-br"/><hr/>
                            <a href="books_audit.html" id="footer-text">View Book Logs</a> <br/>
                            <a href="user_audit.html" id="footer-text">View User Logs</a> <br/>
                            <a href="patron_audit.html" id="footer-text">View Patron Logs</a> <br/>
                            <a href="transactions.html" id="footer-text">View Transactions</a>
                            <br/><br/><hr/>
                        </div>
                        <div class="col-lg">
                            <h6><strong>HELP</strong></h6> <br id="footer-br"/><hr/>
                            <a href="" id="footer-text">F.A.Q</a> <br/>
                            <a href="" id="footer-text">Dashboard and Reports</a>
                            <br/><br/><hr/>
                        </div>
                        <div class="col-lg"></div>
                        <div class="col-lg">
                            <h6><strong>CONTACT INFORMATION</strong></h6> <br id="footer-br"/><hr/>
                            <i class="fa fa-globe" id="footer-text"></i> &nbsp;1009 Pasig Line St. Ata <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manila, Philippines <br/>
                            <i class="fa fa-envelope" id="footer-text"></i> &nbsp;ibvillamorshs@gmail.com <br/>
                            <i class="fa fa-phone" id="footer-text"></i> &nbsp;+63 123 456 7890
                            <br/><br/><hr/><br/><br/>
                        </div>
                    </div>
                </div>
            </div>
    </body>

@endsection