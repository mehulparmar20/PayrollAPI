@extends('frontend.user.layouts.main')

@section('pages')

<div class="best-product-area pb-15">
    <div class="pl-10">

        <div class="container-fluids">


            @include('frontend.user.order_header')

            <div id="order-content">
                <div id="all-orders-content" class="tab-content1">
                    <div class="row">


                        @if(count($data) != 0)
                        @foreach($data as $row)

                        <?php

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
                                    <a href="">
                                        <img src="{{ url('/public/product_img').'/'.$row->image }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">

                                    </a>
                                </div>
                                <div class="card-body">


                                    <p><span class="productN producthoverE" data-toggle="tooltip" style="font-size:16px!important;" data-placement="top" data-original-title="$row->product_name">
                                            @if (strlen($row->product_name) > 15)
                                            {{ substr($row->product_name, 0, 15) . '...' }}
                                            @else
                                            {{$row->product_name}}
                                            @endif
                                        </span>
                                    </p>



                                    <div class="d-flex justify-content-between spacing ">
                                        <span class="boldText">Traveller</span><span class="childText">{{ $row->first_name }} {{ $row->last_name }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Trip Date</span><span class="childText">{{ $row->travel_date }} </span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />


                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">From</span><span class="childText">{{ $row->origin_country }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />


                                    <!-- <p class="card-text cardP"><span><span class="countryX">To:-</span>{{ $row->destination_city }}</p> -->

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">To</span><span class="childText">{{ $row->destination_c }}</span>
                                    </div>
                                    <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

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
                                            <span class="boldText">Counter Price</span><span class="childText">{{ $row->currency == 'USD' ? '$' : 'INR' }}{{ $row->product_price }}</span>
                                        </div>
                                        <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                        <div class="d-flex justify-content-between spacing">
                                            <span class="boldText">Reward</span><span class="childText">
                                                {{ $row->currency == 'USD' ? '$' : 'INR' }}
                                                {{ $row->counter_traveller_reward }}</span>
                                        </div>
                                    </ul>

                                    <!-- Dipali latest code end here -->
                                    <hr class="my-0" style="border-top: 1px solid #ccc !important;" />

                                    <div>

                                        <div>
                                            <div>

                                            </div>
                                        </div>





                                        <!-- <a href="">
                                        <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z" />
                                                <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z" />
                                            </svg>
                                            <span class="detailsX1">Show Details</span>
                                        </span>
                                    </a> -->

                                        <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row->matched_id,'from'=>'AcceptOfferFromTraveller'])}}">
                                            <button type="button" class="btn btn-outline-black1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16" style="margin-right: 5px;"> <!-- Add margin to create spacing -->
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                                </svg>
                                                View Details
                                            </button>
                                        </a>

                                        @if ($row->trip_id != null || $row->trip_id != '')

                                        <?php

                                        ?>
                                        <div class="text-center mt-10">

                                            <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row->matched_id,'from'=>'AcceptOfferFromTraveller'])}}">
                                                <button type="button" class="btn btn-outline-custom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                                    </svg>
                                                    View Counter
                                                </button>
                                            </a>
                                        </div>
                                        <?php
                                        if ($row->counter_product_price && $row->counter_traveller_reward != '') {
                                            $total = $row->counter_product_price + $row->counter_traveller_reward;
                                        } else {
                                            $total = $row->product_price + $row->traveller_reward;
                                        }
                                        //    echo $total; exit;
                                        ?>
                                        <div class="text-center mt-10">
                                            <a href="{{route('stripe.shopper',['match_id'=>$row->matched_id,'total'=>$total])}}">
                                                <button type="button" class="btn btn-outline-custom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                                    </svg>
                                                    Confirm Pay
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