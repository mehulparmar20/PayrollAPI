    <header class="custom-header">
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
        <!-- <button id="menu-toggle" class="menu-toggle-button">&#9776;</button> -->
        <ul class="custom-menu" id="menu-list">
        <li class="boldItems"><a href="{{route('home')}}">Home</a></li>
        <li class="boldItems"><a href="{{route('shopper.index')}}">Shopper</a></li>
        <li class="boldItems"><a href="{{route('all.order')}}">Products</a></li>
        <li class="boldItems"><a href="{{route('traveller')}}">Traveller</a></li>
        <li class="boldItems"><a href="#">Cost Calculator</a></li>
        <li class="boldItems"><a href="#">FAQ</a></li>
        </ul>
        <div class="custom-right-menu">
        <ul><li></li>
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