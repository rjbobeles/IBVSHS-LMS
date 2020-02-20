<div id="nav">
    <div id="infobar">
        <div class="row">
            <div id="contact" class="col bar-left">
                <i class="fa fa-phone"></i> +63 123 456 7890
                <b class="border"></b>
                <i class="email fa fa-envelope"></i> ibvillamorshs@gmail.com
            </div>
            <div id="socmed" class="col bar-right">
                <a href="https://www.facebook.com/ibvshs/">
                    <i class="fab fa-facebook-square"></i>
                </a>

                <a href="https://twitter.com/ibvshs">
                    <i class="fab fa-twitter-square"></i>
                </a>
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
                <li class="nav-item" id="item-homepage">
                    <a href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="#">VIEW BOOKS</a>
                </li>
                <li class="nav-item">
                    <a href="#">MY BORROWED BOOKS</a>
                </li>
                <li class="collapsed-divider">
                    <hr /> 
                </li>

                <!--SHOW ONLY WHEN COLLAPSED-->
                <li class="nav-item show-collapse">
                    <a href="{{ route('login') }}">Log In</a>
                </li>
                
                <!--BURGER-->
                <li class="nav-item account-burger">
                    <div class="dropdown">
                        <button type="button" data-toggle="dropdown">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="dropdown-menu animated fadeInDown">
                            <span class="dropdown-item-text">
                                Howdy! 
                            </span>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">View All Books</a>
                            <a class="dropdown-item" href="#">My Borrowed Books</a>
                            <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>  
    </nav>
</div>

<p style="text-align: center">|</p>

@if(!Auth::guest() && Auth::user()->role == "Admin")
    
@elseif(!Auth::guest() && Auth::user()->role == "Librarian")
    
@else 
   
@endif