 <!-- Modal -->
<div class="modal fade" id="openLoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center> <h5 class="modal-title" id="exampleModalLongTitle">Sign in</h5>
                </button></center>
            </div>
            <div class="modal-body">
                <div id="login_form_modal" class="form-modalX">
                    <!-- <input type="hidden" name="previous_url" value="{{url()->current()}}" id="get_url_re">
                    <input type="email" name="email" id="email_login" placeholder="Email">
                    <input type="password" name="password" placeholder="Create Password" id="password_login"> -->
                    <input type="hidden" name="previous_url" value="{{url()->current()}}" id="get_url_re">
<div class="form-group">
    <label for="email_login">Email</label>
    <input type="email" class="form-control formIPW" name="email" id="email_login" placeholder="Email">
</div>

<div class="form-group">
    <label for="password_login">Password</label>
    <input type="password" class="form-control formIPW" name="password" id="password_login" placeholder="Password">
</div>

                    <div class="button-box">
                        <!-- <button  type="button" onclick="go_registrion_modal()">Registration</button>
                        <button class="default-btn floatright" id="login_auth">Login</button> -->
                        <div class="menu-btnX-area text-center mt-1" >
                    <button  type="button"  class="menu-btnX btn-hover" style="border:none" onclick="go_registrion_modal()">Register</button>
                <button  type="button" class="menu-btnX btn-hover" style="border:none" id="login_auth">login</button>
                <button  type="button"  class="menu-btnX btn-hover" style="border:none" onclick="go_forgotpassword_modal()">Forgot Password</button>
               
            </div>
                    </div>
                
                </div>
                <div id="registrion_form_modal">
                    @csrf
                    <!-- <input type="email" name="email" placeholder="Email" class="form-group" id="email_registrion">
                    <input type="password" name="password" placeholder="Create Password" id="password_registrion"> -->

                    <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control formIPW2" name="email" id="email_registrion" placeholder="Email">
</div>

<div class="form-group">
    <label for="password_login">Create Password</label>
    <input type="password" class="form-control formIPW2" name="password" id="password_registrion" placeholder="Create Password">
</div>


                    <input name="first_name" placeholder="First Name" type="text" id="first_name_registrion">
                    <input name="last_name" placeholder="Last Name" type="text" id="last_name_registrion">
                    <div class="button-box">
                    <!-- <button  type="button" onclick="go_login()">login</button>
                    <button type="button" id="registrion_auth" class="default-btn floatright">Register</button> -->

                    <div class="menu-btnX-area text-center mt-1" >
                    <button  type="button"  class="menu-btnX btn-hover" style="border:none" id="registrion_auth">Register</button>
                    <button  type="button" class="menu-btnX btn-hover" style="border:none" onclick="go_login()">login</button>
            </div>
                    
                    </div>
               
                </div>

                <!-- updaten -->
                 <div id="forgotpassword_form_modal">
                    @csrf
                    <!-- <input type="email" name="email" placeholder="Email" class="form-group" id="email_registrion">
                    <input type="password" name="password" placeholder="Create Password" id="password_registrion"> -->

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control formIPW2" name="email" id="email_forgotpassword" placeholder="Email">
                    </div>

                  
                    <div class="button-box">
                    <!-- <button  type="button" onclick="go_login()">login</button>
                    <button type="button" id="registrion_auth" class="default-btn floatright">Register</button> -->
                    <div class="menu-btnX-area text-center mt-1" >
                    <button  type="button"  class="menu-btnX btn-hover" style="border:none" id="forgot_passsword">Forgot Password</button>
                    <button  type="button" class="menu-btnX btn-hover" style="border:none" onclick="go_login()">login</button>

                    </div>
                    </div>
               
                </div>


            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary closeLoginModal" onclick="closeLoginModal()" >Close</button> -->
                <div class="menu-btnX-area text-center mt-1" >
                <button  type="button" class="menu-btnX btn-hover closeLoginModal" style="border:none" onclick="closeLoginModal()">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="emailverifyPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center> <h5 class="modal-title" id="exampleModalLongTitle">Email verify</h5>
                </button></center>
            </div>
            <div class="modal-body">
                <div class="testimonials-area pt-120 pb-115">
                    <div class="container">
                        <div class="testimonials-active owl-carousel">
                            <div class="single-testimonial-2 text-center">
                            <h3>Verify Your Email AddressM</h3>
                                <p> A fresh verification link has been sent to your email address</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>