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
            //  dd($row['status']);
           if($row['MatchedTrip'] != null)
           {
                $matchedorder += 1;
           }
           else{
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

            <div class="section-title-3 custmizeMargin text-center mb-15">
    
                <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">

                <div class="StatusXX"><a class="active menuHeader tab-link" href="#matchTrip_order" data-bs-toggle="tab" role="tab"> Matched order({{$matchedorder}})</a></div>
                <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_IncomingRe" data-bs-toggle="tab" role="tab">Requested({{$requested}}) </a></div>
                <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_requested" data-bs-toggle="tab" role="tab"> Counter Requested({{$countrequested}})  </a></div>
                <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_accepted" data-bs-toggle="tab" role="tab">Accepted </a></div>
                <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_inTrain" data-bs-toggle="tab" role="tab"> In Transit </a></div>
                <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_delivered" data-bs-toggle="tab" role="tab"> Delivered</a></div>
            </div>
               
              </div>
              <div class="best-product-style">
                <div class="tab-content">
             
<div class="tab-pane active show fade" id="matchTrip_order" role="tabpanel">
  <div class="container-fluid">
      <div class="row">
        <!-- matched order -->
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
               <p class="card-text cardP"><span class="countryX">{{$row['User']['first_name']}}</span> <span class="countryX">{{$row['User']['first_name']}}</span></p>
              <!-- user Id:{{$row['User']['id']}}
              
              Trip id {{$row['id']}} -->
              <!-- Order Id:{{$orderdata['id']}} -->
                         <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['Tripdestination']['destination_country']}},</p>
                        <p class="card-text cardP"><span>{{$row['Tripdestination']['destination_city']}},by {{ date("M d, Y", strtotime($row->travel_date))}}</p>                
                         <div class="details-price">                       
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row['User']['email']}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row['User']['mobile']}}</p>
                         
                         </div>
                         @if($orderdata['id'] != null || $orderdata['id'] !="")
                         <div class="menu-btnXXZ-area text-center mt-10">
                        
                                    
                         <a class="menu-btnXZ"
                            href="{{ route('shopper.travellerCreateOffershopper', ['matched_id' => $orderdata['id']]) }}"
                            style="min-width: 111px !important; color:white!important; margin-right: 10px;">View
                            Counter</a>    
                            <a class="menu-btnXZ"  href="{{route('stripe.shopper',['productname'=>'trip','total'=>$orderdata->product_price])}}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a>
                                   
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
       @foreach($data as $row)
         
                                    @if($row['MatchedTrip'] == Null)
        
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
                    
                   
          
                
                         <p class="card-text cardP"><span class="countryX">{{$row['user']['first_name']}} </span> <span class="countryX">{{$row['user']['last_name']}}</span></p>
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
               <p class="card-text cardP"><span class="countryX">{{$row['User']['first_name']}}</span> <span class="countryX">{{$row['User']['first_name']}}</span></p>
              <!-- user Id:{{$row['User']['id']}}
              
              Trip id {{$row['id']}} -->
              <!-- Order Id:{{$orderdata['id']}} -->
                         <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['Tripdestination']['destination_country']}},</p>
                        <p class="card-text cardP"><span>{{$row['Tripdestination']['destination_city']}},by {{ date("M d, Y", strtotime($row->travel_date))}}</p>                
                         <div class="details-price">                       
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row['User']['email']}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row['User']['mobile']}}</p>
                         
                         </div>
                         @if($orderdata['id'] != null || $orderdata['id'] !="")
                         <div class="menu-btnXXZ-area text-center mt-10">
                        
                                    
                         <a class="menu-btnXZ"
                            href="{{ route('shopper.travellerCreateOffershopper', ['matched_id' => $orderdata['id']]) }}"
                            style="min-width: 111px !important; color:white!important; margin-right: 10px;">View
                            Counter</a>                 
                       <!-- <a class="menu-btnXZ"  href="{{--route('shopper.send_tripRequest',['id'=>$row->ma_id,'status'=>'accept_orderRe','from'=>$from])--}}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a> -->
                       <a class="menu-btnXZ"  href="{{route('stripe.shopper',['productname'=>'trip','total'=>$orderdata->product_price])}}"  style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a>
                      
                          
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



<div class="tab-pane fade" id="matchTrip_requested" role="tabpanel">
  <div class="container-fluid">
      <div class="row">
      
      @foreach($data as $row)
      @if($row['MatchedTrip'] != NUll && $row['MatchedTrip']['status'] == 1)
                                   
        
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
                  
               <p class="card-text cardP"><span class="countryX">{{$row['User']['first_name']}}</span> <span class="countryX">{{$row['User']['first_name']}}</span></p>
              user Id:{{$row['User']['id']}}
              Order Id:{{$orderdata['id']}}
              Trip id {{$row['id']}}
                         <p class="card-text cardP"><span class="countryX">From:-{{$row->origincountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['Tripdestination']['destination_country']}},</p>
                        <p class="card-text cardP"><span>{{$row['Tripdestination']['destination_city']}},by {{ date("M d, Y", strtotime($row->travel_date))}}</p>
                         
                         <div class="details-price">
                         
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row['User']['email']}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row['User']['mobile']}}</p>
                         
                         </div>
                         <!-- <div class="menu-btnXXZ-area text-center mt-10">
                        <a class="menu-btnXXZ" href="{{-- route('user.send_tripRequest',['id'=>$row->ma_id,'status'=>'accept_orderRe']) --}}">Accept Offer</a>
                    </div> -->
                     

                        
                       
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


                    <!-- <div class="tab-pane fade" id="matchTrip_accepted" role="tabpanel">
                        <div class="custom-row">
                            <div class="custom-col-5 custom-col-style mb-95">
                                @foreach($data as $row)
                                    @if($row->orStatus==2)
                                       
                                        <div class="product-wrapper">
                                            <div class="product-img-2">
                                                <a href="#">
                                                    <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a href="#">{{$row->first_name}}</a></h4><h4><a href="#">{{$row->last_name}}</a></h4>
                                                <span>{{$row->fromCountry}} ,{{$row->fromcity}}:- {{$row->toCountry}},{{$row->toCity}} , by  &nbsp; &nbsp; {{ date("M d , Y", strtotime($row->during_time))}}</span>
                                                <div class="product-rating">
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star"></i>
                                                    <i class="ti-star"></i>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Email</span> :-<span >{{$row->email}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Mobile</span> :-<span >{{$row->mobile}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Reward</span> :-<span >{{$row->travel_reward}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >{{$row->product_price}}</span>
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
                                    @if($row->orStatus==2)
        
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
            
                @if($row->first_name && $row->last_name==null)
                <p class="card-text cardP"><span class="countryX">{{$row->first_name}}</span> <span class="countryX">{{$row->last_name}}</span></p>
                @else
                <p class="card-text cardP"><span class="countryX">Kalpesh</span> <span class="countryX">Jadhvaryu</span></p>
                @endif

                         <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}},</p>
                        <p class="card-text cardP"><span>{{$row->toCity}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                         
                         <div class="details-price">

                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward:<span class="details-price1">{{$row['traveller_reward']}}</span></span></a></h4>
                         
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row->email}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row->mobile}}</p>
                         
                         
                         
                         
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


                    <!-- <div class="tab-pane fade" id="matchTrip_inTrain" role="tabpanel">
                        <div class="custom-row">
                            <div class="custom-col-5 custom-col-style mb-95">
                            @foreach($data as $row)
                                    @if($row->orStatus==3)
                                       
                                        <div class="product-wrapper">
                                            <div class="product-img-2">
                                                <a href="#">
                                                    <img src="{{URL::to('/')}}/public/upload/profile_img/{{$row->profile}}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a href="#">{{$row->first_name}}</a></h4><h4><a href="#">{{$row->last_name}}</a></h4>
                                                <span>{{$row->fromCountry}} ,{{$row->fromcity}}:- {{$row->toCountry}},{{$row->toCity}} , by  &nbsp; &nbsp; {{ date("M d , Y", strtotime($row->during_time))}}</span>
                                                <div class="product-rating">
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star"></i>
                                                    <i class="ti-star"></i>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Email</span> :-<span >${{$row->email}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Mobile</span> :-<span >{{$row->mobile}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Reward</span> :-<span >${{$row->travel_reward}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >{{$row->product_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else

                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> -->


<div class="tab-pane fade" id="matchTrip_inTrain" role="tabpanel">
  <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
                                    @if($row->orStatus==3)
                                    
        
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
                <!-- <h4><a href="#">{{$row->first_name}} {{$row->last_name}}</a></h4> -->
                <p class="card-text cardP"><span class="countryX">{{$row->first_name}}</span> <span class="countryX">{{$row->last_name}}</span></p>

                <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCity}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                         <div class="details-price">
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row->email}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row->mobile}}</p>
                         
                         <!-- <p class="card-text cardP"><span class="countryX">Traveller Reward:-${{$row->travel_reward}}</p>
                         
                         <p class="card-text cardP"><span class="countryX">Product Price:-{{$row->product_price}}</p> -->

                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward:<span class="details-price1">{{$row['traveller_reward']}}</span></span></a></h4>   
                   
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


                    <!-- <div class="tab-pane fade" id="matchTrip_delivered" role="tabpanel">
                        <div class="custom-row">
                            <div class="custom-col-5 custom-col-style mb-95">
                                @foreach($data as $row)
                                    @if($row->orStatus==4)
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
                                        <div class="product-wrapper">
                                            <div class="product-img-2">
                                                <a href="#">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a href="#">{{$row->product_name}}</a></h4>
                                                <span>{{$row->fromCountry}} ,{{$row->fromcity}}:- {{$row->toCountry}},{{$row->toCity}} , by &nbsp; &nbsp;  {{ date("M d , Y", strtotime($row->during_time))}}</span>
                                                @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                                                <div class="product-rating">
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star"></i>
                                                    <i class="ti-star"></i>
                                                </div>
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >${{$row->product_price}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Treveler Reward</span> :-<span >${{$row->travel_reward}}</span>
                                                </div>
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >{{$row->product_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                     
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> -->








<div class="tab-pane fade" id="matchTrip_delivered" role="tabpanel">
  <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
                                    @if($row->orStatus==4)
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
                                   <!-- <div class="product-img-2">
                                                
                                             @if($row->profile==null)
                                                <a href="#">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
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
                    
                <!-- <h4><a href="#">{{$row->first_name}} {{$row->last_name}}</a></h4> -->
                <p class="card-text cardP"><span class="countryX">{{$row->first_name}}</span> <span class="countryX">{{$row->last_name}}</span></p>

                <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCity}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif


                         <div class="details-price">
                         <p class="card-text cardP"><span class="countryX">Traveller Email:-{{$row->email}}</p>
                         <p class="card-text cardP"><span class="countryX">Traveller Mobile:-{{$row->mobile}}</p>
                         
                         <!-- <p class="card-text cardP"><span class="countryX">Traveller Reward:-${{$row->travel_reward}}</p>
                         
                         <p class="card-text cardP"><span class="countryX">Product Price:-{{$row->product_price}}</p> -->

                         <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward:<span class="details-price1">{{$row->travel_reward}}</span></span></a></h4>   
                   
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
            </div>
        </div>
    </div>
  </div>
  @endsection