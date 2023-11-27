@extends('master')
@section('content')
    <div class="container">
        <form action="{{route('plan-update',$data->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            {{-- <a class="btn" href="" style="color:white;">Jobs</a> --}}
            <div class="row">
                <div class="col-xl ">
                    <div class="card">

                        <div id="color1" class="card-header px-4 py-3">
                            <h5 class="nav mb-0" style="color:white;"><b>Edit Plan Subscription</b></h5>
                        </div>



                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <label for="plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="edit_plan_name" name="plan_name"
                                        placeholder="Enter Plan Name" value="{{$data->plan_name}}">
                                    @error('plan_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="edit_price" name="price"
                                        placeholder="Enter Price" value="{{$data->price}}">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                          <div class="col-6">

                                    <br> <label for="product_id" class="form-label">Product ID</label>
                                    <input type="text" class="form-control" id="edit_product_id" name="product_id"
                                        placeholder="Enter Product ID"value="{{$data->product_id}}">
                                    @error('product_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">

                                    <br> <label for="employee_id" class="form-label">Employee NO</label>
                                    <input type="text" class="form-control" id="edit_employee_id" name="employee_no"
                                        placeholder="Enter Employee NO" value="{{$data->employee_no}}">
                                    @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>


                            </div>
                 <div class="row">
                                <div class="col-6">
                                    <br /> <label for="tax_id" class="form-label">Tax ID</label>
                                        <select type="text" class="form-control" name="tax_id" id="edit_tax_id" placeholder="Enter Tax ID">
                                            <option value="">Select Tax</option>
                                             <option value="1">Temporary Tax</option>
                                             <option value="2">Permanent Tax</option>
                                             
                                         </select>
                                    @error('tax_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <br /> <label for="description" class="form-label">Description</label>
                                    <textarea  class="form-control" name="description" id="edit_description" rows="3">{{$data->description}}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <button type="submit" class="btn btn-success" id="storeplan"
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
