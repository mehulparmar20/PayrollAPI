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
            <h6 class="mb-0 text-uppercase">Top Shops </h6>
			<h6 class="mb-0 text-uppercase"><a href="{{route('admin.create_topShop')}}">Add new </a></h6>
				<hr/>
				<div class="card">
					@include('admin.includes.validation')	
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Url</th>
										<th>Brand_img</th>
										<th>Logo</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data as $row)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$row->name}}</td>
											<td><a href="{{$row->url}}" target="_blank">click here</a></td>
											<td>
                                                <img src="{{URL::to('/')}}/public/upload/top_shops/brand_img/{{$row->brand_img}}">
                                            </td>
											<td><img src="{{URL::to('/')}}/public/upload/top_shops/logo/{{$row->logo}}"></td>
											<td>
												<a href="{{route('admin.edit_topShop',['id'=>$row->id])}}"><i class='bx bxs-edit-alt'></i></a>
												<a href="{{route('admin.delete_topShop',['id'=>$row->id])}}" onclick="return confirm('Are you sure you want to delete this ?');"><i class='bx bxs-trash-alt'></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
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