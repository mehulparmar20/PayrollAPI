<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Identity Sample</title>
    <meta name="description" content="A demo of Stripe Identity" />
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/custom/css/normalize.css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/custom/css/global.css" />
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <div class="sr-root">
      <div class="sr-main">
        <section class="container">
          <div>
            <h1>Verify your identity to book</h1>
            <h4>Get ready to take a photo of your ID and a selfie</h4>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <button id="verify-button">Verify me</button>
          </div>
        </section>
      </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', async () => {

            // Set your publishable key: remember to change this to your live publishable key in production
            // Find your keys here: https://dashboard.stripe.com/apikeys
            // const {publishableKey} = await fetch('/config').then(r=>r.json());
            var publishableKey="pk_test_51MOweQArAHfnnpVFcXeEMtExJZJ70BB2sEyKXreV4CqAOcAVDk4ZuxllwksiMWXnxSd3NYxRDKQotv9ivH41fri800R2Im8EZh";
            // console.log(typeof(publishableKey));
            const stripe = Stripe(publishableKey);
            
            var verifyButton = document.getElementById('verify-button');
            verifyButton.addEventListener('click', async () => {
              // alert("dfdsfdsfds");
                // Get the VerificationSession client secret using the server-side
                // endpoint you created in step 3.
                //
                try 
                {
                  // var base_path =document.getElementById("url").value;
                    // var r = "";
                    // alert("dfdsfdsf");
                    // var json = JSON.parse(d);
                    // Create the VerificationSession on the server.
                    const {client_secret} = await fetch('/b4m/create_verification_session', {
                    method: 'get',
                    // data:{"token": $("#token").val();},
                    }).then(r => r.json())
                    
                    // Open the modal on the client.
                    const {error} = await stripe.verifyIdentity(client_secret);
                    if(!error) 
                    {
                        window.location.href = base_path+'/submitted';
                    } 
                    else 
                    {
                        alert(error.message);
                    }
                    } 
                catch(e) 
                {
                    alert(e.message);
                }
            });
            
        });
    </script>
  </body>
</html>