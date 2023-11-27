@extends('master')
@section('content')
    
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<div class="row">
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
			  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Plans</span>
				<span class="info-box-number">
                      {{-- {{ $count['resume'] }} --}}
        </span>
			  </div>
			</div>
		  </div>
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bell"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Notifications</span>
				<span class="info-box-number">
                    {{-- {{ $count['sell'] }} --}}
        </span>
			  </div>
			</div>
		  </div>
		  <div class="clearfix hidden-md-up"></div>

		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">Taxs</span>
				<span class="info-box-number">
                    {{-- {{ $count['job'] }} --}}
        </span>
			  </div>
			</div>
		  </div>
		
		</div>
	</div>
</section>
   
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
           
            <!-- /.card -->

           
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection