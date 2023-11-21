<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<style>
    .custom-box {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px 0;
        }
</style>
<body>
   <div class="container" style="margin-top: 88px;">
    <h1 style="text-align: center;">Registration Form</h1>
        <div class="row custom-box">
        
            <div class="col-6">
                <!-- <h1>Registration Form - Part 1</h1> -->
                <form class="row" action="{{ route('custom-register') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="inputUsername" class="form-label">First name</label>
                        <input type="text" placeholder="First Name" class="form-control" name="first_name" required>
                    </div>
                    <div class="col-12">
                        <label for="inputUsername" class="form-label">Last name</label>
                        <input type="text" placeholder="Last Name" class="form-control" name="last_name" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Mobile</label>
                        <input type="phone" placeholder="Mobile No." class="form-control" name="contact_no" minLength='10' maxLength='15' required>
                    </div>
              
            </div>
            <div class="col-6">
               
               
                    <div class="col-12">
                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                        <input type="text" placeholder="Email" class="form-control" name="email" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" placeholder="Password" id="admin_password2" class="form-control" name="password" required>
                    </div>
                    <div class="col-12">
                        <label for="user_type" class="form-label">Plan</label>
                        <input type="text" placeholder="Plan" class="form-control" name="user_type" required>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>  