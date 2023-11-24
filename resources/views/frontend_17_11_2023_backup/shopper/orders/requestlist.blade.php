@extends('frontend.user.layouts.main')

@section('pages')

<div class="best-product-area pb-15">
    <div class="pl-10">

        <div class="container-fluids">


            @include('frontend.user.order_header')

            <div id="order-content">
                <div id="all-orders-content" class="tab-content1">
                    <div class="row">
                        @if (count($data) != 0)
                        @foreach ($data as $row)
                        <?php

                        $img = $row->image;
                        $img = explode(' , ', $img);
                        foreach ($img as $i) {
                            $i = $i;
                        }
                        $i = str_replace([']', '['], ' ', $i);
                        $i = trim($i);
                        ?>

                        <div class="col-md-3 mb-3">
                            <div class="card">

                                <div class="testimonial-image text-center">
                                    <a href="{{ route('shopper.order_details', $row->slug) }}">
                                        <img src="{{ url('/public/product_img') . '/' . $row->image }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p><span class="productN producthoverE" data-toggle="tooltip" style="font-size:16px!important;" data-placement="top" data-original-title=" $row->product_name">
                                            @if (strlen($row->product_name) > 15)
                                            {{ substr($row->product_name, 0, 15) . '...' }}
                                            @else
                                            {{ $row->product_name }}
                                            @endif
                                        </span>
                                    </p>


                                    <div class="d-flex justify-content-between spacing ">
                                        <span class="boldText">Traveller</span><span class="childText">{{ $row->first_name }} {{ $row->last_name }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273!important;" />

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Trip Date</span><span class="childText">{{ $row->travel_date }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />




                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">From</span><span class="childText">{{ $row->origin_country }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">To</span><span class="childText">{{ $row->destination_c }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273!important;" />

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Date</span><span class="childText">{{ date('M d, Y', strtotime($row->deliverd_date)) }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Quantity</span><span class="childText">{{ $row->quantity }}</span>
                                    </div>










                                    <!-- Dipali latest code start here -->
                                    <ul class="list-group list-group-flush">
                                         <div class="details-price boxBorder" style="margin-top: 7px;">
                                            <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                <a href="#"><span>Price &nbsp:&nbsp <span class="" style="font-size: 11px;">{{ $row->currency == 'USD' ? '$' : 'INR' }}{{ $row->product_price }}</span></span></a>
                                            </h4>
                                            <h4 class="card-text productN" style="display: inline; font-size:13px;"><a href="#"><span>Reward &nbsp:&nbsp<span class="details-price1">
                                                            {{ $row->currency == 'USD' ? '$' : 'INR' }}
                                                            {{ $row->traveller_reward }}
                                                        </span></span></a></h4>
                                        </div>

                                        <div class="d-flex justify-content-between spacing">
                                            <span class="boldText">Counter Price</span><span class="childText">{{ $row->currency == 'USD' ? '$' : 'INR' }}{{ $row->counter_product_price }}</span>
                                        </div>
                                        <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                        <div class="d-flex justify-content-between spacing">
                                            <span class="boldText">Reward</span><span class="childText">
                                                {{ $row->currency == 'USD' ? '$' : 'INR' }}
                                                {{ $row->counter_traveller_reward }}</span>
                                        </div>
                                    </ul>

                                    <!-- Dipali latest code end here -->
                                    <div>

                                        <div>


                                            <div>

                                            </div>
                                        </div>

                                        <hr class="my-0 spacing" style="border-top: 1px solid #ccc !important;" />

                                        <a href="{{ route('shopper.order_details', $row->slug) }}">
                                            <button type="button" class="btn btn-outline-black1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16" style="margin-right: 5px;"> <!-- Add margin to create spacing -->
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                                </svg>
                                                View Details
                                            </button>
                                        </a>
                                        <!-- <div class="detailsView">
                                            <a href="{{ route('shopper.order_details', $row->slug) }}">
                                                <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                                                   
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="margin-right: 10px;">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                    <span class="detailsX1">View Details</span>
                                                </span>
                                            </a>
                                        </div> -->

                                        @if ($row->trip_id != null || $row->trip_id != '')
                                        <?php

                                        ?>
                                        <!-- <div class="menu-btnX-area text-center mt-10">
                                                                <a class="menu-btnXZ"
                                                                    href="{{ route('traveller.travellerCreateOffer', ['matched_id' => $row->matched_id]) }}"
                                                                    style="min-width: 111px !important; color:white!important; margin-right: 10px;">View
                                                                    Counter</a>
                                                            </div> -->


                                        <div class="text-center mt-10">
                                            <a href="{{ route('traveller.travellerCreateOffer', ['matched_id' =>$row->matched_id]) }}">
                                                <button type="button" class="btn btn-outline-custom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                                    </svg>
                                                    View Counter
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @else
                        No Order Created yet!
                        @endif


                    </div>



                    <!--<div id="tab2-content" class="tab-content">-->

                    <!--    order request-->
                    <!--</div>-->
                    <!-- <div id="order_requested-content" class="tab-content1">
                         <div class="container-fluid">
                          <div class="row">
                              @if (count($data) != 0)
    @foreach ($counterOffer as $row)
    <?php
    $img = $row['OrderDetails']['product_imgs'];
    $img = explode(' , ', $img);
    foreach ($img as $i) {
        $i = $i;
    }
    $i = str_replace([']', '['], ' ', $i);
    $i = trim($i);

    ?>
               
                
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            
                                              1  <div class="testimonial-image text-center">
                                                    <a href="{{-- route('user.order_details',['id'=>$row['OrderDetails']['id']]) --}}">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{-- $i --}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                                    </a>
                                                </div>
                                            <div class="card-body">
                                            <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{-- $row['OrderDetails']['product_name'] --}}">
                                            @if (strlen($row->product_name) > 15)
    {{--  substr($row->product_name, 0, 15) . '...' --}}
@else
    {{-- $row['OrderDetails']['product_name'] --}}
    @endif
                                        </span>
                                        </p>
                                                    <p class="card-text cardP"><span class="countryX">From:-{{-- $row['OrderDetails']['fromCountry'] --}}</span>,{{-- $row['OrderDetails']['fromCity'] --}}</p>
                                                    <p class="card-text cardP"><span><span class="countryX">To:-</span>{{-- $row['OrderDetails']['toCountry'] --}}</p>
                                                    <p class="card-text cardP"><span>{{-- $row->toCIty --}},by {{--  date("M d, Y", strtotime($row->during_time)) --}}</p>
                                                
                                                <div class="details-price">
                                                <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Price: <span class="details-price1">${{-- $row->product_price --}}</span></span>,</a></h4>
                                                <h4 class="card-text productN" style="display: inline;"><a href="#"><span>new Reward: <span class="details-price1">${{-- $row->travel_reward --}}</span></span></a></h4>
                                                </div>
                                                
                                                    <div class="details-price">
                                                <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{-- $row['OrderDetails']['product_price'] --}}</span></span>,</a></h4>
                                                <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">${{-- $row['OrderDetails']['traveller_reward'] --}}</span></span></a></h4>
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
                                            

                                                @if ($row->trip_id != null || $row->trip_id != '')
    <div class="menu-btnX-area text-center mt-10">
                                                            <a class="menu-btnXZ"  href="{{-- route('shopper.create_offer',['id'=>$row['OrderDetails']['id'],'matched_id'=>$row->id,'from'=>$from,'status'=>'requested']) --}}"  style="min-width: 111px !important; color:white!important; margin-right: 10px;">View Counter</a>
                                        
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

                        <div>
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