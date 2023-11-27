    <!-- <header class="custom-header">
        <div class="custom-manage">
            <a href="{{URL::to('/')}}">
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <input type="hidden" id="url" value="{{URL::to('/')}}">
                <img src="{{URL::to('/')}}/public/frontend/assets/img/buy4me-02.png" style="height: 9vh;width: 18vh;" alt="">
            </a>
        </div>
        <div class="custom-logo">
            <div class="custom-manage"></div>
        </div>

        <ul class="custom-menu" id="menu-list">
            <li class="boldItems"><a href="{{route('home')}}">Home</a></li>
            <li class="boldItems"><a href="{{route('shopper.index')}}">Shopper</a></li>
            <li class="boldItems"><a href="{{route('all.order')}}">Products</a></li>
            <li class="boldItems"><a href="{{route('traveller')}}">Traveller</a></li>
            <li class="boldItems"><a href="#">Cost Calculator</a></li>
            <li class="boldItems"><a href="#">FAQ</a></li>
        </ul>



        <div class="custom-right-menu">
            <ul>
                <li></li>
            </ul>
        </div>
        <div class="header-cart">
            @if(!empty(Auth::User()))
            <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">
                <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>
                Welcome {{Auth::User()->first_name}}
            </a>
            @else
            <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">
                <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>
            </a>
            @endif
            <ul class="cart-dropdown">
                @if(!empty(Auth::User()))
                @if(Auth::User()->email_verified_at != Null)
                <li class="single-product-cart">
                    <a href="{{route('user.profile')}}">Profile</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('shopper.orders')}}#all-orders">Orders</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('traveller.trip')}}">Trips</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Wallets</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Coupons</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Settings</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.help_desk')}}">Help Desk</a>
                </li>
                @else
                <li class="single-product-cart">
                    <a href="{{route('email_verify.auth',['email'=>Auth::user()->email])}}">Email Verify</a>
                </li>
                @endif

                @endif
                @if(empty(Auth::User()))
                <li class="single-product-cart">
                    <a href="{{route('registrion')}}">Sign up</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('login')}}">Login</a>
                </li>
                @else
                <li class="single-product-cart">
                    <a href="{{route('logout')}}">Logout</a>
                </li>
                @endif
            </ul>
        </div>
    </header> -->


    <!--<header class="custom-header">-->
    <!--    <div class="custom-manage">-->
    <!--        <a href="{{URL::to('/')}}">-->
    <!--            <input type="hidden" id="token" value="{{csrf_token()}}">-->
    <!--            <input type="hidden" id="url" value="{{URL::to('/')}}">-->
    <!--            <img src="{{URL::to('/')}}/public/frontend/assets/img/buy4me-02.png" style="height: 9vh;width: 18vh;" alt="">-->
    <!--        </a>-->
    <!--    </div>-->
    <!--    <div class="custom-logo">-->
    <!--        <div class="custom-manage"></div>-->
    <!--    </div>-->

    <!--    <ul class="custom-menu" id="menu-list">-->
    <!--        <li class="boldItems"><a href="{{route('home')}}">Home</a></li>-->
    <!--        <li class="boldItems"><a href="{{route('shopper.index')}}">Shopper</a></li>-->
    <!--        <li class="boldItems"><a href="{{route('all.order')}}">Products</a></li>-->
    <!--        <li class="boldItems"><a href="{{route('traveller')}}">Traveller</a></li>-->
    <!--        <li class="boldItems"><a href="#">Cost Calculator</a></li>-->
    <!--        <li class="boldItems"><a href="#">FAQ</a></li>-->
    <!--    </ul>-->



    <!--    <div class="custom-right-menu">-->
    <!--        <ul>-->
    <!--            <li></li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--    <div class="header-cart">-->
    <!--        @if(!empty(Auth::User()))-->
    <!--        <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">-->
    <!--            <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>-->
    <!--            Welcome {{Auth::User()->first_name}}-->
    <!--        </a>-->
    <!--        @else-->
    <!--        <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">-->
    <!--            <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>-->
    <!--        </a>-->
    <!--        @endif-->
    <!--        <ul class="cart-dropdown">-->
    <!--            @if(!empty(Auth::User()))-->
    <!--            @if(Auth::User()->email_verified_at != Null)-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('user.profile')}}">Profile</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('shopper.orders')}}#all-orders">Orders</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('traveller.trip')}}">Trips</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('user.setting')}}">Wallets</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('user.setting')}}">Coupons</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('user.setting')}}">Settings</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('user.help_desk')}}">Help Desk</a>-->
    <!--            </li>-->
    <!--            @else-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('email_verify.auth',['email'=>Auth::user()->email])}}">Email Verify</a>-->
    <!--            </li>-->
    <!--            @endif-->

    <!--            @endif-->
    <!--            @if(empty(Auth::User()))-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('registrion')}}">Sign up</a>-->
    <!--            </li>-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('login')}}">Login</a>-->
    <!--            </li>-->
    <!--            @else-->
    <!--            <li class="single-product-cart">-->
    <!--                <a href="{{route('logout')}}">Logout</a>-->
    <!--            </li>-->
    <!--            @endif-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</header>-->
    
       <header class="navbar navbar-expand-lg navbar-light" style="background-color: #e6e6e6; padding-top: 0px; padding-bottom: 0px;">
    <div class="container-fluid">
        <!-- Logo -->
        <!-- <a class="navbar-brand" href="{{URL::to('/')}}">
            <img src="{{URL::to('/')}}/public/frontend/assets/img/buy4me-02.png" alt="Logo" height="45">
        </a> -->
        <a href="{{URL::to('/')}}">
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <input type="hidden" id="url" value="{{URL::to('/')}}">
                <img src="{{URL::to('/')}}/public/frontend/assets/img/buy4me-02.png" style="height: 9vh;width: 18vh;" alt="">
            </a>

        <!-- Navbar toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}" style="color: black; font-weight: bold;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shopper.index')}}" style="color: black; font-weight: bold;">Shopper</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('all.order')}}" style="color: black; font-weight: bold;">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('traveller')}}" style="color: black; font-weight: bold;">Traveller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: black; font-weight: bold;">Cost Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: black; font-weight: bold;">FAQ</a>
                </li>
            </ul>
        </div>

        <!-- User Information -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="header-cart user-hover">
            @if(!empty(Auth::User()))
            <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">
                <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>
                Welcome {{Auth::User()->first_name}}
            </a>
            @else
            <a class="icon-cart-furniture1" href="#" style="color: #00245b;font-size: 17px; display: inline-block; vertical-align: middle;">
                <i class="ti-user" style="display: inline-block; vertical-align: middle;"></i>
            </a>
            @endif
            <ul class="cart-dropdown">
                @if(!empty(Auth::User()))
                @if(Auth::User()->email_verified_at != Null)
                <li class="single-product-cart">
                    <a href="{{route('user.profile')}}">Profile</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('shopper.orders')}}#all-orders">Orders</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('traveller.trip')}}">Trips</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Wallets</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Coupons</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.setting')}}">Settings</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('user.help_desk')}}">Help Desk</a>
                </li>
                @else
                <li class="single-product-cart">
                    <a href="{{route('email_verify.auth',['email'=>Auth::user()->email])}}">Email Verify</a>
                </li>
                @endif

                @endif
                @if(empty(Auth::User()))
                <li class="single-product-cart">
                    <a href="{{route('registrion')}}">Sign up</a>
                </li>
                <li class="single-product-cart">
                    <a href="{{route('login')}}">Login</a>
                </li>
                @else
                <li class="single-product-cart">
                    <a href="{{route('logout')}}">Logout</a>
                </li>
                @endif
            </ul>
        </div>
        </div>
    </div>
</header>










    <!-- Mobile Menu -->
    <div class="collapse navbar-collapse" id="mobileMenu">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('shopper.index')}}">Shopper</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('all.order')}}">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('traveller')}}">Traveller</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Cost Calculator</a></li>
            <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
        </ul>
    </div>
    </header>











    <script>
        // $(document).ready(function() {
        //     $(".custom-menu").hide();
        //     $("#menu-toggle").click(function() {
        //         $(".custom-menu").slideToggle();
        //     });
        //     function checkWindowSize() {
        //         if ($(window).width() > 768) {
        //             $(".custom-menu").show();
        //             $("#menu-toggle").hide();
        //         } else {
        //             $("#menu-toggle").show();
        //         }
        //     }
        //     checkWindowSize();
        //     $(window).resize(checkWindowSize);
        // });
    </script>

    @include("frontend.Auth.login_modal")