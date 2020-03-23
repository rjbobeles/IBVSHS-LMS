<div id="nav">
    <div id="infobar">
        <div class="row">
            <div id="contact" class="col bar-left">
                <i class="fa fa-phone"></i> {{ env('IBVSHS_NUMBER') }}
                <b class="border"></b>
                <i class="email fa fa-envelope"></i> {{ env('IBVSHS_EMAIL') }}
            </div>
            <div id="socmed" class="col bar-right">
                <a href="{{ env('IBVSHS_FACEBOOK') }}"><i class="fab fa-facebook-square"></i></a>
                <a href="{{ env('IBVSHS_TWITTER') }}"><i class="fab fa-twitter-square"></i></a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg" id="colnav">
        <div class="navbar-brand">  
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" style="height: 50px;"> 
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse-navbar">
            <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="collapse-navbar">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('patron')}}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">VIEW BOOKS</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">MY BORROWED BOOKS</a>
                    </li>
                @endguest

                @if(!Auth::guest() && Auth::user()->role == "Librarian")
                    <li class="nav-item" id="item-admin">
                        <a href="{{ route('librarian') }}">LIBRARIAN</a>
                    </li><span class="divider">|</span>
                    <li class="nav-item">
                        <a href="{{ route('books.index')}}">MANAGE BOOKS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transactions.create') }}">BOOKS ISSUANCE</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transactions.index') }}">BORROWED BOOKS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('patrons.index') }}">MANAGE PATRONS</a>
                    </li>
                @endif

                @if(!Auth::guest() && Auth::user()->role == "Admin")
                    <li class="nav-item" id="item-admin">
                        <a href="{{ route('admin') }}">ADMIN</a>
                    </li><span class="divider">|</span>
                    <li class="nav-item">
                        <a href="{{ route('users.index')}}">MANAGE USERS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logs.user.index') }}">USER LOGS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logs.book.index') }}">BOOK AUDIT LOGS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logs.patron.index') }}">PATRON LOGS</a>
                    </li>
                @endif

                <li class="collapsed-divider">
                    <hr /> 
                </li>

                <!--SHOW ONLY WHEN COLLAPSED-->
                @auth
                    <li class="nav-item show-collapse">
                        <a href="{{ route('changepassword.edit') }}">Change Password</a>
                    </li>
                @endauth
                
                <li class="nav-item show-collapse">
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                    @endguest
                    @auth
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    @endauth
                </li>
            </ul>

            <!--BURGER-->
            <div class="nav-item account-burger">
                <div class="dropdown">
                    <button type="button" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="dropdown-menu animated fadeInDown">
                        <span class="dropdown-item-text">
                            @guest Howdy! @endguest
                            @auth Howdy, {{ Auth::user()->username }}! @endauth 
                        </span>
                        <div class="dropdown-divider"></div>
                        @guest
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        @endguest
                        @auth
                            <a class="dropdown-item" href="{{ route('changepassword.edit') }}">Change Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        @endauth
                    </div>  
                </div>
            </div>
        </div>  
    </nav>
</div>