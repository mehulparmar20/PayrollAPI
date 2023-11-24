  
@extends('layouts.app')
@section('pages')

    
    <!-- header end -->
    
    <div class="best-product-area pb-15">
        <div class="pl-10">
            <!-- pl-100 pr-100 -->
        
            <!-- Dipali code start here -->
            <div class="container-fluid">

            <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
    <!-- <a class="titletag" href="#">Matched Trips</a> -->

    <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                        <a class="menu-custbtn" href="#">Matched Trips</a>
                    </div>
</div>
<?php
    $matchedorder = 0;
    $requested =0;
    $countrequested = 0;
    if(count($data) != 0)
    {
       
        foreach ($data as $key => $row) {
            //   dd($row['status']);
        //    if($row['MatchedTrip'] == null)
           if($row != null)
           {
                $matchedorder += 1;
           }
           if($row['MatchedTrip'] != null)
           {
                if($row['status'] == 1)
                {
                    $requested += 1;
                }
                if($row['status'] == 2)
                {
                    $countrequested += 1;
                }
            }
           
        }
        // if(count)
    }
?>


                <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
                    <div class="StatusXX"><a class="active menuHeader tab-link" href="#matchTrip_order" data-bs-toggle="tab" role="tab"> Matched order({{$matchedorder}})</a></div>

                    <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_IncomingRe" data-bs-toggle="tab" role="tab">Requested({{$requested}}) </a></div>

                    <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_requested" data-bs-toggle="tab" role="tab"> Counter Requested({{$countrequested}})  </a></div>
                        
                    <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_accepted" data-bs-toggle="tab" role="tab">Accepted </a></div>

                    <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_inTrain" data-bs-toggle="tab" role="tab"> In Transit </a></div>
                    
                    <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_delivered" data-bs-toggle="tab" role="tab"> Delivered</a></div>
                    
                    <!-- <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                        <a class="menu-btnX btn-hover" href="#">Matched Orders</a>
                    </div> -->
                </div>
                <div class="best-product-style">
                    <div class="tab-content">
                     
<div class="tab-pane active show fade" id="matchTrip_order" role="tabpanel">
    <div class="container-fluid">
    <div class="row">
        <!-- matched order -->

       @foreach($data as $row)
                @if($row != Null)                   
        <div class="col-md-3 mb-3">
            <div class="card">
                                   <!-- <div class="product-img-2">
                                                @if($row->profile==null)
                                                <a href="#">
                                                    <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" class="img-fluid" alt="">
                                                </a>
                                                @else
                                                <a href="#">
                                                    <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" class="img-fluid" alt="">
                                                </a>
                                                @endif 
                                            </div> -->
                                            
                    <div class="testimonial-image text-center">
                    @if($row->profile==null)
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                        @else
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    @endif 
                    </div>
                <div class="card-body">
                <p class="card-text cardP"><span class="countryX">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span>,{{$row->fromCity}}</p>
                     <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['Tripdestination']['destination_country']}},</p>
                        <p class="card-text cardP"><span>{{$row['Tripdestination']['destination_city']}},by {{ date("M d, Y", strtotime($row->travel_date))}}</p>
                     
                        <div class="details-price">
                     
                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$orderdata->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward:<span class="details-price1">{{$orderdata['traveller_reward']}}</span></span></a></h4>
                    </div>
                    <div class="menu-btnXXZ-area text-center mt-10">
    <a class="menu-btnXXZ" href="{{ route('shopper.send_tripRequest', ['trip' => $row->id, 'order' => $orderdata->id, 'status' => 'requested']) }}">Send request</a>
</div>


                        
                       
                    <div>
                </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
      </div>
 </div>
</div>


<div class="tab-pane fade" id="matchTrip_IncomingRe" role="tabpanel">
    <div class="container-fluid">
   <!--asaasasasas-->
   <div class="row">
     
   @foreach($data as $row)
      @if($row['MatchedTrip'] != NUll &&  $row->status == 1)
                                   
        
        <div class="col-md-3 mb-3">
            <div class="card">
                    <div class="testimonial-image text-center">
                    @if($row->profile==null)
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                        @else
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    @endif 
                    </div>
                <div class="card-body">
               <p class="card-text cardP"><span class="countryX">{{$row->first_name}}</span> <span class="countryX">{{$row->first_name}}</span></p>
       
              <!-- Trip id {{$row['id']}} --> 
              <!-- Order Id:{{$orderdata['id']}} -->
                    <p class="card-text cardP"><span class="countryX">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span>,{{$row->fromCity}}</p>
                    <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                         <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['Tripdestination']['destination_country']}},</p>
                        <p class="card-text cardP"><span>{{$row['Tripdestination']['destination_city']}},by {{ date("M d, Y", strtotime($row->travel_date))}}</p>                
                         <div class="details-price">                       
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row['user']['email']}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row['user']['mobile']}}</p>
                         
                         </div>
                         @if($orderdata['id'] != null || $orderdata['id'] !="")
                         <div class="menu-btnXXZ-area text-center mt-10">
                        
                                    
                         <a class="menu-btnXZ"
                            href="{{ route('shopper.travellerCreateOffershopper', ['matched_id' => $orderdata['id']]) }}"
                            style="min-width: 111px !important; color:white!important; margin-right: 10px;">View
                            Counter</a>    
                            <!-- <a class="menu-btnXZ"  href=" {{ route('shopper.send_tripRequest', ['trip' => $row->id, 'order' => $orderdata->id, 'status' => 'requested']) }}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a> -->
                      
                           
                       <!-- <a class="menu-btnXZ"  href="{{--route('shopper.send_tripRequest',['id'=>$row->ma_id,'status'=>'accept_orderRe','from'=>$from])--}}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a> -->
                       </div>
                       @endif
                  
                    <div>
                </div>
                </div>
            </div>
        </div>
        @else
                                    @endif
                                @endforeach
      </div>
     </div>
  </div>
</div>

<div class="tab-pane fade" id="matchTrip_requested" role="tabpanel">
    <div class="container-fluid">
   <!--asaasasasas-->
      <div class="row">
      
        @foreach($data as $row)
                
            @if($row['matchedOrder'] != null && $row->status == 2)
          
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="testimonial-image text-center">
                        <a href="#">
                        <img src="{{ url('/public/product_img').'/'.$row['product']['image'] }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>

                    <div class="card-body">
                            <p>
                                <span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row['product']['product_name']}}">
                                    @if (strlen($row['product']['product_name']) > 15)
                                    {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                                    @else
                                    {{$row['product']['product_name']}}
                                    @endif
                                </span> 
                            </p>
                            
                            <p class="card-text cardP"><span class="countryX">{{$row->first_name}} </span> <span class="countryX">{{$row['user']['last_name']}}</span></p>
                            <p class="card-text cardP"><span class="countryX">From:-{{$row['origincountry']}}</span>,{{$row->fromCity}}</p>
                            <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['destination']['destination_country']}}</p>
                            <p class="card-text cardP"><span>{{$row['destination']['destination_city']}},by {{ date("M d, Y", strtotime($row->deliverd_date))}}</p>
                                
                                    @if($row->box==0)
                                                            <p> Without Box</p>
                                                        @else
                                                            <p> With Box</p>
                                                        @endif
                                <div class="details-price">
                            <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">{{$row->product_price}}</span></span></a></h4>
                            
                            <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">{{$row->traveller_reward}}</span></span></a></h4>
                    </div>

                    <div>
                        <div class="menu-btnXZ-area text-center mt-1" >
                            <a class="menu-btnXZ"  href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'accept_orderRe','from'=>$from]) --}}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a>
                            <a class="menu-btnXZ"  href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'cancle_orderRe','from'=>$from])--}}" onclick="return confirm('are you sure cancle this offer');"  style="min-width: 91px !important;  margin-right: 10px;">Cancel Request</a>
                            <!-- <a class="menu-btnXZ"  href="{{-- route('traveller.create_offer',['id'=>$row->id,'matched_id'=>$row['matchedOrder']['id'],'from'=>$from,'status'=>'requested']) --}}"  style="min-width: 111px !important;  margin-right: 10px;">Send Counter test</a> -->
                            <!-- <a class="menu-btnXZ" href="{{ route('traveller.create_offer', ['order' => $row,'trip_id'=> $row['matchedOrder']['trip_id'] ,'matchedorder' => $row['matchedOrder']['id'], 'from' => $from, 'status' => 'counter-request']) }}" style="min-width: 111px !important; margin-right: 10px;">Send Counter Offer</a> -->
                            <a class="menu-btnXZ" href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row['matchedOrder']['id']])}}" style="min-width: 111px !important; margin-right: 10px;">Send Counter Offer</a>

                            <!-- <a class="menu-btnXZ" href="{{-- route('stripeIdentity.index') --}}"  style="min-width: 91px !important; margin-right: 10px;">Confirm</a> -->
                        </div>
                    </div>

                </div>
                </div>
                </div>
            @else
            @endif
        @endforeach
      </div>
  </div>
</div>

<!-- <div class="tab-pane fade" id="matchTrip_requested" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
          
      @foreach($data as $row)
                                    @if($row->trip_status==1)
                                        <?php
                                            $img=$row->product_imgs;
                                            $img=explode(' , ', $img);
                                            foreach($img as $i)
                                            {
                                                $i=$i;
                                            }
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
        
        <div class="col-md-3 mb-3">
            <div class="card">
               
                
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m2/public/product_img/{{$row->image}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>

                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                @if (strlen($row['product']['product_name']) > 15)
                {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                @else
                $row['product']['product_name']
                @endif
               </span>
               </p>
                         <p class="card-text cardP"><span class="countryX">testing:-{{$row->user_id}}</span></p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCity}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                        <div class="details-price">
                    
                    
                    </div>
                       
                        <div class="details-price">
                        
                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->ma_product_price}}</span></span></a></h4>
                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Reward: <span class="details-price1">${{$row->ma_travel_reward}}</span></span></a></h4>
                        
                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span></a></h4>
                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->travel_reward}}</span></span></a></h4>
                       <a class="menu-btnXZ"  href="{{-- route('traveller.create_offer',['id'=>$row->id,'matched_id'=>$row->ma_id,'from'=>$from,'status'=>'requested']) --}}"  style="min-width: 111px !important; color:white!important; margin-right: 10px;">Send Counter Offer</a>
                       <a class="menu-btnXP btn-hover" href="{{route('stripeIdentity.index')}}"  style="min-width: 91px !important; color:white!important; margin-right: 10px;">Confirm</a>
              
                    </div>
                    <div>
                    
                </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div> -->


 <div class="tab-pane fade" id="matchTrip_accepted" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
     
      @if($row['MatchedTrip'] != NUll &&  $row['MatchedTrip']['status'] == 3)     
   
                                        <?php
                                            $img=$row->image;
                                            $img=explode(' , ', $img);
                                            foreach($img as $i)
                                            {
                                                $i=$i;
                                            }
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
        
        <div class="col-md-3 mb-3">
            <div class="card">
                
                    @if($row->profile==null)
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                        @else
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    @endif 
                    <!-- <div class="product-img-2">
                       <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                    </div>
                    <div class="testimonial-image text-center">
                       <img src="{{URL::to('/')}}/public/product_img/{{$product->image}}  " alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                    </div> -->

                <div class="card-body">
               
               </span>
               </p>
               <p class="card-text cardP"><span class="countryX">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span></p>
               <p class="card-text cardP"><span class="countryX">Product Name:{{$product->product_name}} </span></p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['tripdestination']['destination_country']}}{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row['tripdestination']['destination_city']}}, by {{ date("M d, Y", strtotime($row->travel_date))}}</p>
                                  @if($product->box==0)
                                    <p> Without Box</p>
                                        @else
                                         <p> With Box</p>
                                    @endif
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$product->price}}</span></span></a></h4>
                     </div>
                    <div>
                    <!-- <a class="menu-btnXZ"  href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'pick_up']) --}}"  style="min-width: 111px !important;  margin-right: 10px;">Pic Up The Order</a> -->
                    
                </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div> 

 <div class="tab-pane fade" id="matchTrip_inTrain" role="tabpanel">
    <div class="container-fluid">
         <!-- $row->trip_status==3)-->
      <div class="row">
      @foreach($data as $row)
      @if($row['MatchedTrip'] != NUll &&  $row['MatchedTrip']['status'] == 6)    
                                   
                                        <?php
                                            $img=$row->product_imgs;
                                            $img=explode(' , ', $img);
                                            foreach($img as $i)
                                            {
                                                $i=$i;
                                            }
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
        
        <div class="col-md-3 mb-3">
            <div class="card">
            @if($row->profile==null)
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                        @else
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    @endif 
                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$product->product_name}}">
                @if (strlen($product->product_name) > 15)
                {{ substr($product->product_name, 0, 15) . '...' }}
                @else
                {{$product->product_name}}
                @endif
               </span>
               </p>
               <p class="card-text cardP"><span class="countryX">Product Name:{{$product->product_name}} </span></p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['tripdestination']['destination_country']}}{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row['tripdestination']['destination_city']}}, by {{ date("M d, Y", strtotime($row->travel_date))}}</p>
                                  @if($product->box==0)
                                    <p> Without Box</p>
                                        @else
                                         <p> With Box</p>
                                    @endif
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$product->price}}</span></span></a></h4>
                     </div>
                    <div>
                    <!-- <a class="menu-btnXZ"  href="{{-- route('user.send_tripRequest',['id'=>$row->ma_id,'status'=>'delivered']) --}}"  onclick="return confirm('Confirm Payment');"  style="min-width: 111px !important; text-align: center;  margin-right: 10px;">Delivered</a> -->
                </div>
                </div>
                                       
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div>

<div class="tab-pane fade" id="matchTrip_delivered" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
      @if($row['MatchedTrip'] != NUll &&  $row['MatchedTrip']['status'] == 5)   
                                  
                                        <?php
                                            $img=$row->product_imgs;
                                            $img=explode(' , ', $img);
                                            foreach($img as $i)
                                            {
                                                $i=$i;
                                            }
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="product-img-2">
                        
                @if($row->profile==null)
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/169086800992.3135715.png" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                        @else
                        <a href="#">
                        <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    @endif 
                        <!-- <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                       </div>
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m2/public/product_img/{{$row->image}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a> -->
                    </div>

                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$product->product_name}}">
                @if (strlen($product->product_name) > 15)
                {{ substr($product->product_name, 0, 15) . '...' }}
                @else
                {{$product->product_name}}
                @endif
               </span>
               <p class="card-text cardP"><span class="countryX">Product Name:{{$product->product_name}} </span></p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['tripdestination']['destination_country']}}{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row['tripdestination']['destination_city']}}, by {{ date("M d, Y", strtotime($row->travel_date))}}</p>
                                  @if($product->box==0)
                                    <p> Without Box</p>
                                        @else
                                         <p> With Box</p>
                                    @endif
                        <div class="details-price">
                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$product->price}}</span></span></a></h4>
                      </div>
                    <div>
                    
                </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div>

                    </div>
                </div>


                <!-- Dipali code end here -->


                </div>
            </div>
        </div>
    </div>
  </div>

   @endsection