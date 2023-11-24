@include('frontend.includes.header')
    <body>
        @include('frontend.includes.nav')
        
        <!-- header end -->
	    <div class="breadcrumb-area pt-205 pb-210" style="background-image: url({{URL::to('/')}}/public/frontend/assets/img/bg/breadcrumb.jpg)">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2>Trever  Request</h2>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li> Offer </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-description-review-area pb-90 profile-page">
            <div class="container">
                <div class="product-description-review">
                    <div class="description-review-title nav" role=tablist>
                        <a href="#" >
                           {{$data->first_name}} {{$data->last_name}}
                        </a>
                        @if($data->profile !="")
                            <img src="{{URL::to('/')}}/public/upload/profile_img/{{$data->profile}}" width="100px;">
                        @else
                            <img src="{{URL::to('/')}}/public/frontend/assets/img/profile/3135715.png" width="100px" alt="" >
                        @endif
                        <div>
                    </div>
                    <p>Joined {{ date("M d , Y", strtotime($data->created_at))}}</p></div>
                    <div class="stars-container-main">
                        <div class="stars-container first">
                            <span>Travel From :-</span>
                            <div class="stars">
                            </div>
                            <span>{{$data->fromCountry}},{{$data->fromcity}}</span>
                        </div>
                        <div class="stars-container second">
                            <span>Travel to :-</span>
                            <span>{{$data->toCountry}},{{$data->toCountry}}</span>
                        </div>
                        <div class="stars-container second">
                            <span>Develer On :-</span>
                            <span>{{$data->toCity}}</span>
                        </div>
                    </div>
                    <!-- <p>Mobile Number :- <span >{{$data->mobile}}</span></p>
                    <p>Email :-<span>{{$data->email}}</span></p> -->
                    
                    <p class="verified-phone-line"><span class="verified-info">VERIFIED INFO </span>@if($data->mobile != "") <span class="check-icon-main" style="color:green;"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>phone</span>@else <span class="check-icon-main" style="color:red;"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>phone</span>@endif @if($data->email != "")<span class="check-icon-main" style="color:green"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>Email</span> @else <span class="check-icon-main" style="color:red"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>Email</span> @endif</p>
                    <div class="description-review-text tab-content">
                        <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                        <button class="status-btn" ><a href="{{route('user.travel_offer_reChange',['id'=>$data->m_id,'status'=>'accept'])}}">Accept Request </a></button>
                        <button class="status-btn" ><a href="{{route('user.travel_offer_reChange',['id'=>$data->m_id,'status'=>'cancle'])}}" onclick="return confirm('Are you sure you want to cancle this ?');" >Cancel Request </a> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profile area end -->
        <!-- menu area end -->
	    @include('frontend.includes.footer')
		<!-- all js here -->
     @include('frontend.includes.footer_script')
    </body>
</html>
