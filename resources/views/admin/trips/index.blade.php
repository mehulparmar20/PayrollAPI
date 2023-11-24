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
            <h6 class="mb-0 text-uppercase">All Trips</h6>
				<hr/>
				<div class="card">
					@include('admin.includes.validation')	
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Travel From</th>
										<th>Travel To</th>
										<th>During Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($TripData as $row)
                                        <tr>
                                            <td>{{$row->fromCountry}}</td>
                                            <td>{{$row->toCountry}}</td>
                                            <td>{{$row->travel_date}}</td>
                                            <td>
                                                <a href="">edit</a>
                                                <a href="">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Travel From</th>
										<th>Travel To</th>
										<th>During Time</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
            </div>
        </div>
		@include('admin.includes.footer')
	</div>
	<!--end wrapper-->
	@include('admin.includes.footer_script')

	

</body>

</html>