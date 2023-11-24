@extends('layouts.app')
@section('pages');

<!-- header end -->
<div class="product-description-review-area pb-90 pt-40">
  <div class="container-fluid custmizeMM">
    <div class="product-description-review text-center">
      <!-- <h5> Trips  &nbsp;&nbsp;<a href="{{--route('user.treveller')--}}">Add Trip</a></h5>  -->

      <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
        <div class="StatusXX">
          <a class="active menuHeader tab-link" href="#order_Orderpublished" data-bs-toggle="tab" role="tab">
            <span data-tab-value="#recent_tab">Recent </span>
          </a>
        </div>

        <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Offerreceived" data-bs-toggle="tab" role="tab">
            <span data-tab-value="#past_tab">Past </span>
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

      <div class="description-review-text tab-content custmizeTabX1" style="width: 100%;">
        <div class="tab-pane active show fade tabs__tab active" id="recent_tab" role="tabpanel" data-tab-info>



          @if(count($trips) != 0 || $trips->where('travel_date', now()->toDateString())->count() > 0 || $trips->where('travel_date', '>', now())->count() > 0)


          @if($trips->where('travel_date', now()->toDateString())->count() > 0)
          <h4 class="blog-details-title2">Current flight</h4>
          @endif

          <div class='current-flight'>
            @foreach ($trips as $row)

            @if($row->travel_date == now()->toDateString())

            <div class="container-fluid">
              <div class="row d-flex" style="padding-bottom: 7px;">

                <div class="col-md border bg-white p-3">
                  <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Current Trip</span></span></p>
                  <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                </div>

                <div class="col-md border bg-white p-3">
                  <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
                  <p>{{$row->origincountry}}</p>
                  <p>{{--$row->fromCity--}}</p>
                </div>
                <div class="col-md border bg-white p-3">
                  <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
                  <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_country']}}</p>
                  <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_city']}}</p>

                </div>
                <div class="col-md border bg-white p-3">
                  <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                </div>
                <div class="col-md border bg-white p-3">
                  <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
                    <a class="menu-custbtn" href="{{route('traveller.matched_trip',[$row,'from'=>'trip'])}}">Check Offer</a>
                  </div>
                </div>

              </div>
            </div>

            @endif
            @endforeach

          </div>








          @if ($trips->where('travel_date', '>', now())->count() > 0)
          <div class="upcomming_flight" style="margin-top: -32px;">
            <div class="blog-replay-wrapper pb-20">

              <h4 class="blog-details-title2" style="margin-bottom: 17px;">Upcoming</h4>
              <div class='upcomming-flight'>
                @foreach ($trips as $row)
                @if($row->travel_date > now()->toDateString())
                <!--{{$row->id}}-->
                <div class="container-fluid">
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
                      <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_country']}}</p>
                      <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_city']}}</p>

                    </div>
                    <div class="col-md border bg-white p-3">
                      <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                    </div>
                    <div class="col-md border bg-white p-3">
                      <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
                        <a class="menu-custbtn" href="{{route('traveller.matched_trip',[$row,'from'=>'trip'])}}">Check Offer</a>
                      </div>
                    </div>

                  </div>
                </div> 

             




                @endif
                @endforeach

              </div>


            </div>

          </div>
          <!-- end upcomming-flight -->

          @endif


          @else
          No trip Found
          @endif
        </div> <!-- end blog-replay-wrapper -->













        <!-- start past flight -->

        <div class="description-review-text tab-content past-tab-content">
          <div class="past-f-tabpan tab-pane show fade tabs__tab" id="past_tab" role="tabpanel" data-tab-info>
            @if (count($trips) != 0)
            @if ($trips->where('travel_date', '<',now()->toDateString())->count() != 0)
              <h3>Past</h3>
              @foreach ($trips as $row)

              @if($row->travel_date < now()->toDateString())
                <div class="past-flight">

                  <div class="container-fluid">
                    <div class="row d-flex" style="padding-bottom: 7px;">

                      <div class="col-md border bg-white p-3">
                        <p class="text-truncate" style="width: 100%;"><span><span style="font-size: 16px;font-weight: 600;">Past Trip</span></span></p>
                        <p>{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>

                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">From</span></p>
                        <p>{{$row->origincountry}}</p>
                        <p>{{--$row->fromCity--}}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <p><span style="font-size: 16px;font-weight: 600;">To</span></p>
                        <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_country']}}</p>
                        <p class="text-truncate" style="width: 100%;">{{$row['destination']['destination_city']}}</p>

                      </div>
                      <div class="col-md border bg-white p-3">
                        <p class="pt-25" class="text-truncate" style="width: 100%;">{{ date("M d, Y", strtotime($row->travel_date)) }}</p>
                      </div>
                      <div class="col-md border bg-white p-3">
                        <div class="menu-custbtn-area text-center mt-1 pt-15" style="display: inline-block;">
                          <a class="menu-custbtn" href="{{route('traveller.matched_trip',[$row,'from'=>'trip'])}}">Check Offer3</a>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                @endif
                @endforeach


          </div> <!-- end past-f-tabpan-->

          @else
          noooo trips
          @endif

          @else
          No trips found
          @endif


          <!-- end tab past-tab-content-->


          <!-- start past flight -->

        </div>
      </div>
    </div>
    <!-- </div>
    </div> -->
    @endsection

    <style>
      body {
        margin: 0;
        padding: 0;
      }

      .container.custmizeMM {
        padding: 0;
        margin: 0 auto;
        /* Center the container if needed */
      }

      .product-description-review-area {
        margin: 0;
        padding: 0;
      }
    </style>


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
      window.onload = function() {
        render();
      };

      function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
      }

      function phoneSendAuth() {

        var number = $("#mobile_number").val();

        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {

          window.confirmationResult = confirmationResult;
          coderesult = confirmationResult;
          console.log(coderesult);

          $("#sentSuccess").text("Message Sent Successfully.");
          $("#sentSuccess").show();

        }).catch(function(error) {
          $("#error").text(error.message);
          $("#error").show();
        });

      }

      function codeverify() {

        var code = $("#verificationCode").val();

        coderesult.confirm(code).then(function(result) {
          var user = result.user;
          console.log(user);

          $("#successRegsiter").text("you are register Successfully.");
          $("#successRegsiter").show();

        }).catch(function(error) {
          $("#error").text(error.message);
          $("#error").show();
        });
      }
    </script>