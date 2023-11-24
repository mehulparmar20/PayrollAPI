@extends('frontend.user.layouts.main')

@section('pages')

<div class="best-product-area pb-15">
        <div class="pl-10">
            <!-- pl-100 pr-100 -->
            <div class="container-fluids"> 
            <div id="order-content">
                    <div id="all-orders-content" class="tab-content">
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
                                                <!-- <div class="product-img-2">
                                                        
                                                        <a href="{{-- route('user.order_details',['id'=>$row->id])--}}">
                                                        <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{-- $i--}}" class="img-fluid" alt="">
                                                        </a>
                                                        
                                                    </div> -->
                                                    <div class="testimonial-image text-center">
                                                        <a href="{{-- route('user.order_details',['id'=>$row['OrderDetails']['id']])--}}">
                                                        <!-- <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{-- $i--}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;"> -->
                                                        <img src="<?php echo url('/public/product_img/').'/'.$i; ?>" alt="Testimonial Image1" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">

                                                        <!-- <img src="{{ url('/public/product_img').'/'.<?php echo $i; ?>" alt="Testimonial Image1" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;"> -->

                                                        </a>
                                                    </div>
                                                <div class="card-body">
                                                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $row->product_name; ?>">
                                                <?php echo $row->product_name; ?>
                                            </span>
                                            </p>
                                                        <p class="card-text cardP"><span class="countryX">From:-  <?php echo $row->origin_country; ?></span></p>
                                                        <p class="card-text cardP"><span><span class="countryX">To:-</span><?php echo $row->destination_c; ?></p>
                                                        <p class="card-text cardP"><span><?php echo $row->destination_city; ?>,by <?php echo date("M d, Y", strtotime($row->deliverd_date)) ?></p>
                                                    
                                                    <div class="details-price">
                                                    <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Price: <span class="details-price1">$<?php echo $row->price; ?></span></span>,</a></h4>
                                                    <!-- <h4 class="card-text productN" style="display: inline;"><a href="#"><span>new Reward: <span class="details-price1">${{-- $row->travel_reward--}}</span></span></a></h4> -->
                                                    </div>
<!--                                                     
                                                        <div class="details-price">
                                                    <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{-- $row['OrderDetails']['price']--}}</span></span>,</a></h4>
                                                    <h4 class="card-text productN" style="display: inline;"><a href="#"><span>Reward: <span class="details-price1">${{-- $row['OrderDetails']['traveller_reward']--}}</span></span></a></h4>
                                                    </div> -->
                                                    
                                                    
                                                    <div>
                                                    <!-- <a href="{{--  route('user.order_details', ['id' => $row->id]) --}}">
                                                    <span class="d-inline-block" data-toggle="tooltip" title="Show Details">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M.293 8.293a1 1 0 0 1 0-1.414L7 1.293l1.293 1.293a1 1 0 0 1-1.414 1.414L6 2.414 1.707 6.707a1 1 0 0 1-1.414 0z"/>
                                                    <path d="M14 8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-1 0a5 5 0 1 0-10 0 5 5 0 0 0 10 0z"/>
                                                    </svg>
                                                    <span class="detailsX1">Show Details</span> -->
                                                </span>
                                                    </a>
                                                </div>
                                                

                                                   
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    No any request made yet
                                @endif
                        </div>
                    </div>
            </div>
            </div>
        </div>
</div>
  @endsection



<!-- <script>
    $(document).ready(function () {
        
    });
</script> -->

