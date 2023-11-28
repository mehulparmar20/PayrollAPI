
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
    #id1{
        position: absolute;
        left:-120px;
        top:50px;
    }
    .custom-box {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 20px;
        }
</style>
<body>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 custom-box">
            <form action="{{ route('custom-login') }}" method="POST">
                @csrf
                
                <div class="form-group text-center">
                    <h1>Login Form</h1>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
               
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
               
            </form>
        </div>
    </div>
</div>

</body>
</html>