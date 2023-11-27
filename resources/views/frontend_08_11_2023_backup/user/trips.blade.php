@include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="product-description-review-area pb-90 pt-40">
      <div class="container custmizeMM">
        <div class="product-description-review text-center">
          <!-- <h5> Trips  &nbsp;&nbsp;<a href="{{route('user.treveller')}}">Add Trip</a></h5>  -->

          <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
    <div class="StatusXX">
      <a class="active menuHeader tab-link" href="#order_Orderpublished" data-bs-toggle="tab" role="tab">
      <span data-tab-value="#recent_tab">Recent <?php echo $cur+$upc; ?></span>
      </a>
</div>
    <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Offerreceived" data-bs-toggle="tab" role="tab">
    <span  data-tab-value="#past_tab">Past {{$pastCount}}</span>
                    </a></div>
     <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
        <a class="menu-custbtn" href="#">Trips</a>
    </div>
    <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
        <a class="menu-custbtn" href="{{route('user.treveller')}}">Add Trip</a>
    </div>
</div>


          <div class="description-review-title nav tabs" role=tablist>
            <!-- <span data-tab-value="#recent_tab" style="width:150px;">Recent <?php echo $cur+$upc; ?></span>
            <span  data-tab-value="#past_tab"style="width:150px;">Past {{$pastCount}}</span> -->
          </div>
          <div class="description-review-text tab-content custmizeTabX1">
            <div class="tab-pane active show fade tabs__tab active " id="recent_tab"  role="tabpanel" data-tab-info>
              <h3>Current</h3>
              <div>
                @if($cur !=0) 
                  @foreach($current as $row)
                    <!-- <div class="single-blog-replay">
                      <div class="replay-info-wrapper">
                        <div class="replay-info">
                          <div class="replay-name-date">
                            <h5><a href="#">Upcoming Trip</a></h5>
                            <span>{{ date("M d , Y", strtotime($row->travel_date))}}</span>
                          </div>
                          <div class="replay-btn">
                            <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                            <a class="menu-btnX btn-hover" href="{{route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])}}">Check Offer</a>
                            </div>
                          </div>
                        </div>
                        <p>{{$row->fromCountry}},{{$row->fromCity}} -> {{$row->toCountry}},{{$row->toCIty}}</p>
                        <p>{{ date("M d , Y", strtotime($row->travel_date))}}</p>
                      </div>

                      
                    </div> -->







<div class="container">
  <div class="row d-flex" style="padding-bottom: 7px;">
    <div class="col-md border bg-white p-3">
      <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Upcoming Trip</span></span></p>
      <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
      <p>{{$row->fromCountry}}</p>
      <p>{{$row->fromCity}}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
      <p class="text-truncate" style="width: 100%;" >{{$row->toCountry}}</p>
      <p class="text-truncate" style="width: 100%;">{{$row->toCIty}}</p>
    
    </div>
    <div class="col-md border bg-white p-3">
      <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
        <a class="menu-custbtn" href="{{route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])}}">Check Offer4</a>
      </div>
    </div>
  </div>
</div>











                  @endforeach
                @else
                  <p>there are no trip</p>
                @endif    
              </div>
              <div>
                <div class="blog-replay-wrapper pb-20">
                  <h4 class="blog-details-title2">Upcoming</h4>
                    @if($upc !=0)
                      @foreach($upcoming as $row)
<div class="container">
  <div class="row d-flex" style="padding-bottom: 7px;">
    <div class="col-md border bg-white p-3">
      <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Upcoming Trip</span></span></p>
      <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
      <p>{{$row->fromCountry}}</p>
      <p>{{$row->fromCity}}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
      <p class="text-truncate" style="width: 100%;" >{{$row->toCountry}}</p>
      <p class="text-truncate" style="width: 100%;">{{$row->toCIty}}</p>
      
      <!-- <p>{{$row->toCIty}}</p> -->
    </div>
    <div class="col-md border bg-white p-3">
      <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
        <a class="menu-custbtn" href="{{route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])}}">Check Offer5</a>
      </div>
    </div>
  </div>
</div>






<!-- 
                        <div class="single-blog-replay">
                          <div class="replay-info-wrapper">
                            <div class="replay-info">
                              <div class="replay-name-date">
                                <h5><a href="#">Upcoming Trip</a></h5>
                                <span>{{ date("M d , Y", strtotime($row->travel_date))}}</span>
                              </div>
                              <div class="replay-btn">
                                
                                <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                            <a class="menu-btnX btn-hover" href="{{route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])}}">Check Offer</a>
                            </div>
                              </div>
                            </div>
                            <p>{{$row->fromCountry}},{{$row->fromCity}} -> {{$row->toCountry}},{{$row->toCIty}}</p>
                            <p>{{ date("M d , Y", strtotime($row->travel_date))}}</p>
                          </div>
                        </div> -->
                      @endforeach
                    @else
                      <p>there are no trip</p>
                    @endif
                  </div>
                </div>
              </div>
              <div class="description-review-text tab-content">
                <div class="tab-pane  show fade tabs__tab " id="past_tab"  role="tabpanel" data-tab-info>
                  <h3>Past</h3>
                  <div>
                    @if($pastCount !=0)
                      @foreach($past as $row)
                        <!-- <div class="single-blog-replay">
                          <div class="replay-info-wrapper">
                            <div class="replay-info">
                              <div class="replay-name-date">
                                <h5><a href="#">Past Trip</a></h5>
                                <span>{{$row->travel_date}}</span>
                              </div>
                            </div>
                            <p>{{$row->fromCountry}},{{$row->fromCity}} -> {{$row->toCountry}},{{$row->toCIty}}</p>
                            <p>{{ date("M d , Y", strtotime($row->travel_date))}}</p>
                          </div>
                        </div> -->
<div class="container">
  <div class="row d-flex">
    <div class="col-md border bg-white p-3">
      <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Past Trip</span></span></p>
      <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
      <p>{{$row->fromCountry}}</p>
      <p>{{$row->fromCity}}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
      <p class="text-truncate" style="width: 100%;" >{{$row->toCountry}}</p>
      <p class="text-truncate" style="width: 94%;">{{$row->toCIty}}</p>
      
      <!-- <p>{{$row->toCIty}}</p> -->
    </div>
    <div class="col-md border bg-white p-3">
      <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
    </div>
    <div class="col-md border bg-white p-3">
      <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
        <a class="menu-custbtn" href="{{route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])}}">View</a>
      </div>
    </div>
  </div>
</div>
                        
                      @endforeach
                    @else
                      <p>there are no trip</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- menu area end -->
    @include('frontend.includes.footer')
		<!-- all js here -->
    @include('frontend.includes.footer_script')
  </body>
</html>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  
<script>
      
  var firebaseConfig = {
    apiKey: "AIzaSyBPdVwUIYOY0qRr9kbIMTnxKpFw_nkneYk",
    authDomain: "itdemo-push-notification.firebaseapp.com",
    databaseURL: "https://itdemo-push-notification.firebaseio.com",
    projectId: "itdemo-push-notification",
    storageBucket: "itdemo-push-notification.appspot.com",
    messagingSenderId: "257055232313",
    appId: "1:257055232313:web:3f09127acdda7298dfd8e8",
    measurementId: "G-VMJ68DFLXL"
  };
    
  firebase.initializeApp(firebaseConfig);
</script>
  
<script type="text/javascript">
  
    window.onload=function () {
      render();
    };
  
    function render() {
        window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
  
    function phoneSendAuth() {
           
        var number = $("#mobile_number").val();
          
        firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
              
            window.confirmationResult=confirmationResult;
            coderesult=confirmationResult;
            console.log(coderesult);
  
            $("#sentSuccess").text("Message Sent Successfully.");
            $("#sentSuccess").show();
              
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
  
    }
  
    function codeverify() {
  
        var code = $("#verificationCode").val();
  
        coderesult.confirm(code).then(function (result) {
            var user=result.user;
            console.log(user);
  
            $("#successRegsiter").text("you are register Successfully.");
            $("#successRegsiter").show();
  
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
  
</script>