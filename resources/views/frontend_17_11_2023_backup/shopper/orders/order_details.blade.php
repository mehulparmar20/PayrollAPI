@extends('layouts.app')

@section('pages')


<section id="services" class="services">
   <div class="container">
   <div class="card-body white-card">
      <div class="row">
         <div class="col-md-6 ">
            @if(!empty($data))
            <?php
                $currency = '';
                if(!empty($data) && $data->currency == 'USD') {
                    $currency = '$';
                } else {
                    $currency = 'INR';
                }

                $img = explode(' , ', $data['product']['image']);
            ?>
            @foreach($img as $i)
                <?php
                    $i = trim(str_replace([']', '['], " ", $i));
                ?>
            @endforeach

            <!-- <div class="_product-images">
                <img class="img-fluid" src="{{ URL::to('/') }}/public/product_img/{{ $i }}" alt="">
            </div> -->

			<div class="testimonial-imageOD  text-center">
                        <img src="{{ URL::to('/') }}/public/product_img/{{ $i }}" alt="Testimonial Image" class="img-fluid" style="max-height: 400px;">
                      </div>
            @endif
         </div>
         <div class="col-md-6">
            <div class="_product-detail-content">
               <p class="_p-name" id="summ_productName">
                   <span class="productN1">{{ $data['product']['product_name'] }}</span>
               </p>
               <div class="_p-price-box">
                  <div class="p-list">
                     <span class="price">${{ $data->product_price }}</span>
                  </div>
                  <div class="_p-qty">
                     <dl class="row">
                        <dt class="col-sm-3"><span class="detailsXX">From</span></dt>
                        <dd class="col-sm-9"><span class="countryX">{{ $data->origincountry }} </span>,</dd>
                        <dt class="col-sm-3"><span class="detailsXX">To</span></dt>
                        <dd class="col-sm-9"><span class="showCountry">{{ $data['destination']['destination_country'] }}, {{ $data['destination']['destination_city'] }}</span></dd>
                        <dt class="col-sm-3"><span class="detailsXX">Before</span></dt>
                        <dd class="col-sm-9">{{ date("M d, Y", strtotime($data->deliverd_date)) }},</dd>
                        <dt class="col-sm-3"><span class="detailsXX">QTY</span></dt>
                        <dd class="col-sm-9"><span class="details-price1b">{{ $data->quantity }}</span></dd>
                        <dt class="col-sm-3"><span class="detailsXX">Reward</span></dt>
                        <dd class="col-sm-9"><span class="details-price1b">{{ $currency }}{{ $data->traveller_reward }}</span></dd>
                        <dt class="col-sm-3"><span class="detailsXX">Buy4Me Fee</span></dt>
                        <dd class="col-sm-9"><span class="details-price1b">{{ $currency }}{{ $data->Buy4me_fee }}</span></dd>
                        <div class="details-price">
                            <span>Payment Processing</span>
                            <span id=""><span class="details-price1b">{{ $currency }}{{ $data->proccessing_fee }}</span></span>
                        </div>
                        <dt class="col-sm-3"><span class="detailsXX">Total</span></dt>
                        <dd class="col-sm-9"><span class="details-price1b">{{ $currency }}{{ $data->total }}</span></dd>
                     </dl>
                  </div>
				  <form action="" method="post" accept-charset="utf-8">
                     <ul class="spe_ul"></ul>
                     <div class="_p-qty-and-cart">
                        <div class="_p-add-cart">
						<div class="d-flex gap-3 mt-3">
						
						<?php if(url()->previous()==URL::to('/')."/create_order"){  ?>
							<div class="menu-btnX-area text-center mt-10">
                        		<a class="menu-btnX btn-hover" href="{{route('user.create_order',['id'=>$data->id])}}">Request this Item</a>
                    		</div>
						<?php }else{ ?>
								
					    <div class="menu-custbtn11-area text-center mt-10">
                        	<!-- <a class="menu-custbtn" href="{{--route('shopper.matched_order',$data)--}}">Find Traveller</a> -->
							<a class="menu-custbtn11" href="{{route('shopper.matched_order',$data) }}">Find Traveller</a>
                         </div>
						 	
					     <div class="menu-custbtn11-area text-center mt-10">
                        <a class="menu-custbtn11" href="{{ route('user.edit_order',['id'=>$data->id])}}">Edit</a>
                         </div>
					     <div class="menu-custbtn11-area text-center mt-10">
                        <a class="menu-custbtn11" href="{{route('user.order_cancle',['id'=>$data->id,'status'=>'cancle'])}}" onclick="return confirm('Are you sure you want to cancle this ?');">Cancel</a>
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
   </div>
</section>

<hr/>

<?php if(url()->previous() != URL::to('/')."/create_order"){  ?>
    <div class="container">
        <div class="card-body custmarginXO white-card">
            <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i></div>
                            <div class="tab-title">Product Description</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i></div>
                            <div class="tab-title">Tags</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i></div>
                            <div class="tab-title">Reviews</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#traveller_offer_list" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i></div>
                            <div class="tab-title">Traveller's offer</div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content pt-3">
                <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                    <p class="card-text fs-6">{{ $data['product']['product_details'] }}</p>
                </div>
                <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                </div>
                <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iPhone skateboard locavore Carles Etsy salvia banksy hoodie helvetica. DIY synth PBR Banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, Carles pitchfork biodiesel fixie Etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                </div>
                <div class="tab-pane fade" id="traveller_offer_list" role="tabpanel">
                    @foreach($TravellerOffer as $row)
                        <p>Traveller <b><a href="{{ route('user.check_trOffer', ['id' => $row->order_id]) }}">{{ $row->first_name }} {{ $row->last_name }}</a></b> send you an offer for this product. He/She can deliver this product to you for <b>${{ number_format($row->product_price, 2, '.', ',') }}</b> and a Traveller Reward of <b>${{ number_format($row->travel_reward, 2, '.', ',') }}</b></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        NO product found
    </div>

<?php } ?>

@endsection
