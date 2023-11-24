@include('frontend.includes.header')
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- header start -->
        @include('frontend.includes.nav')
        <!-- header end -->
		<div class="breadcrumb-area pt-205 pb-210" style="background-image: url({{URL::to('/')}}/public/frontend/assets/img/bg/breadcrumb.jpg)">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2>register</h2>
                    <ul>
                        <li><a href="{{route('home')}}">home</a></li>
                        <li> <a href="{{route('registrion')}}">Register</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- register-area start -->
        <div class="register-area ptb-100">
            <div class="container-fluid">
                @include('admin.includes.validation')
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                        <div class="login">
                            <div class="login-form-container">
                                <div class="login-form">
                                    <form action="{{route('register.user')}}" method="post">
                                        @csrf
                                        <input type="email" name="email" placeholder="Email">
                                        <input type="password" name="password" placeholder="Create Password">
                                        <input name="first_name" placeholder="First Name" type="text">
                                        <input name="last_name" placeholder="Last Name" type="text">
                                        <!-- <div class="button-box">
                                            <button type="submit" class="default-btn floatright">Register</button>
                                            <a href="{{route('login')}}"><button type="button" class="default-btn floatright">Login</button></a>
                                        </div> -->

                                        <div class="menu-custbtn-area text-center mt-1" >
                <button  type="submit" class="menu-custbtn" style="border:none;width: 111px;">Register</button>
                <a  href="{{route('login')}}" class="menu-custbtn" style="border:none;width: 111px; padding: 3px 15px 3px 15px;">Login</a>
                    
            </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register-area end -->
	    @include('frontend.includes.footer');
		
		<!-- all js here -->
     @include('frontend.includes.footer_script');
    </body>
</html>
