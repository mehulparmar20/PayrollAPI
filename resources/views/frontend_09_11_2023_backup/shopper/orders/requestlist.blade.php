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

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Trip Date</span><span class="childText"> {{ $row->travel_date }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">From</span><span class="childText">{{ $row->origin_country }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">To</span><span class="childText">{{ $row->destination_c }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">{{ date('M d, Y', strtotime($row->deliverd_date)) }}</span><span class="childText"></span>
                                    </div>

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Quantity</span><span class="childText">{{ $row->quantity }}</span>
                                    </div>

                                    <hr class="my-0" style="border-top: 1px solid #ccc !important;" />
                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Product Price</span><span class="childText pricesTag">{{ $row->currency == 'USD' ? '$' : 'INR' }}{{ $row->product_price }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Reward</span><span class="childText">{{ $row->currency == 'USD' ? '$' : 'INR' }}
                                            {{ $row->traveller_reward }}</span>
                                    </div>

                                    <hr class="my-0" style="border-top: 1px solid #ccc !important;" />
                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Counter Price</span><span class="childText pricesTag">{{ $row->currency == 'USD' ? '$' : 'INR' }}{{ $row->counter_product_price }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between spacing">
                                        <span class="boldText">Reward</span><span class="childText"> {{ $row->currency == 'USD' ? '$' : 'INR' }}
                                            {{ $row->counter_traveller_reward }}</span>
                                    </div>
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
                                        @if ($row->trip_id != null || $row->trip_id != '')
                                        <?php

                                        ?>

                                        <div class="text-center mt-10">
                                            <a href="{{ route('traveller.travellerCreateOffer', ['matched_id' => $row->matched_id]) }}">
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