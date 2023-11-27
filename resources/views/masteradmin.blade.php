@extends('master')
@section('content')
    <div class="container">
        <form action="{{route('masteradmin-store')}}"method="post" enctype="multipart/form-data">
            @csrf
            {{-- <a class="btn" href="" style="color:white;">Jobs</a> --}}
            <div class="row">
                <div class="col-xl ">
                    <div class="card">

                        <div id="color1" class="card-header px-4 py-3">
                            <h5 class="nav mb-0" style="color:white;"><b>Master Admin</b></h5>
                        </div>



                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="create_name" name="name"
                                        placeholder="Enter Name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="create_email" name="email"
                                        placeholder="Enter Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="create_password" name="password"
                                        placeholder="Enter Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <button type="submit" class="btn" id="storejob"
                                        style="color:white;margin-bottom: 15px !important; margin-left: 25px;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <style>
            .card-header,
            .btn {
                background-color: rgb(25, 132, 146);
            }
        </style>
    </div>
    </div>
@endsection
