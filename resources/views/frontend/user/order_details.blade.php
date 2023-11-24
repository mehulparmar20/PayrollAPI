@include('frontend.includes.header')
  <body>
	<?php setlocale(LC_MONETARY, "en_US"); ?>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
	@include('admin.includes.validation')
      <div class="pl-100 pr-100">
        <div class="container-fluid">
              <!-- <div class="section-title-3 text-center mb-40">
                <h2>Orders  Details</h2>
               
              </div> -->
              
                            @include('frontend.user.order_header')

			
<!--			  <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">-->
<!--    <div class="StatusXX"><a class="active menuHeader tab-link" href="#order_Orderpublished" data-bs-toggle="tab" role="tab">-->
<!--	Order published -->
<!--                    </a></div>-->
<!--    <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Offerreceived" data-bs-toggle="tab" role="tab">-->
<!--	Offer received-->
<!--                    </a></div>-->
<!--    <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Offerchosen" data-bs-toggle="tab" role="tab">-->
<!--	Offer chosen-->
<!--                    </a></div>-->
<!--    <div class="StatusXX"><a class="menuHeader tab-link" href="#order_Deliverystarted" data-bs-toggle="tab" role="tab">-->
<!--	Delivery started-->
<!--                    </a></div>-->
<!--    <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">-->
<!--        <a class="menu-custbtn" href="#">Orders  Details</a>-->
<!--    </div>-->
<!--</div>-->

                <?php
                    $img=$data->product_imgs;
                    $img=explode(' , ', $img);
                ?>
<!-- <div class="card">
					<div class="row g-0">
					  <div class="col-md-4">
						
                        @foreach($img as $i)
                        <?php 
                            $i=str_replace([']','[']," " ,$i);
                            $i=trim($i); 
                        ?>
                        @endforeach
                       
						<div class="product-img-2O">
                        <a href="{{URL::to('/')}}/public/upload/product_img/{{$i}}">
                         <img src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" alt="" class="img-fluid">
                            </a>
                       </div>
					  </div>

					  




					  <div class="col-md-4">
						<div class="card-body card-centerX">
						  
						  <h4 class="card-title" id="summ_productName"><a href="#"><span class="productN1">{{$data->product_name}}</span></a></h4>
					

						  
						  
						  <div class="mb-3"> 
							<span><span class="details-price1a">${{$data->product_price}}</span></span>
							
						</div>
						  
						  <dl class="row">
							<dt class="col-sm-3"><span class="detailsXX">From</span></dt>
							<dd class="col-sm-9"> <span class="countryX">{{$data->fromCountry}}</span>,{{$data->fromCity}}</dd>
						  
							<dt class="col-sm-3"><span class="detailsXX">To</span></dt>
							<dd class="col-sm-9">{{$data->toCountry}},{{$data->toCIty}}</dd>
						  
							<dt class="col-sm-3"><span class="detailsXX">Before</span></dt>
							<dd class="col-sm-9">{{ date("M d , Y", strtotime($data->during_time))}} </dd>
						  </dl>
                          <div class="details-price">
                            <span>Total </span>:-<span id="">{{$data->estimated_total}}</span>
                        </div>
					<div class="d-flex gap-3 mt-3">
						<?php if(url()->previous()==URL::to('/')."/create_order"){  ?>
								
								<div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX btn-hover" href="{{route('user.create_order2',['id'=>$data->id])}}">Request this Item</a>
                    </div>
								<?php }else{ ?>
					    <div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX btn-hover" href="{{route('user.matched_order',['id'=>$data->id,'status'=>$from])}}">Find Traveller</a>
                         </div>
					     <div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX btn-hover" href="{{route('user.edit_order',['id'=>$data->id])}}">Edit</a>
                         </div>
					     <div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX btn-hover" href="{{route('user.order_cancle',['id'=>$data->id,'status'=>'cancle'])}}" onclick="return confirm('Are you sure you want to cancle this ?');">Cancel</a>
                         </div>
								<?php } ?>
						</div>
						</div>
					  </div>


					  <div class="col-md-4">
						<div class="card-body card-centerX2">
						<div class="row">
						<div class="details-price">
                            <span>Reward</span>:-<span id=""><span class="details-price1b">{{$data->traveller_reward}}</span></span>
                        </div>
						<div class="details-price">
                            <span>Tax</span>:-<span id=""><span class="details-price1b">{{$data->us_sale_tax}}</span></span>
                        </div>
						<div class="details-price">
                            <span>Buy4Me Fee</span>:-<span id=""><span class="details-price1b">{{$data->buy4me_fee}}</span></span>
                        </div>
						<div class="details-price">
                            <span>Payment Processing</span>:-<span id=""><span class="details-price1b">{{$data->payment}}</span></span>
                        </div>
        </div>
						<div class="details-price">
                            <span>QTY</span>:-<span id="">{{$data->product_qty}}</span>
                        </div>
						</div>
					  </div>
</div> -->








<!-- <section id="services" class="services section-bg"> -->
<section id="services" class="services">
   <div class="container-fluid">
      <div class="row row-sm">
         <div class="col-md-6 _boxzoom">
		 @foreach($img as $i)
                        <?php 
                            $i=str_replace([']','[']," " ,$i);
                            $i=trim($i); 
                        ?>
                        @endforeach
            <div class="_product-images">
               <div class="picZoomer">
			      <!-- <a href="{{URL::to('/')}}/public/upload/product_img/{{$i}}"> -->
                  <img class="my_img" src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" alt="">
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="_product-detail-content">
               <p class="_p-name" id="summ_productName">
			   <span class="productN1">{{$data->product_name}}</span>
			   </p>
               <div class="_p-price-box">
                  <div class="p-list">
                     <span class="price">${{$data->product_price}}</span>
                  </div>
                  <div class="_p-add-cart">
                     <div class="_p-qty">
					 <dl class="row">
							<dt class="col-sm-3"><span class="detailsXX">From</span></dt>
							<dd class="col-sm-9"> <span class="countryX">{{$data->fromCountry}}</span>,{{$data->fromCity}}</dd>
						  
							<dt class="col-sm-3"><span class="detailsXX">To</span></dt>
							<dd class="col-sm-9"><span class="showCountry">{{$data->toCountry}},{{$data->toCIty}}</span></dd>
						  
							<dt class="col-sm-3"><span class="detailsXX">Before</span></dt>
							<dd class="col-sm-9">{{ date("M d , Y", strtotime($data->during_time))}} </dd>

							<dt class="col-sm-3"><span class="detailsXX">Total</span></dt>
							<dd class="col-sm-9"> <span class="details-price1b">{{$data->estimated_total}}</span></dd>

							<dt class="col-sm-3"><span class="detailsXX">Reward</span></dt>
							<dd class="col-sm-9"><span class="details-price1b">{{$data->traveller_reward}} </span></dd>

							<dt class="col-sm-3"><span class="detailsXX">Tax</span></dt>
							<dd class="col-sm-9">{{$data->us_sale_tax}}</dd>

							<dt class="col-sm-3"><span class="detailsXX">Buy4Me Fee</span></dt>
							<dd class="col-sm-9"><span class="details-price1b">{{$data->buy4me_fee}} </span></dd>
							<dt class="col-sm-3"><span class="detailsXX">QTY</span></dt>
							<dd class="col-sm-9"> <span class="details-price1b">{{$data->product_qty}}</span></dd>
							<div class="details-price">
                            <span>Payment Processing</span>:-<span id=""><span class="details-price1b">{{$data->payment}}</span></span>
                           </div>	
						  </dl>
                     </div>
                  </div>
                  <form action="" method="post" accept-charset="utf-8">
                     <ul class="spe_ul"></ul>
                     <div class="_p-qty-and-cart">
                        <div class="_p-add-cart">
						<div class="d-flex gap-3 mt-3">
						<?php if(url()->previous()==URL::to('/')."/create_order"){  ?>
								<div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX btn-hover" href="{{route('user.create_order2',['id'=>$data->id])}}">Request this Item</a>
                    </div>
								<?php }else{ ?>
					    <div class="menu-custbtn-area text-center mt-10">
                        <a class="menu-custbtn" href="{{route('user.matched_order',['id'=>$data->id,'status'=>$from])}}">Find Traveller</a>
                         </div>
					     <div class="menu-custbtn-area text-center mt-10">
                        <a class="menu-custbtn" href="{{route('user.edit_order',['id'=>$data->id])}}">Edit</a>
                         </div>
					     <div class="menu-custbtn-area text-center mt-10">
                        <a class="menu-custbtn" href="{{route('user.order_cancle',['id'=>$data->id,'status'=>'cancle'])}}" onclick="return confirm('Are you sure you want to cancle this ?');">Cancel</a>
                         </div>
								<?php } ?>
                              
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>















                    <hr/>
					<?php if(url()->previous()!=URL::to('/')."/create_order"){  ?>
						<div class="card-body custmarginXO">
							<ul class="nav nav-tabs nav-primary mb-0" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
										<div class="d-flex align-items-center">
											<div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
											</div>
											<div class="tab-title"> Product Description </div>
										</div>
									</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
										<div class="d-flex align-items-center">
											<div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
											</div>
											<div class="tab-title">Tags</div>
										</div>
									</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
										<div class="d-flex align-items-center">
											<div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
											</div>
											<div class="tab-title">Reviews</div>
										</div>
									</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" data-bs-toggle="tab" href="#traveller_offer_list" role="tab" aria-selected="false">
										<div class="d-flex align-items-center">
											<div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
											</div>
											<div class="tab-title">Traveller's offer</div>
										</div>
									</a>
								</li>
							</ul>
							<div class="tab-content pt-3">
								<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
									<p class="card-text fs-6">{{$data->product_details}}</p>
								</div>
								<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
									<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
								</div>
								<div class="tab-pane fade" id="primarycontact" role="tabpanel">
									<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
								</div>
								<div class="tab-pane fade" id="traveller_offer_list" role="tabpanel">
									@foreach($TravellerOffer as $row)
										<p>Traveller <b><a href="{{route('user.check_trOffer',['id'=>$row->order_id])}}">{{$row->first_name}} {{$row->last_name}}</a></b> send you Offer for this Product He/She can deliver this product to you for <b>${{number_format($row->product_price, 2, '.', ',') }}</b> and Traveller Rewards for <b>${{number_format($row->travel_reward, 2, '.', ',') }}</b></p>
									@endforeach
								</div>
							</div>
						</div>
					<?php } ?>

				  </div>

              
            </div>
        </div>
    </div>
  </div>

  
        <!-- menu area end -->
	    @include('frontend.includes.footer')
		<!-- all js here -->
     @include('frontend.includes.footer_script')






	 <script>/*!     
        jquery.picZoomer.js
        v 1.0
        David
        http://www.CodingSerf.com
*/

//放大镜控件
;(function($){
	$.fn.picZoomer = function(options){
		var opts = $.extend({}, $.fn.picZoomer.defaults, options), 
			$this = this,
			$picBD = $('<div class="picZoomer-pic-wp"></div>').css({'width':opts.picWidth+'px', 'height':opts.picHeight+'px'}).appendTo($this),
			$pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
			$cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>').appendTo($picBD),
			cursorSizeHalf = {w:$cursor.width()/2 ,h:$cursor.height()/2},
			$zoomWP = $('<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>').appendTo($this),
			$zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
			picBDOffset = {x:$picBD.offset().left,y:$picBD.offset().top};

		
		opts.zoomWidth = opts.zoomWidth||opts.picWidth;
		opts.zoomHeight = opts.zoomHeight||opts.picHeight;
		var zoomWPSizeHalf = {w:opts.zoomWidth/2 ,h:opts.zoomHeight/2};

		//初始化zoom容器大小
		$zoomWP.css({'width':opts.zoomWidth+'px', 'height':opts.zoomHeight+'px'});
		$zoomWP.css(opts.zoomerPosition || {top: 0, left: opts.picWidth+30+'px'});
		//初始化zoom图片大小
		$zoomPic.css({'width':opts.picWidth*opts.scale+'px', 'height':opts.picHeight*opts.scale+'px'});

		//初始化事件
		$picBD.on('mouseenter',function(event){
			$cursor.show();
			$zoomWP.show();
			$zoomPic.attr('src',$pic.attr('src'))
		}).on('mouseleave',function(event){
			$cursor.hide();
			$zoomWP.hide();
		}).on('mousemove', function(event){
			var x = event.pageX-picBDOffset.x,
				y = event.pageY-picBDOffset.y;

			$cursor.css({'left':x-cursorSizeHalf.w+'px', 'top':y-cursorSizeHalf.h+'px'});
			$zoomPic.css({'left':-(x*opts.scale-zoomWPSizeHalf.w)+'px', 'top':-(y*opts.scale-zoomWPSizeHalf.h)+'px'});

		});
		return $this;

	};
	$.fn.picZoomer.defaults = {
        picHeight: 460,
		scale: 2.5,
		zoomerPosition: {top: '0', left: '380px'},

		zoomWidth: 400,
		zoomHeight: 460
	};
})(jQuery); 



$(document).ready(function () {
     $('.picZoomer').picZoomer();
    $('.piclist li').on('click', function (event) {
        var $pic = $(this).find('img');
        $('.picZoomer-pic').attr('src', $pic.attr('src'));
    });
   
  var owl = $('#recent_post');
              owl.owlCarousel({
                margin:20,
                dots:false,
                nav: true,
                navText: [
                  "<i class='fa fa-chevron-left'></i>",
                  "<i class='fa fa-chevron-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items:3
                  },
                  1000: {
                    items:5
                  },
                  1200: {
                    items:4
                  }
                }
  });    
  
        $('.decrease_').click(function () {
            decreaseValue(this);
        });
        $('.increase_').click(function () {
            increaseValue(this);
        });
        function increaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;
            $(_this).siblings('input#number').val(value);
        }

        function decreaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $(_this).siblings('input#number').val(value);
        }
    });
</script>
    </body>
</html>
