<style>
    .navbar-brand img {
        width: 80px;
        height: 50px;
    }

    .nav-item {
        list-style: none;
    }

    .navbar {
        background: white !important;

    }

    .dropdown-toggle:after {
        display: none !important;
    }

    .badge {
        background-color: #6394F8;
        border-radius: 10px;
        color: white;
        display: inline-block;
        font-size: 12px;
        line-height: 1;
        padding: 3px 7px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }



    /* .nav-item a{
        color: red !important;
    } */

</style>
<header>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/img/potted-pan_logo_full.png" class="d-inline-block align-top" alt="logo">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="Navbar">

                <ul class="nav navbar-nav">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Promotion</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Service</a>
                    </li>

                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a href="" class="nav-link"><i class="fas fa-search"></i></a>
                    </li>
                    <li class="nav-item">
                    <a href="{{route('shopping.index')}}" class="nav-link"><i class="fa fa-shopping-cart"></i> Cart <span
                                class="badge">{{Cart::instance('shopping')->content()->count()}}</span></a>
                    </li>
                    @if(Auth::user())
                    <li class="dropdown nav-item {{request()->routeIs('login') ? 'active' : ''}}">
                        <a href="#" class="nav-link dropdown-toggle" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="img/account-logo.png" alt="account logo" style="width:1rem; height:1rem;">
                        </a>
                        @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 )
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('userprofile')}}">My Profile</a>
                            <a class="dropdown-item" href="{{url('/admin/dashboard')}}">My Dashboard</a>
                            <a class="dropdown-item" href="#">My Wish List</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Log out</a>
                        </div>

                        @else
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('userprofile')}}">My Profile</a>
                            <a class="dropdown-item" href="#">My Wish List</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Log out</a>
                        </div>
                        @endif
                    </li>
                    @else
                    <li class="nav-item {{request()->routeIs('login') ? 'active' : ''}}">
                        <a href="{{route('login')}}" class="nav-link"><i class="fas fa-user"></i></a>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>


</header>
