<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="">About</a>
                <a class="text-body mr-3" href="">Contact</a>
                <a class="text-body mr-3" href="">Help</a>
                <a class="text-body mr-3" href="">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @auth
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i>Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <button class="dropdown-item" type="button"><a href="{{ route('login') }}">Sign In</a></button>
                            <button class="dropdown-item" type="button"><a href="{{ route('register') }}">Sign Up</a></button>
                        @endauth
                        <button class="dropdown-item" type="button"><a href="{{ route('login_form') }}">Sign in (admin)</a></button>
                    </div>
                </div>
                <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EUR</button>
                        <button class="dropdown-item" type="button">GBP</button>
                        <button class="dropdown-item" type="button">CAD</button>
                    </div>
                </div>
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">FR</button>
                        <button class="dropdown-item" type="button">AR</button>
                        <button class="dropdown-item" type="button">RU</button>
                    </div>
                </div> --}}
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @if (App::getLocale() == 'ar')
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/flags/EG.png') }}" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Arabic</span>
                                </span>
                            @else
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/flags/US.png') }}" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">English</span>
                                </span>
                            @endif
                        </span>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <ul>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <img width="50px" height="50px" style="border-radius: 10px" src="{{ asset('Attachments/SiteSetting/'.$site_details->photo) }}">
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">{{ $site_details->name }}</p>
            <h5 class="m-0">{{ $site_details->phone }}</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
<div class="row px-xl-5">
<div class="col-lg-3 d-none d-lg-block">
    <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
        <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
        <div class="navbar-nav w-100">
            <div class="nav-item dropdown dropright">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                    <a href="" class="dropdown-item">Men's Dresses</a>
                    <a href="" class="dropdown-item">Women's Dresses</a>
                    <a href="" class="dropdown-item">Baby's Dresses</a>
                </div>
            </div>
            <a href="" class="nav-item nav-link">Shirts</a>
            <a href="" class="nav-item nav-link">Jeans</a>
            <a href="" class="nav-item nav-link">Swimwear</a>
            <a href="" class="nav-item nav-link">Sleepwear</a>
            <a href="" class="nav-item nav-link">Sportswear</a>
            <a href="" class="nav-item nav-link">Jumpsuits</a>
            <a href="" class="nav-item nav-link">Blazers</a>
            <a href="" class="nav-item nav-link">Jackets</a>
            <a href="" class="nav-item nav-link">Shoes</a>
        </div>
    </nav>
</div>
<div class="col-lg-9">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
            <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link ">Home</a>
                <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                        <a href="{{ route('cart.list') }}" class="dropdown-item">Shopping Cart</a>
                        <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>
                        <a href="{{ route('favourite') }}" class="dropdown-item">Favourite</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                <a href="{{ route('favourite') }}" class="btn px-0">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="theFavourite badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{ $theFavourite }}</span>
                </a>
                <a href="{{ route('cart.list') }}" class="btn px-0 ml-3">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{ Cart::getTotalQuantity()}}</span>
                </a>
            </div>
        </div>
    </nav>
</div>
</div>
</div>
<!-- Navbar End -->
