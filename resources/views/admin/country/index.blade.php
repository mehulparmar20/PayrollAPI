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
            <h6 class="mb-0 text-uppercase">All Country </h6>
			 <a href="{{route('admin.create_country')}}">Add new</a>
				<hr/>
				<div class="card">
					@include('admin.includes.validation')	
					<div class="card-body">
						<div class="table-responsive">
							<table id="country_table" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
								<thead>
									<tr>
										<th>Country name</th>
										<th>flag</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($data as $row)
                                  
                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td><img src="{{URL::to('/')}}/public/upload/country_flag/{{$row->flag}}"></td>
                                            <td>
                                                <a href="#">edit</a>
                                                <a href="{{route('admin.delete_country',['id'=>$row->id])}}" onclick="return confirm('Are you sure you want to delete this ?');">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Country name</th>
										<th>flag</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
                            <div > 
                              
                            </div>
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