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
	   	@include('admin.includes.validation')	
			<div class="page-content">
            <h6 class="mb-0 text-uppercase">Orders </h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Product name</th>
										<th>Product Price</th>
										<th>Qty</th>
										<th>Description</th>
										<th>Deliver From</th>
										<th>Deliver To</th>
										<th>During Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->product_name}}</td>
                                            <td>${{$row->product_price}}</td>
                                            <td>{{$row->product_qty}}</td>
                                            <td>{{$row->product_details}}</td>
                                            <td>{{$row->deliver_from}}</td>
                                            <td>{{$row->deliver_to}}</td>
                                            <td>{{$row->during_time}}</td>
                                            <td>
                                                <a href="">edit</a>
                                                <a href="">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
                                        <th>Product name</th>
										<th>Product Price</th>
										<th>Qty</th>
										<th>Description</th>
										<th>Deliver From</th>
										<th>Deliver To</th>
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