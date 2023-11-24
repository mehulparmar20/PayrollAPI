

@include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
      <div class="pl-10">
        <!-- pl-100 pr-100 -->
<div class="container-fluid"> 
<!-- <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                 <a class="menu-btnX btn-hover" href="#">Orders</a>
              </div> -->
             
  @include('frontend.user.order_header')
<div class="best-product-style">
<div class="tab-content">
<div class="tab-pane active show fade" id="order_requested" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
        @foreach($data as $row)
        @if($row->order_status==1 && $row->during_time > date('Y-m-d'))
        <?php
        $img = $row->product_imgs;
        $img = explode(' , ', $img);
        foreach ($img as $i) {
            $i = $i;
        }
        $i = str_replace([']', '['], " ", $i);
        $i = trim($i);
        ?>
        
        <div class="col-md-3 mb-3">
            <div class="card">
                <!-- <div class="product-img-2">
                        
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                        
                       </div> -->
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>
                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                @if (strlen($row->product_name) > 15)
                {{ substr($row->product_name, 0, 15) . '...' }}
                @else
                {{$row->product_name}}
                @endif
               </span>
               </p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">{{$row->traveller_reward}}</span></span></a></h4>
                    </div>
                    <div>
                    <a href="{{ route('user.order_details', ['id' => $row->id]) }}">
                    <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z"/>
                    <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z"/>
                    </svg>
                    <span class="detailsX1">Show Details</span>
                   </span>
                    </a>
                </div>

                    @if($row->trip_id != null || $row->trip_id !="")
                    <!-- <button class="btn btn-primary"><a
                            href="{{route('user.check_trOffer',['id'=>$row->id])}}"
                            style="color: white; text-decoration: none;">Check Offer To Travel</a></button> -->
                            <div class="menu-btnX-area text-center mt-10">
                        <a class="menu-btnX" href="{{route('user.check_trOffer',['id'=>$row->id])}}">Check Offer To Travel</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endforeach
      </div>
 </div>
</div>



            <!-- <div class="tab-pane fade" id="order_inTransit" role="tabpanel">
                        <div class="custom-row">
                            <div class="custom-col-5 custom-col-style mb-95">
                                @foreach($data as $row)
                                    @if($row->order_status==2 && $row->during_time > date('Y-m-d'))
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
                                            <div class="product-img-2x">
                                                
                                                <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="">
                                                </a>
                                                
                                            </div>
                                            <div class="product-action-2">
                                                <a class="animate-left add-style-2" title="Add To Cart" href="#">Show Details
                                              
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a href="#">{{$row->product_name}}</a></h4>
                                                <span>{{$row->fromCountry}},{{$row->fromCity}} :- {{$row->toCountry}},{{$row->toCIty}}  , by &nbsp; &nbsp;   {{ date("M d , Y", strtotime($row->during_time))}}</span>
                                                @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >${{$row->product_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                @endforeach
                            </div>
                        </div>
            </div> -->



<div class="tab-pane fade" id="matchTrip_requested" role="tabpanel">
  <div class="container-fluid">
        <div class="row">
       
        
        @foreach($counterOffer as $row)
         <?php
        $img = $row['OrderDetails']['product_imgs'];
        $img = explode(' , ', $img);
        foreach ($img as $i) {
            $i = $i;
        }
        $i = str_replace([']', '['], " ", $i);
        $i = trim($i);
        
        ?>
       
        
        <div class="col-md-3 mb-3">
            <div class="card">
                <!-- <div class="product-img-2">
                        
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                        
                       </div> -->
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row['OrderDetails']['id']])}}">
                        <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>
                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row['OrderDetails']['product_name']}}">
                @if (strlen($row->product_name) > 15)
                {{ substr($row->product_name, 0, 15) . '...' }}
                @else
                {{$row['OrderDetails']['product_name']}}
                @endif
               </span>
               </p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row['OrderDetails']['fromCountry']}}</span>,{{$row['OrderDetails']['fromCity']}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row['OrderDetails']['toCountry']}}</p>
                        <p class="card-text cardP"><span>{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                       
                       <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Price: <span class="details-price1">${{$row->product_price}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>new Reward: <span class="details-price1">${{$row->travel_reward}}</span></span></a></h4>
                    </div>
                       
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row['OrderDetails']['product_price']}}</span></span>,</a></h4>
                     <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">${{$row['OrderDetails']['traveller_reward']}}</span></span></a></h4>
                    </div>
                    
                    
                    <div>
                    <a href="{{ route('user.order_details', ['id' => $row->id]) }}">
                    <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z"/>
                    <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z"/>
                    </svg>
                    <span class="detailsX1">Show Details</span>
                   </span>
                    </a>
                </div>
                

                    @if($row->trip_id != null || $row->trip_id !="")
                    <!-- <button class="btn btn-primary"><a
                            href="{{route('user.check_trOffer',['id'=>$row->id])}}"
                            style="color: white; text-decoration: none;">Check Offer To Travel</a></button> -->
                            <div class="menu-btnX-area text-center mt-10">
                                <a class="menu-btnXZ"  href="{{route('shopper.create_offer',['id'=>$row['OrderDetails']['id'],'matched_id'=>$row->id,'from'=>$from,'status'=>'requested'])}}"  style="min-width: 111px !important; color:white!important; margin-right: 10px;">View Counter</a>
               
                        <!--<a class="menu-btnX" href="{{route('user.edit_order',['id'=>$row['OrderDetails']['id']])}}">View Counter</a>-->
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        @endforeach
      </div>
  </div>
</div>







<div class="tab-pane fade" id="order_inTransit" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
                                    @if($row->order_status==2 && $row->during_time > date('Y-m-d'))
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
                        
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                       </div> -->
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>
                       <!-- <div class="product-action-2">
                                                <a class="animate-left add-style-2" title="Add To Cart" href="#">Show Details
                                              
                                            </div> -->

                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                @if (strlen($row->product_name) > 15)
                {{ substr($row->product_name, 0, 15) . '...' }}
                @else
                {{$row->product_name}}
                @endif
               </span>
               </p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span></a></h4>
                     
                    </div>
                    <div>
                    <a href="{{ route('user.order_details', ['id' => $row->id]) }}">
                    <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z"/>
                    <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z"/>
                    </svg>
                    <span class="detailsX1">Show Details</span>
                   </span>
                    </a>
                </div>

                    <!-- @if($row->trip_id != null || $row->trip_id !="")
                    <button class="btn btn-primary"><a
                            href="{{route('user.check_trOffer',['id'=>$row->id])}}"
                            style="color: white; text-decoration: none;">Check Offer To Travel</a></button>
                    @endif -->
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div>
























                    <!-- <div class="tab-pane fade" id="order_received" role="tabpanel">
                        <div class="custom-row">
                            <div class="custom-col-5 custom-col-style mb-95">
                                @foreach($data as $row)
                                    @if($row->order_status==3 && $row->during_time > date('Y-m-d'))
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
                                            <div class="product-img-2x">
                                                
                                                <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="">
                                                </a>
                                                
                                            </div>
                                            <div class="product-action-2">
                                                <a class="animate-left add-style-2" title="Add To Cart" href="#">Show Details
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a href="#">{{$row->product_name}}</a></h4>
                                                <span>{{$row->fromCountry}},{{$row->fromCity}} :- {{$row->toCountry}},{{$row->toCIty}}  , by &nbsp; &nbsp;   {{ date("M d , Y", strtotime($row->during_time))}}</span>
                                                @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                                                
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >${{$row->product_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> -->











 <div class="tab-pane fade" id="order_received" role="tabpanel">
    <div class="container-fluid">
      <div class="row">
      @foreach($data as $row)
                                    @if($row->order_status==3 && $row->during_time > date('Y-m-d'))
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
                        
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                       </div> -->
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>
                       
                       <div class="product-action-2">
                                                <a class="animate-left add-style-2" title="Add To Cart" href="#">Show Details
                                              
                                            </div>
                                            <!-- <div class="product-action-2">
                                                <a class="animate-left add-style-2" title="Add To Cart" href="#">Show Details
                                            </div> -->

                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                @if (strlen($row->product_name) > 15)
                {{ substr($row->product_name, 0, 15) . '...' }}
                @else
                {{$row->product_name}}
                @endif
               </span>
               </p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span></a></h4>
                     
                    </div>
                    <div>
                    <a href="{{ route('user.order_details', ['id' => $row->id]) }}">
                    <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z"/>
                    <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z"/>
                    </svg>
                    <span class="detailsX1">Show Details</span>
                   </span>
                    </a>
                </div>

                    <!-- @if($row->trip_id != null || $row->trip_id !="")
                    <button class="btn btn-primary"><a
                            href="{{route('user.check_trOffer',['id'=>$row->id])}}"
                            style="color: white; text-decoration: none;">Check Offer To Travel</a></button>
                    @endif -->
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
      </div>
  </div>
</div>










                



 <div class="tab-pane fade" id="order_inactive" role="tabpanel">
    <div class="container-fluid">
        <div class="row">
        @foreach($data as $row)
                                <?php
                                    if($row->order_status==4 || $row->during_time < date('Y-m-d'))
                                    {
                                      
                                            $img=$row->product_imgs;
                                            $img=explode(' , ', $img);
                                            foreach($img as $i)
                                            {
                                                $i=$i;
                                            }
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <!-- <div class="product-img-2">
                    <a href="{{route('user.order_details',['id'=>$row->id])}}">
                            <img src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                    </div> -->
                    <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- <h4 class="card-title"><a href="#"><span class="productN">{{$row->product_name}}</span></a></h4> -->
                        <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                @if (strlen($row->product_name) > 15)
                {{ substr($row->product_name, 0, 15) . '...' }}
                @else
                {{$row->product_name}}
                @endif
               </span>
               </p>
                        <!-- <p class="card-text cardP"><span class="countryX">{{$row->fromCountry}}</span>,{{$row->fromCity}} :-</p>
                        <p class="card-text cardP"><span>{{$row->toCountry}},{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}
                        by {{ date("M d, Y", strtotime($row->during_time))}}</p> -->
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCIty}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                    <h4 class="card-text productN"><a href="#"><span>Without Box</span></a></h4>
                    @else
                    <h4 class="card-text productN"><a href="#"><span>With Box</span></a></h4>
                    @endif
                    <div class="details-price">
                        <h4 class="card-text productN"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span></a></h4>
                    </div>
            <div class="menu-btnXz-area text-center mt-10" style="margin: 0px 20px;">
    <a class="menu-btnXa" href="{{route('user.order_cancle',['id'=>$row->id,'status'=>'publish'])}}" onclick="return confirm('Are you sure you want to republish this ?');" style="min-width: 111px !important; margin-right: 10px;">Re-publish</a>
    <a class="menu-btnXa" href="{{route('user.order_cancle',['id'=>$row->id,'status'=>'delete'])}}" onclick="return confirm('Are you sure you want to permanently delete this ?');" style="min-width: 111px !important;">Delete Order</a>
</div>

                                        
                    </div>
                </div>
            </div>
            <?php } ?>
            @endforeach
        </div>
    </div>
</div>

                    





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

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const tabLinks = document.querySelectorAll(".tab-link");

    tabLinks.forEach((tabLink) => {
        tabLink.addEventListener("click", function (event) {
            event.preventDefault();

            // Remove the 'active' class from all tab links
            tabLinks.forEach((link) => {
                link.classList.remove("active");
            });

            // Add the 'active' class to the clicked tab link
            this.classList.add("active");
        });
    });
});


    </script>

</html>


