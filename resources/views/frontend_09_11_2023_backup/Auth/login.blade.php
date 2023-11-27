@include('frontend.includes.header')
    <body>
        @include('frontend.includes.nav')
        <!-- header end -->
		
        <!-- login-area start -->
        <div class="register-area " style="margin:50px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                        <div class="login">
                            <div class="login-form-container" style="background: linear-gradient(to bottom, #f6d05d 50%, #feef2861 50%) !important;">
                                <div class="login-form">
                                    <form action="{{route('login.user')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="previous_url" value="{{url()->previous()}}">
                                        <input type="email" name="email" placeholder="Email">
                                        <input type="password" name="password" placeholder="Password">
                                        <div class="button-box loginBox1">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                                <!--<a href="#">Forgot Password?</a>-->
                                            </div>

                                            <div class="button-container">
    <!-- <div class="menu-btnX-area">
        <button type="submit" class="menu-btnX  mt-1" style="border: none">Login</button>
        <a class="menu-btnX  mt-1" href="{{ route('registrion') }}">Registration</a>
        <a class="menu-btnX  mt-1" href="{{ route('forgot') }}">Forgot Password</a>
    </div> -->

    <div class="menu-custbtn-area text-center mt-1" >
                <button  type="submit" class="menu-custbtn" style="border:none;width: 111px;">Login</button>
                <a  href="{{ route('registrion') }}" class="menu-custbtn" style="border:none;width: 140px; padding: 4px 15px 4px 15px;">Registration</a>
                <a  href="{{ route('forgot') }}" class="menu-custbtn" style="border:none;width: 188px; padding: 4px 15px 4px 15px;">Forgot Password</a>    
            </div>


    <!-- <div class="menu-btnX-area text-center">
        <a class="menu-btnX btn-hover" href="{{ route('registrion') }}">Registration</a>
    </div>
    <div class="menu-btnX-area text-center">
        <a class="menu-btnX btn-hover" href="{{ route('forgot') }}">Forgot Password</a>
    </div> -->
</div>

                                            
                                            <!-- <button type="submit" class="default-btn floatright">Login</button> -->
                                
                                            

                                            <!-- <a href="{{route('registrion')}}"><button type="button" class="default-btn floatright">Registration</button></a> -->
                        
                                            <!-- <button type="button" class="default-btn floatright"><a href="{{route('forgot')}}">Forgot Password</a></button> -->
                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login-area end -->
	    @include('frontend.includes.footer')
		
		<!-- all js here -->
     @include('frontend.includes.footer_script')
    </body>
</html>
