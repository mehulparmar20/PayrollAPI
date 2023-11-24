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
            <h6 class="mb-0 text-uppercase">States </h6>
			<h6 class="mb-0 text-uppercase"><a href="{{route('admin.create_state')}}">Add new </a></h6>
				<hr/>
				<div class="card">
					@include('admin.includes.validation')	
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Country Name</th>
										<th>City name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data as $row)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$row->name}}</td>
											<td>{{$row->city_name}}</td>
											<td>
												<a href="{{route('admin.edit_state',['id'=>$row->id])}}">edit</a>
												<a href="{{route('admin.delete_state',['id'=>$row->id])}}" onclick="return confirm('Are you sure you want to delete this ?');">delete</a>
											</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>#</th>
                                        <th>Country Name</th>
										<th>City name</th>
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