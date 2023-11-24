<!-- @extends('layouts.app')
@include('frontend.includes.header')
<body>
@include('frontend.includes.nav')
    @section('content')
   
    <div class="register-area " style="margin:50px">
            <div class="container-fluid">
                @include('admin.includes.validation')
                <div class="row">
                    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                    @include('admin.includes.validation')
                        <div class="login">
                            <div class="login-form-container">
                                <div class="login-form">
                                    <form action="{{route('login.user')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="previous_url" value="{{url()->previous()}}">
                                        <input type="email" name="email" placeholder="Email">
                                        <input type="password" name="password" >
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                            </div>
                                            <button type="submit" class="default-btn floatright">Login</button>
                                            <button type="button" class="default-btn floatright"><a href="{{route('registrion')}}">Registration</a></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('frontend.includes.footer')
     @include('frontend.includes.footer_script')
@endsection -->
