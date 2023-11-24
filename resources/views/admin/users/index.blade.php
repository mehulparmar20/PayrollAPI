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
            <h6 class="mb-0 text-uppercase">All Users </h6>
			 <a href="{{route('admin.user_Create')}}">Add user</a>
				<hr/>
				<div class="card">
					<div class="card-body">
						@include('admin.includes.validation')	
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>email</th>
										<th>Mobile</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($userData as $row)
                                        <tr>
                                            <td>{{$row->first_name}}</td>
                                            <td>{{$row->last_name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->mobile}}</td>
                                            <td>
                                                <a href="{{route('admin.user_edit',['id'=>$row->id])}}">edit</a>
                                                <a href="{{route('admin.user_delete',['id'=>$row->id])}}" onclick="return confirm('Are you sure you want to delete this ?');">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
                                        <th>First Name</th>
										<th>Last Name</th>
										<th>email</th>
										<th>Mobile</th>
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