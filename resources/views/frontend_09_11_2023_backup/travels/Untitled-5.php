
@extends('layouts.app')
@section('pages');

    <!-- header end -->
<div class="product-description-review-area pb-90 pt-40">
      <div class="container custmizeMM">
        <div class="product-description-review text-center">
          <!-- <h5> Trips  &nbsp;&nbsp;<a href="{{--route('user.treveller')--}}">Add Trip</a></h5>  -->

          <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
              <div class="StatusXX">
              <a class="active menuHeader tab-link" href="#order_Orderpublished" data-bs-toggle="tab" role="tab">
              <span data-tab-value="#recent_tab">Recent </span>
              </a>
              </div>
              <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Offerreceived" data-bs-toggle="tab" role="tab">
                <span  data-tab-value="#past_tab">Past </span>
                            </a></div>
                <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
                <a class="menu-custbtn" href="#">Trips</a>
              </div>
                <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
                <a class="menu-custbtn" href="{{route('traveller')}}">Add Trip</a>
                </div>
</div>


          <div class="description-review-title nav tabs" role=tablist>
            <!-- <span data-tab-value="#recent_tab" style="width:150px;">Recent <?php echo '$cur+$upc'; ?></span>
            <span  data-tab-value="#past_tab"style="width:150px;">Past {{--$pastCount--}}</span> -->
          </div>
         
          <div class="description-review-text tab-content custmizeTabX1">
                 <div class="tab-pane active show fade tabs__tab active" id="recent_tab"  role="tabpanel" data-tab-info>
                 
                 @if(count($trips) != 0)
                
                
                 @if ($trips->where('travel_date', now()->toDateString())->count() > 0)
                 <h3>Current</h3>     
                  @endif
                 @foreach($trips as $row)
                 @if(date("M d, Y", strtotime($row->travel_date)) == date("M d, Y"))
                       <div class='current-flight'>
                       <div class="container">
                    <div class="row d-flex" style="padding-bottom: 7px;">
                      <div class="col-md border bg-white p-3">
                        <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Upcoming Trip</span></span></p>
                        <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
                        <p>{{$row->origincountry}}</p>
                        <p>{{--$row->fromCity--}}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
                        <p class="text-truncate" style="width: 100%;" >{{$row['destination']['destination_country']}}</p>
                        <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_city']}}</p>
                      
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
                          <a class="menu-custbtn" href="{{--route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])--}}">Check Offer</a>
                        </div>
                        </div>
                      </div>
                        </div>

                       </div> <!-- end current-flight -->
                      @endif
                       @endforeach

                      <div class="upcomming_flight">
                            <div class="blog-replay-wrapper pb-20">
                            @if ($trips->where('travel_date', '>', now())->count() > 0)
                                  <h4 class="blog-details-title2">Upcoming</h4>
                                
                              @else
                          
                              @endif

                                  @foreach($trips as $row)
                                  @if(date("M d, Y", strtotime($row->travel_date)) > date("M d, Y"))
                                      <div class='upcomming-flight'> 
                                      <div class="container">
                    <div class="row d-flex" style="padding-bottom: 7px;">
                      <div class="col-md border bg-white p-3">
                        <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Upcoming Trip</span></span></p>
                        <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
                        <p>{{$row->origincountry}}</p>
                        <p>{{--$row->fromCity--}}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
                        <p class="text-truncate" style="width: 100%;" >{{$row['destination']['destination_country']}}</p>
                        <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_city']}}</p>
                      
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
                          <a class="menu-custbtn" href="{{--route('user.matched_trip',['id'=>$row->id,'from'=>'trip'])--}}">Check Offer</a>
                        </div>
                        </div>
                      </div>
                        </div>
                                      </div>  <!-- end upcomming-flight -->
                                      @endif
                                      @endforeach


                            </div>   <!-- end blog-replay-wrapper -->
                        
                       </div>  <!-- upcomming_flight -->
              
                       
                 @else 
                 <h5>No Trip exist</h5>


                 @endif


                 </div>


           <!-- start past flight -->
              <div class="description-review-text tab-content past-tab-content">
                    <div class="past-f-tabpan tab-pane  show fade tabs__tab " id="past_tab"  role="tabpanel" data-tab-info>
                                    <h3>Past</h3>
                                    <div class="past-flight">
                                        past fligt
                                    </div> <!-- end past-flight-->
                        
                    </div>  <!-- end past-f-tabpan-->
              </div>
              <!-- end tab past-tab-content-->
             
            </div>
          </div>
        </div>
      <!-- </div>
    </div> -->
  @endsection

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