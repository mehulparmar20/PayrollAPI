@include('frontend.includes.header')
<?php setlocale(LC_MONETARY,"en_US"); ?>
<body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
        <div class="pl-100 pr-100">
            <div class="container-fluid">
                <div class="section-title-3 text-center mb-40">
                    <h2>Orders  Details1</h2>
                    <?php 
                    // dd('dd'); 
                    ?>
                <!-- <input type="hidden" id="check_travelOfferurl" value="{{url()->current()}}"> -->
                </div>
                <div class="best-product-style">
                    <?php
                   
                        $img=$data->product_imgs;
                        $img=explode(' , ', $img);
                    ?>
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4 border-end">
                                @foreach($img as $i)
                                <?php 
                                    $i=str_replace([']','[']," " ,$i);
                                    $i=trim($i); 
                                ?>
                                @endforeach
                                <a href="{{URL::to('/')}}/public/upload/product_img/{{$i}}">
                                    <img src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" alt="" class="img-fluid">
                                </a>
                            
                            </div>
                            <div class="col-md-8">
                                <form method="post" action="{{route('traveller.create_offer',['id'=>$data->id])}}">
                                    @csrf
                                    <input type="hidden" value="{{ request()->get('matched_id') }}" name="matched_id">
                                    <div class="card-body">
                                    <h4 class="card-title">{{$data->product_name}}</h4>
                                    <dl class="row">
                                        <dt class="col-sm-3">Quantity</dt>
                                        <dd class="col-sm-9">{{$data->product_qty}}</dd>
                                    
                                        <dt class="col-sm-3">Packaging</dt>
                                        <dd class="col-sm-9">@if($data->box=='1') With Box @else Without box @endif</dd>
                                    
                                        
                                    </dl>
                                    <p class="card-text fs-6">{{$data->product_details}}</p>
                                    <input type="hidden" id="pro_ch_price" value="{{$data->product_price}}" name="pro_ch_price">
                                    <input type="hidden" id="qty_ch_price" value="{{$data->product_qty}}" name="qty_ch_price">
                                    <input type="hidden" id="traveller_re_ch_price" value="{{$data->traveller_reward}}" name="traveller_re_ch_price">
                                    <dl class="row">
                                        <dt class="col-sm-3">From</dt>
                                        <dd class="col-sm-9">{{$data->fromCountry}}</dd>
                                        <dt class="col-sm-3">To</dt>
                                        <dd class="col-sm-9">{{$data->toCountry}},{{$data->toCIty}}</dd>
                                    
                                        <dt class="col-sm-3">Before</dt>
                                        <dd class="col-sm-9">{{$data->during_time}} </dd>
                                    </dl>
                                    <dl class="row">
                                    <dt class="col-sm-3">Product Price</dt>
                                        <dd class="col-sm-9" >
                                            <span id="changed_pro_price_tr">${{$data->product_price}}</span>
                                            <input type="number" placeholder="Offer" onkeyup="chnagePriceTraveller('product_price_change','{{$data->buy4me_fee}}','{{$data->payment}}','{{$data->traveller_reward}}')" class="form-group" id="change_product_price_fee" name="change_product_price_fee">
                                        </dd>
                                        <dt class="col-sm-3">Reward</dt>
                                        <dd class="col-sm-9" >
                                            <span id="changed_traveller_re_tr">{{$data->traveller_reward}}</span> 
                                            <input type="number" placeholder="Offer" class="form-group" onkeyup="chnagePriceTraveller('traveller_fee','{{$data->buy4me_fee}}','{{$data->payment}}','{{$data->traveller_reward}}')" id="change_travel_fee" name="change_travel_fee">
                                        </dd>
                                    
                                        <dt class="col-sm-3">Buy4me Fee</dt>
                                        <dd class="col-sm-9" id="changed_buy4me_fee_tr">{{$data->buy4me_fee}} </dd>

                                        <dt class="col-sm-3">Payment Processing</dt>
                                        <dd class="col-sm-9" id="changed_payment_fee_tr">{{$data->payment}} </dd>
                                    </dl>
                                    <div class="details-price">
                                        <span>Total Payout </span>:-<span id="changed_totalPrice_tr">
                                        {{$data->estimated_total}}   </span>
                                        <input type="hidden" id="pro_total_price_changed" value="{{$data->estimated_total}}">
                                        <input type="hidden" id="pro_traveller_price_changed" value="{{$data->traveller_reward}}">
                                        <input type="hidden" id="pro_p_price_changed" value="{{$data->estimated_total}}">
                                        <input type="hidden" id="or_id" value="{{$data->id}}">
                                    </div>
                                    <h5>Delivery Details</h5>
                                    <hr>
                                    <!-- <button >Add trip</button> -->
                                    <p><input type="checkbox"> By making a Delivery offer or starting a delivery, I agree to Buy4Me's Terms and Conditions and acknowledge that I am familiar with and agree to abide by the customs rules and regulations of my destination country. I also acknowledge that I am responsible for paying customs duties and covering any extra charges that the customs at my destination country may impose.</p>
                                    <div class="d-flex gap-3 mt-3">
                                        <!-- <button type="submit">Request</button>
                                        <button><a href="{{route('stripeIdentity.index')}}">Confirm </a></button> -->
                                        <div class="menu-custbtn-area text-center mt-1" >
                <button  type="submit" class="menu-custbtn" style="border:none;width: 111px;">Request</button>
                <a  href="{{route('stripeIdentity.index')}}" class="menu-custbtn" style="border:none;width: 111px; padding: 3px 15px 3px 15px;">Confirm</a>
                    
            </div>
                                    </div>
                                   

                                  


                                </form>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- menu area end -->
@include('frontend.includes.footer')
<!-- all js here -->
@include('frontend.includes.footer_script')
</body>
</html>
