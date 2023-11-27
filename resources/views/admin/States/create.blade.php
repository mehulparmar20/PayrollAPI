@include('admin.includes.header')
<body>
	<!--wrapper-->
	<div class="wrapper">
	 <!--start header wrapper-->	
	  <div class="header-wrapper">
		<!--start header -->
		@include('admin.includes.nav')
		<!--end navigation-->
	   </div>
	   <!--end header wrapper-->
       <div class="page-wrapper">
			<div class="page-content">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
						<div class="card">
							@include('admin.includes.validation')	
							<div class="card-body p-4">
								<h5 class="mb-4">Create State</h5>
                                <form action="{{route('admin.store_state')}}" method="post" >
                                @csrf
									<div class="row mb-3">
                                        <label for="input35" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="city_name" placeholder="Enter City Name" required>
                                        </div>
									</div>
									<div class="row mb-3">
										<label for="input36" class="col-sm-3 col-form-label">Country</label>
										<div class="col-sm-9">
											<select class="form-select single-select-field browsers_country" data-placeholder="Choose one thing" name="country" required>
											</select>
										</div>
									</div>
                                    <div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<div class="d-md-flex d-grid align-items-center gap-3">
												<button type="submit" class="btn btn-primary px-4" >Submit</button>
												
											</div>
										</div>
									</div>
                                </from>
							</div>
						</div>
                    </div><!--end row-->
                </div>
            </div>
		@include('admin.includes.footer')
	</div>
	<!--end wrapper-->
	@include('admin.includes.footer_script')

	

</body>

</html>