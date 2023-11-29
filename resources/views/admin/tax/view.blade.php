@extends('master')
@section('content')
<div class="container">

    <div class="card" style="margin-top: 24px;">
      <div class="card-body">
      <div class="row">
       
      <div class="col-lg-12 margin-tb">
        <div class="d-flex justify-content-between align-items-center">
          <div class="mb-3">
            <h4 class="m-0">TaxMaster Details</h4>
           
          </div>
          <div>
           {{-- <a class="btn btn-success" href="{{route('apply.create',$data->id) }}">Apply Job</a> --}}
          </div>
        </div>
      </div>
    </div>
    
    

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <strong>Tax Name:</strong>
              {{-- @dd($plan)  --}}
              {{$tax->tax_name}}
            </div>
          </div>
  
          <div class="col-md-12">
            <div class="form-group">
              <strong>Tax Percentage:</strong>
              {{$tax->tax_percentage}}
            </div>
          </div>
        
  
       
        </div>
      </div>
    </div>
  </div>
  
  </div>




</div>
    </div>
    </div>
@endsection


