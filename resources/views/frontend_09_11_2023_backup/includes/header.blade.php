<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Buy4me</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('/')}}/public/frontend/assets/img/logo/2.png">

    <!-- all css here -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/animate.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/themify-icons.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/bundle.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/style.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/custom/css/style.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/customcss.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/assets/css/responsive.css">
    <script src="{{URL::to('/')}}/public/frontend/assets/js/vendor/modernizr-3.11.7.min.js"></script>
    <link href="https://www.jquery-az.com/jquery/css/intlTelInput/demo.css" rel="stylesheet" />
    <link href="https://www.jquery-az.com/jquery/css/intlTelInput/intlTelInput.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">

    

    <!-- select two  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    
    <!-- Added By Mehul  -->
    <link href="{{URL::to('/')}}/public/admin/assets/plugins/bs-stepper/css/bs-stepper.css" rel="stylesheet" />
    <script src="{{URL::to('/')}}/public/admin/assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <link href="{{URL::to('/')}}/public/admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{URL::to('/')}}/public/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!--plugins-->
	<script src="{{URL::to('/')}}/public/admin/assets/js/jquery.min.js"></script>
	<script src="{{URL::to('/')}}/public/admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{URL::to('/')}}/public/admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{URL::to('/')}}/public/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{URL::to('/')}}/public/admin/assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
	<script src="{{URL::to('/')}}/public/admin/assets/plugins/bs-stepper/js/main.js"></script>
    <!--app JS-->
	<script src="{{URL::to('/')}}/public/admin/assets/js/app.js"></script>
    <style>
        /* .popup {
            display: none;
            position: fixed;
            float:'top-right';
            top: 20%;
            left: 10%;
            z-index:666;
            transform: translate(-50%, -50%);
            background-color: #087C1D;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            max-width: 60%;
            min-width: 50%;
        } */

.popup {
    display: none;
    position: fixed;
    top: 50%; 
    left: 50%;
    transform: translateX(-50%);
    z-index: 666;
    /* background-color: #087C1D; */
    background-color: #ecb50c;
    /* color: #fff; */
    color:black;
    padding: 20px; 
    border-radius: 5px;
    text-align: center;
    max-width: 25%; 
    min-width: 20%; 
    animation: bounceFromTop 0.5s ease forwards; 
}

@keyframes bounceFromTop {
    0% {
        top: -70%; /* Start above the viewport */
    }
    100% {
        top: 50%; /* Stop at the vertical center */
    }
}

.popup p {
    font-size: 18px; 
    /* color: #fff;  */
    color:black;
    font-weight:600;
}


/* 
        .popup-content {
            max-width: 50%;
            margin: 0 auto;
            color: #fff !important;
        }
        .popup-error{
            display: none;
            position: fixed;
            float:'top-right';
            top: 20%;
            left: 10%;
            transform: translate(-50%, -50%);
            background-color: #D62D08;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            max-width: 60%;
            min-width: 50%;
        } */
        
 .popup-error {
    display: none;
    position: fixed;
    top: -100%; 
    left: 50%;
    transform: translateX(-50%);
    z-index: 666;
    background-color: #D62D08;
    color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    max-width: 25%;
    min-width: 20%;
    animation: slideFromTop 0.5s ease forwards; /* Apply the slide animation */
}

@keyframes slideFromTop {
    0% {
        top: -100%; /* Start above the viewport */
    }
    100% {
        top: 50%; /* Stop at the vertical center */
    }
}

.popup-error p {
    font-size: 18px; /* Increase the font size */
    color: #fff; /* Set text color to white */
}



    </style>
</head>
<body>
@if(\Session::get('success'))
    <!-- <div class="popup" id="success-popup">
        <div class="popup-content">
            <p style="color:#fff;">  {{ \Session::get('success') }}</p>
        </div>
    </div> -->
    <div class="popup alert alert-success" id="success-popup" role="alert">
    <p>{{ \Session::get('success') }}</p>
</div>

@endif
{{ \Session::forget('success') }}
@if(\Session::get('error'))
    <!-- <div class="popup-error" id="error-popup">
    <div class="popup-content">
        <p style="color:#fff;">  {{ \Session::get('error') }}</p>
    </div>
</div> -->
<div class="popup-error" id="error-popup">
    <div class="popup-content">
        <p style="color:#fff;">{{ \Session::get('error') }}</p>
    </div>
</div>


@endif
{{ \Session::forget('error') }}
<script>
    $(document).ready(function() {
       
        function showSuccessPopup() {
            $("#error-popup").fadeIn();
            setTimeout(function() {
                $("#error-popup").fadeOut();
            }, 2000); // Hide after 3 seconds
        }

         function showErrorPopup() {
            $("#success-popup").fadeIn();
            setTimeout(function() {
                $("#success-popup").fadeOut();
            }, 3000); // Hide after 3 seconds
        }
        // Call the function to show the popup (you can trigger this as needed)
        showSuccessPopup();
        showErrorPopup()
    });
</script>
