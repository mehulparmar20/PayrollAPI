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
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			@include('admin.includes.validation')
				<div class="row">
					<div class="col-xl-6 mx-auto">
						<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Login</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3 needs-validation" novalidate action="{{route('adminLoginPost')}}" method="post"> 
                                    @csrf
									<div class="col-md-12">
										<label for="bsValidation4" class="form-label">Email</label>
										<input type="email" class="form-control" id="bsValidation4" placeholder="Email" name="email" required>
										<div class="invalid-feedback">
											Please provide a valid email.
										  </div>
									</div>
									<div class="col-md-12">
										<label for="bsValidation5" class="form-label">Password</label>
										<input type="password" class="form-control" id="bsValidation5" placeholder="Create Password" name="password" required>
										<div class="invalid-feedback">
											Please Choose a Password.
										</div>
									</div>
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Login</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		@include('admin.includes.footer')
	</div>
	@include('admin.includes.footer_script')
</body>
</html>