@extends('frontend.user.layouts.main')

@section('pages')
    <div class="best-product-area pb-15">
        <div class="pl-10">
            <!-- pl-100 pr-100 -->
            <div class="container-fluids"> 

                        
                @include('frontend.user.order_header')
            
                <div id="order-content">
                    <div id="all-orders-content" class="tab-content1">
                        <div class="row">
                            @if(count($data) != 0)
                                @foreach($data as $row)
                        
                                    <?php
                                        // dd($data);
                                        $img = $row->image;
                                        $img = explode(' , ', $img);
                                        foreach ($img as $i) {
                                            $i = $i;
                                        }
                                        $i = str_replace([']', '['], " ", $i);
                                        $i = trim($i);
                                    ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="testimonial-image text-center">
                                                <a href="{{route('shopper.order_details',$row->slug)}}">
                                                <img src="{{ url('/public/product_img').'/'.$row->image }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{-- $row->product_name--}}">
                                                        @if (strlen($row->product_name) > 15)
                                                        {{ substr($row->product_name, 0, 15) . '...' }}
                                                        @else
                                                        {{$row->product_name}}
                                                        @endif
                                                    </span>
                                                </p>
                                                <p class="card-text cardP"><span class="countryX">Traveller: {{$row->first_name}} {{$row->last_name}}</span></p>
                                                <p class="card-text cardP"><span class="countryX">Trip Date: {{$row->travel_date}}</span></p>
                                                <p class="card-text cardP"><span class="countryX">From: {{$row->origin_country}}</span></p>
                                                <p class="card-text cardP"><span><span class="countryX">To:-</span>{{ $row->destination_city}}</p>
                                                <p class="card-text cardP"><span>{{$row->destination_c}},by {{  date("M d, Y", strtotime($row->deliverd_date))}}</p>
                                                <div class="details-prices">
                                                <h4 class="card-text productN" style="display: inline; margin-right: 6px;">
                                                <a href="#"><span>quantity: <span class="details-price1">{{$row->quantity}}</span></span>,</a></h4>
                                            </div>

                                            <div class="details-price">
                                                <h4 class="card-text productN" style="display: inline; margin-right: 6px;">
                                                <a href="#"><span>Product Price: <span class="details-price1">{{($row->currency == 'USD') ? '$' : 'INR'}}{{$row->product_price}}</span></span></a></h4>
                                                <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">{{($row->currency == 'USD') ? '$' : 'INR'}} {{$row->traveller_reward}}</span></span></a></h4>
                                                <div>
                                                    <div class="details-price">
                                                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;">
                                                        <a href="#"><span>Counter Price: <span class="details-price1">{{($row->currency == 'USD') ? '$' : 'INR'}}{{$row->counter_product_price}}</span></span></a></h4>
                                                        <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">{{($row->currency == 'USD') ? '$' : 'INR'}} {{$row->counter_traveller_reward}}</span></span></a></h4>
                                                    </div>

                                                    <a href="">
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
                                                    <div class="menu-btnX-area text-center mt-10">
                                                        <a class="menu-btnXZ"  href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row->matched_id])}}"  style="min-width: 111px !important; color:white!important; margin-right: 10px;">View Counter</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                        
                                @endforeach
                    
                            @else
                                No Order Created yet!
                            @endif
                        </div>
                    </div>
                        <!--<div id="tab2-content" class="tab-content">-->
                            
                        <!--    order request-->
                        <!--</div>-->
                        <!-- <div id="order_requested-content" class="tab-content1">
                                <div class="container-fluid">
                                <div class="row">
                                    @if(count($data) != 0)
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
                                                    
                                                        <div class="testimonial-image text-center">
                                                            <a href="{{-- route('user.order_details',['id'=>$row['OrderDetails']['id']])--}}">
                                                            <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{-- $i--}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                                            </a>
                                                        </div>
                                                    <div class="card-body">
                                                    <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{-- $row['OrderDetails']['product_name']--}}">
                                                    @if (strlen($row->product_name) > 15)
                                                    {{--  substr($row->product_name, 0, 15) . '...' --}}
                                                    @else
                                                    {{-- $row['OrderDetails']['product_name']--}}
                                                    @endif
                                                </span>
                                                </p>
                                                            <p class="card-text cardP"><span class="countryX">From:-{{-- $row['OrderDetails']['fromCountry']--}}</span>,{{-- $row['OrderDetails']['fromCity']--}}</p>
                                                            <p class="card-text cardP"><span><span class="countryX">To:-</span>{{-- $row['OrderDetails']['toCountry']--}}</p>
                                                            <p class="card-text cardP"><span>{{-- $row->toCIty--}},by {{--  date("M d, Y", strtotime($row->during_time))--}}</p>
                                                        
                                                        <div class="details-price">
                                                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Price: <span class="details-price1">${{-- $row->product_price--}}</span></span>,</a></h4>
                                                        <h4 class="card-text productN" style="display: inline;"><a href="#"><span>new Reward: <span class="details-price1">${{-- $row->travel_reward--}}</span></span></a></h4>
                                                        </div>
                                                        
                                                            <div class="details-price">
                                                        <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{-- $row['OrderDetails']['product_price']--}}</span></span>,</a></h4>
                                                        <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">${{-- $row['OrderDetails']['traveller_reward']--}}</span></span></a></h4>
                                                        </div>
                                                        
                                                        
                                                        <div>
                                                        <a href="{{--  route('user.order_details', ['id' => $row->id]) --}}">
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
                                                        
                                                                <div class="menu-btnX-area text-center mt-10">
                                                                    <a class="menu-btnXZ"  href="{{-- route('shopper.create_offer',['id'=>$row['OrderDetails']['id'],'matched_id'=>$row->id,'from'=>$from,'status'=>'requested'])--}}"  style="min-width: 111px !important; color:white!important; margin-right: 10px;">View Counter</a>
                                                
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                        
                                    
                                    @else
                                    No any request made yet
                                    
                                    @endif
                                
                                
                    
                                </div>
                                </div>
                        </div> -->
                        <!--recieved-->
                        <div id="order_inTransit-content" class="tab-conte">
                        
                            <div >
                    <div class="container-fluid">
                    <div class="row">
                    
                            
                    </div>
                </div>
            </div>

    </div>
        
        
</div>










    </div>
        <div>
        </div>
        
    </div>




 
</div>




</div>

</div>
  @endsection

<!-- <script>
$('#shoperAllOrder').val(count($data));
</script> -->



