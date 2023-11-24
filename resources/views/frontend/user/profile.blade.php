@include('frontend.includes.header')


<style>
          body, html {
            height: 100%;
        }
        .center-vertical {
            min-height: 100%;
            display: flex;
            align-items: center;
        }
 
  .profile-section {
    background-color: #ffffff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 60px;
    border-radius: 10px;
  }
  .edit-profile-btn {
    background-color: white;
    color: #ecab10;
    border: 1px solid #ecab10;
    transition: background-color 0.3s, color 0.3s;
    padding: 10px 20px;
    border-radius: 5px;
        }
        .edit-profile-btn:hover {
            background-color: #ecab10;
            color: black;
            text-decoration: none; /* Remove underline on hover */
        }


</style>

<body>
  @include('frontend.includes.nav')
  <div class="product-description-review-area pb-90 profile-page profile-baground">
    <!-- <div class="container">
      <div class="product-description-review">
        <div class="description-review-title nav" role=tablist>
          <a href="#">
            {{$data->first_name}} {{$data->last_name}}
          </a>
          @if($data->profile !="")
          <img src="{{URL::to('/')}}/public/upload/profile_img/{{$data->profile}}" width="100px;">
          @else
          <img src="{{URL::to('/')}}/public/frontend/assets/img/profile/3135715.png" width="100px" alt="">
          @endif
          <div>
          </div>
        </div>

        <div class="container">


          <div class="row">
            <div class="col-md-12">
              <div class="d-flex justify-content-between align-items-center stars-container-main">
                <div class="stars-container first text-center" style="gap: 3rem !important;">
                  <p>Joined {{ date("M d , Y", strtotime($data->created_at))}}</p>
                  <span>Shopper</span>
                  <div class="stars">
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                  </div>
                  <span>(0)</span>
                </div>
                <div class="stars-container second text-center" style="gap: 3rem !important;">
                  <span>Traveller</span>
                  <div class="stars">
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                  </div>
                  <span>(0)</span>
                </div>
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
              <p class="cancelation-line">
                Mobile Number: <span class="font-weight-bold">{{$data->mobile}}</span>
              </p>
            </div>
            <div class="col-md-6">
              <p class="cancelation-line">
                Email: <span class="font-weight-bold">{{$data->email}}</span>
              </p>
            </div>
            <div class="col-md-12">
              <p class="cancelation-line">
                Cancelations rating
                <button class="btn btn-warning" id="statusBtn">PENDING</button>
              </p>
            </div>
          </div>
        </div>


        <div class="pending-hover">
          <p class="pending-hover-text">The traveler has no recent deliveries. <br>
            Cancellations rating is based on the ratio between the number of cancellations and deliveries of the traveler compared to the whole Buy4Me community.
          </p>
        </div>

        <p class="verified-phone-line"><span class="verified-info">VERIFIED INFO </span>@if($data->otp != "") <span class="check-icon-main" style="color:green;"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>phone</span>@else <a href="{{route('user.setting')}}" class="account_details_active"><span class="check-icon-main" style="color:blue;">Verify phone number</span></a>@endif @if($data->email_veryfied != '0')<span class="check-icon-main" style="color:green"><span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>Email</span> @else <a href="{{route('user.setting')}}" class="account_details_active"><span class="check-icon-main" style="color:blue">Verify email</span></a> @endif</p>
        <div class="description-review-text tab-content">
          <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">

            <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
              <a class="menu-btnX" href="{{route('user.setting')}}">Edit Profile</a>
            </div>

          </div>


        </div>
      </div>
    </div> -->



    
  <!-- Dipali latest code start here -->
  <div class="center-vertical">
  <div class="container">
    <div class="profile-section">
      <div class="row">
        <div class="col-md-4">
          <!-- User profile image and name -->
          <div class="text-center">
            <h3>{{$data->first_name}} {{$data->last_name}}</h3>
            @if($data->profile !="")
            <img src="{{URL::to('/')}}/public/upload/profile_img/{{$data->profile}}" width="150px" class="rounded-circle" alt="Profile Image">
            @else
            <img src="{{URL::to('/')}}/public/frontend/assets/img/profile/3135715.png" width="150px" class="rounded-circle" alt="Default Profile Image">
            @endif
          </div>

          <!-- Joined date and user ratings -->
          <div class="mt-3">
            <p>Joined {{ date("M d, Y", strtotime($data->created_at))}}</p>
            <!-- User ratings here -->
          </div>
        </div>

        <div class="col-md-8">
          <!-- User contact information -->
          <div class="row">
            <div class="col-md-6">
              <p><strong>Mobile Number:</strong> <span class="font-weight-bold">{{$data->mobile}}</span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Email:</strong> <span class="font-weight-bold">{{$data->email}}</span></p>
            </div>
            <div class="col-md-12">
              <p class="cancelation-line">
                Cancelations rating
                <button class="btn btn-warning" id="statusBtn">PENDING</button>
              </p>
            </div>
          </div>

          <!-- Additional user information -->
          <div class="mt-3">
            <!-- Information about cancellations and deliveries -->
            <div class="alert alert-info">
              The traveler has no recent deliveries. Cancellations rating is based on the ratio between the number of cancellations and deliveries of the traveler compared to the whole Buy4Me community.
            </div>

            <!-- Verified information -->
            <p><strong>VERIFIED INFO </strong></p>
            <p>
              @if($data->otp != "")
              <span style="color:green;"><i class="fa-regular fa-circle-check"></i> Phone</span>
              @else
              <a href="{{route('user.setting')}}" class="text-primary">Verify phone number</a>
              @endif
              @if($data->email_veryfied != '0')
              <span style="color:green;"><i class="fa-regular fa-circle-check"></i> Email</span>
              @else
              <a href="{{route('user.setting')}}" class="text-primary">Verify email</a>
              @endif
            </p>

            <!-- Edit Profile button -->
            <!-- <div class="menu-btnX-area text-center mt-1" >
              <a class="menu-btnX" href="{{route('user.setting')}}">Edit Profile</a>
            </div> -->

            <div class="text-center">
                    <a href="{{route('user.setting')}}" class="edit-profile-btn">Edit Profile</a>
                </div>
          </div>
        </div>
      </div>

      <!-- Additional content within the profile section -->
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between align-items-center stars-container-main">
            <div class="stars-container first text-center" style="gap: 3rem !important;">
              <!-- <p>Joined {{ date("M d , Y", strtotime($data->created_at))}}</p> -->
              <span>Shopper</span>
              <div class="stars">
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
              </div>
              <span>(0)</span>
            </div>
            <div class="stars-container second text-center" style="gap: 3rem !important;">
              <span>Traveller</span>
              <div class="stars">
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
              </div>
              <span>(0)</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ... -->
  </div>
  </div>
</div>
  <!-- Dipali latest code end here -->




  </div>



















  <!-- profile area end -->
  <!-- menu area end -->
  @include('frontend.includes.footer')
  <!-- all js here -->
  @include('frontend.includes.footer_script')
</body>

</html>