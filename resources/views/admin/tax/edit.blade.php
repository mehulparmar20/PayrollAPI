@extends('master')
@section('content')
    <div class="container">
        <form action="{{route('tax-update',$data->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            {{-- <a class="btn" href="" style="color:white;">Jobs</a> --}}
            <div class="row">
                <div class="col-xl ">
                    <div class="card">

                        <div id="color1" class="card-header px-4 py-3">
                            <h5 class="nav mb-0" style="color:white;"><b>Edit Tax Master</b></h5>
                        </div>



                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <label for="tax_name">Tax Name</label>
                                    <input type="text" class="form-control" id="edit_tax_name" name="tax_name"
                                        placeholder="Enter Tax Name"
                                        value="{{$data->tax_name}}">
                                    @error('tax_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="tax_percentage" class="form-label">Tax Percentage</label>
                                    <input type="text" class="form-control" id="edit_tax_percentage"
                                        name="tax_percentage" placeholder="Enter Tax Percentage"
                                        value="{{$data->tax_percentage}}">
                                    @error('tax_percentage')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <button type="submit" class="btn btn-success" id="storetax"
                                        style="color:white;margin-bottom: 15px !important; margin-left: 25px;">Update</button>
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
