@include('frontend.includes.header')
<body>
  @include('frontend.includes.nav')
  <!-- header end -->
  <div class="container mt-4 setting-page-container">
    <div class="row">
      <div class="col-sm-4 mb-5">
        <ul class="list-group">
          <li class="list-group-item menu-list settings-list profile active" data-target="profile">Profile Settings</li>
          <li class="list-group-item menu-list settings-list account" data-target="account">Account Details</li>
          <li class="list-group-item menu-list settings-list" data-target="payout">Payout Method</li>
          <li class="list-group-item menu-list settings-list" data-target="history">Payout History</li>
          <li class="list-group-item menu-list settings-list" data-target="wallet">Wallet</li>
          <li class="list-group-item menu-list settings-list" data-target="notification">Notification</li>
        </ul>
      </div>
      <div class="col-sm-8">
        <!--profile section starts here -->
        <div class="container content-container" id="profile">
          <!-- <form method="post"> -->
            @csrf
            <h3 class="content-container-heading">Profile Settings</h3>
            <div class="profile-image-container-main">
              <div class="profile-image-container">
                @if($user_data->profile !="" || $user_data->profile !=null)
                  <img class="img-fluid profile-img pro_img_show" src="{{URL::to('/')}}/public/upload/profile_img/{{$user_data->profile}}" id="output"/>
                @else
                <img class="img-fluid profile-img pro_img_show"  src="{{URL::to('/')}}/public/frontend/assets/img/profile/3135715.png" id="output"/>
                @endif
              </div>
              <div class="upload-container">
              <input type="file" accept="image/*" id="profile_img_up" onchange="loadFile(event)">
          
                <!-- <input type="file" name="profile" class="button button-primary" id="upload-btn"  onchange="loadFile(event)">Upload photo -->
                <small><em>Maximum size of 5 MB (JPG, GIF, or PNG)</em> </small>
              </div>
            </div>
            <div class="profile-info-container my-4">
              <p class="fw-bold profile-info-title">Profile settings</p>
              <div class="profile-info-input-container">
                <input type="hidden" name="id" value="{{$user_data->id}}">
                <input class="my-4" type="text" placeholder="First Name" name="first_name" id="fname" value="{{$user_data->first_name}}">
                <input class="my-4" type="text" placeholder="Last Name" name="last_name" id="lname" value="{{$user_data->last_name}}">
                <textarea class="mt-2 mb-4" placeholder="Bio" id="biotextarea" style="height: 100px" name="description">{{$user_data->description}}</textarea>
                <button class="button button-primary w-100 mt-4 py-4 update_pro_setting" type="submit" id="update_pro_setting">Submit</button>
              </div>
            </div>
          <!-- </form> -->
        </div>
        <!--profile section starts here -->
        <!--account section starts here -->
      
      <div class="container content-container" id="account">
            <h3 class="content-container-heading mb-5">Account Details</h3>
            <div class="change-password-container">
                <div class="password-text-container">
                    <h5 class="change-password-title fw-bold">Change Password</h5>
                    <p class="change-password-message">We will send recovery link.</p>
                </div>
                <button class="send-button button button-primary">Send</button>
            </div>
            <div class="change-email-container my-3">
                <div class="email-text-container">
                    <h5 class="change-email-title fw-bold">Email</h5>
                    <input placeholder="Enter your email" type="email" name="email" id="emailinput" value="{{$user_data->email}}">
                </div>
                <button class="email-update-button button button-primary update_pro_setting" type="submit">Update</button>
            </div>
            <div class="phone-number-container-main my-3">
                <div class="phone-number-container">
                    <h5 class="change-phone-number fw-bold">Phone Number</h5>
                    <input placeholder="Enter your phone number" type="telephone" name="mobile" id="phoneinput" value="{{$user_data->mobile}}">
                </div>
                <button class="phone-update-button button button-primary update_pro_setting" type="submit">Update</button>
            </div>
            <div class="number-info">
                <p class="number-info-text">Your number won’t be shared with any community member until an order is confirmed.</p>
            </div>
            <div class="account-del-container">
                <p class="account-del-text text-center"><a href"#" class="text-danger " id="delete-btn">Delete Your Account</a></p>
            </div>
      </div>
      <!--account section ends here -->
      
      <!--payout section starts-->
      <div class="container content-container" id="payout">
        <h3 class="content-container-heading">Payout Method</h3>
        <div class="payout-method-container">
            <h5 class="country-title fw-bold">Your Country</h5>
        </div>
      </div>
      <!--payout section ends -->
      <!--history section starts -->
      <div class="container content-container" id="history">
        <h3 class="content-container-heading">Payout History</h3>
        <p>You don't have any payouts yet. Your payouts will be shown here once you complete a delivery.</p>
      </div>
      <!--history section ends -->
      
      <!--wallet section starts-->
      <div class="container content-container" id="wallet">
          <div class="wallet-balance-container">
              <div class="wallet-balance-display-container">
                    <small class="wallet-balance-title">Your balance</small>
                    <h2 class="balance fw-bold">₹0.00 </h2> 
              </div>
              <button class="button button-primary p-3" id="top-up">Top Up</button>
          </div>
      </div>
      <!--wallet section ends-->
       <!--notification section starts -->
      <div class="container content-container" id="notification">
        <h3 class="notification-section-title content-container-heading">Notification</h3>
            <div class="notification-container">
                <h5 class="notification-title">Status Updates on orders</h5>
                <p class="notification-description">Manange your notifications of Buy4Me here.</p>
            </div>
            <div class="notification-switch-container">
                    <div class="form-check form-switch">
                      <label class="form-check-label" for="flexSwitchCheckChecked">Email</label>
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                    <div class="form-check form-switch">
                      <label class="form-check-label" for="flexSwitchCheckChecked">Push Notification</label>
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                    <div class="form-check form-switch">
                      <label class="form-check-label" for="flexSwitchCheckChecked">SMS</label>
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                    <h5 class="tips-title notification-title">Tips and offers</h5>
                    <p class="tips-description">Get exclusive offers about latest products in Buy4Me.</p>
                    <div class="form-check form-switch">
                      <label class="form-check-label" for="flexSwitchCheckChecked">WhatsApp</label>
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    </div>
                    
                    <h5 class="tips-title notification-title">Sales and Promotions</h5>
                    <p class="tips-description">Receive coupons, promotions, surveys, product updates, and inspiration from Buy4Me.</p>
                    <div class="form-check form-switch">
                      <label class="form-check-label" for="flexSwitchCheckChecked">Email</label>
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    </div>
            </div>
            
      </div>
      </div>
      <!--notification section ends -->
  </div>
</div>

</div>
</body>
	   
        <!-- menu area end -->
	    @include('frontend.includes.footer')
		<!-- all js here -->
     @include('frontend.includes.footer_script')
    </body>
</html>
