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
                $i = "";
                $matchedorder = 0;
                $countrequested = 0;
                $incomingRequest = 0;
                // dd($data);
                if (count($data) != 0) {

                    foreach ($data as $row) {
                        // dd($row);
                        if ($row['matchedOrder'] == null) {
                            $matchedorder += 1;
                        } else {

                            if ($row['matchedOrder']['status'] == 1) {
                                $incomingRequest += 1;
                            }
                            if ($row['matchedOrder']['status'] == 2) {
                                $countrequested += 1;
                            }
                        }
                    }
                }
                ?>



              <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
                  <div class="StatusXX"><a class="active menuHeader tab-link" href="#matchTrip_order" data-bs-toggle="tab" role="tab"> Matched order({{$matchedorder}})</a></div>

                  <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_IncomingRe" data-bs-toggle="tab" role="tab">Incoming Request({{$incomingRequest}}) </a></div>

                  <div class="StatusXX"><a class="menuHeader tab-link" href="#matchTrip_requested" data-bs-toggle="tab" role="tab"> Requested({{$countrequested}}) </a></div>

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

                                  @if(!empty($data))
                                  @foreach($data as $row)

                                  @if($row['matchedOrder'] == Null)
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
                                              <a href="{{ route('traveller.first_counter', ['order' => $row->id ,'trip_id'=> $trip->id,'from' => $from, 'status' => 'counter-request']) }}">
                                                  <img src="{{ url('/public/product_img').'/'.$row['product']['image'] }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>
                                          <div class="card-body">
                                              <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" style="font-size: 16px !important;" data-original-title="{{$row['product']['product_name']}}">

                                                      @if (strlen($row['product']['product_name']) > 15)
                                                      {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                                                      @else
                                                      {{$row['product']['product_name']}}
                                                      @endif
                                                      <?php
                                                        $currency = "";
                                                        if ($row->currency == 'USD') {
                                                            $currency = '$';
                                                        } else {
                                                            $currency = 'INR';
                                                        }
                                                        ?>
                                                  </span>
                                              </p>

                                              <!-- Dipali Latest code start here -->
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Traveller</span><span class="childText">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->deliverd_date))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">City</span><span class="childText">{{$row['destination']['destination_city']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row['origincountry']}},{{$row->fromCity}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row['destination']['destination_country']}}</span>
                                              </div>



                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Price &nbsp:&nbsp <span class="" style="font-size: 11px;">{{$currency}}{{$row->product_price}}</span></span></a>
                                                      </h4>
                                                      <h4 class="card-text productN" style="display: inline; font-size:13px;"><a href="#"><span>Reward &nbsp:&nbsp<span class="details-price1">

                                                                      {{$currency}}{{$row->traveller_reward}}
                                                                  </span></span></a></h4>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{ route('traveller.first_counter', ['order' => $row->id ,'trip_id'=> $trip->id,'from' => $from, 'status' => 'counter-request']) }}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              First send counter offer
                                                          </button>
                                                      </a>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{route('stripeIdentity.index')}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Confirm
                                                          </button>
                                                      </a>
                                                  </div>

                                              </ul>
                                              <!-- Dipali latest code end here -->
                                              <div>

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
                                  @endif
                              </div>
                          </div>
                      </div>


                      <div class="tab-pane fade" id="matchTrip_IncomingRe" role="tabpanel">
                          <div class="container-fluid">
                              <div class="row">

                                  @foreach($data as $row)

                                  <?php
                                    if ($row->currency == 'USD') {
                                        $currency = '$';
                                    } else {
                                        $currency = 'INR';
                                    }
                                    ?>


                                  @if($row['matchedOrder'] != null && $row['matchedOrder']['status']==1)


                                  <div class="col-md-3 mb-3">
                                      <div class="card">
                                          <div class="testimonial-image text-center">
                                              <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=> 'incomingReqFromTraveller'])}}">
                                                  <img src="{{ url('/public/product_img').'/'.$row['product']['image'] }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>

                                          <div class="card-body">
                                              <p>
                                                  <span class="productN producthoverE" data-toggle="tooltip" data-placement="top" style="font-size: 16px !important;" data-original-title="{{$row['product']['product_name']}}">
                                                      @if (strlen($row['product']['product_name']) > 15)
                                                      {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                                                      @else
                                                      {{$row['product']['product_name']}}
                                                      @endif
                                                  </span>
                                              </p>
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Traveller</span><span class="childText">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">City</span><span class="childText">{{$row['destination']['destination_city']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row['origincountry']}},{{$row->fromCity}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row['destination']['destination_country']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->deliverd_date))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              @if($row->box==0)
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">Without box</span><span class="childText"></span>
                                              </div>
                                              @else
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">With box</span><span class="childText"></span>
                                              </div>
                                              @endif

                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Price &nbsp:&nbsp <span class="" style="font-size: 11px;">{{$currency}}{{$row->product_price}}</span></span></a>
                                                      </h4>
                                                      <h4 class="card-text productN" style="display: inline; font-size:13px;"><a href="#"><span>Reward &nbsp:&nbsp<span class="details-price1">

                                                                      {{$currency}}{{$row->traveller_reward}}
                                                                  </span></span></a></h4>
                                                  </div>

                                                  <div class="d-flex justify-content-between spacing">
                                                      <span class="boldText">Counter Price</span><span class="childText">{{$currency}}{{$row['matchedOrder']['counter_product_price']}}</span>
                                                  </div>
                                                  <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                                  <div class="d-flex justify-content-between spacing">
                                                      <span class="boldText">Reward</span><span class="childText">
                                                          {{$currency}}{{$row['matchedOrder']['counter_traveller_reward']}}</span>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=> 'incomingReqFromTraveller'])}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Send Counter Offer
                                                          </button>
                                                      </a>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerAcceptOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=>'AcceptOfferFromTraveller'])}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Accept Offer
                                                          </button>
                                                      </a>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerCancelOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=>'CancelOfferFromTraveller'])}}" onclick="return confirm('are you sure cancle this offer');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Cancel Request
                                                          </button>
                                                      </a>
                                                  </div>
                                              </ul>
                                              <div>
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

                      <div class="tab-pane fade" id="matchTrip_requested" role="tabpanel">
                          <div class="container-fluid">
                              <!--asaasasasas-->
                              <div class="row">

                                  @foreach($data as $row)

                                  <?php
                                    if ($row->currency == 'USD') {
                                        $currency = '$';
                                    } else {
                                        $currency = 'INR';
                                    }
                                    ?>


                                  @if($row['matchedOrder'] != null && $row['matchedOrder']['status']==2)


                                  <div class="col-md-3 mb-3">
                                      <div class="card">
                                          <div class="testimonial-image text-center">
                                              <a href="#">
                                                  <img src="{{ url('/public/product_img').'/'.$row['product']['image'] }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>

                                          <div class="card-body">
                                              <p>
                                                  <span class="productN producthoverE" data-toggle="tooltip" data-placement="top" style="font-size: 16px !important;" data-original-title="{{$row['product']['product_name']}}">
                                                      @if (strlen($row['product']['product_name']) > 15)
                                                      {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                                                      @else
                                                      {{$row['product']['product_name']}}
                                                      @endif
                                                  </span>
                                              </p>
                                              <!-- section 3 code start here -->
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Traveller</span><span class="childText">{{$row['user']['first_name']}} {{$row['user']['last_name']}}</span>

                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">City</span><span class="childText">{{$row['destination']['destination_city']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row['origincountry']}},{{$row->fromCity}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row['destination']['destination_country']}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->deliverd_date))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              @if($row->box==0)
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">Without box</span><span class="childText"></span>
                                              </div>
                                              @else
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">With box</span><span class="childText"></span>
                                              </div>
                                              @endif


                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Price &nbsp:&nbsp <span class="" style="font-size: 11px;">{{$currency}}{{$row->product_price}}</span></span></a>
                                                      </h4>
                                                      <h4 class="card-text productN" style="display: inline; font-size:13px;"><a href="#"><span>Reward &nbsp:&nbsp<span class="details-price1">

                                                                      {{$currency}}{{$row->traveller_reward}}
                                                                  </span></span></a></h4>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerAcceptOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=>'AcceptOfferFromTraveller'])}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Accept Offer
                                                          </button>
                                                      </a>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'cancle_orderRe','from'=>$from])--}}" onclick="return confirm('are you sure cancle this offer');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Cancel Request
                                                          </button>
                                                      </a>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row['matchedOrder']['id']])}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Send Counter Offer
                                                          </button>
                                                      </a>
                                                  </div>



                                              </ul>


                                              <!-- section 3 code end here -->

                                              <!-- <div class="details-price boxBorder">
                                                  <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                      <a href="#"><span>Price &nbsp:&nbsp <span class="" style="font-size: 13px;">{{$currency}}{{$row->product_price}}</span>
                                                          </span></a>
                                                  </h4>
                                                  <h4 class="card-text productN" style="display: inline; font-size:13px;"><a href="#">
                                                          <span>Reward &nbsp:&nbsp<span class="details-price1">{{$currency}}{{$row->traveller_reward}}</span></span></a></h4>
                                              </div> -->

                                              <div>

                                                  <!-- <a class="text-center mt-10" href="{{route('traveller.travellerAcceptOffer',['matched_id'=> $row['matchedOrder']['id'],'from'=>'AcceptOfferFromTraveller'])}}" style="min-width: 111px !important;  margin-right: 10px;">Accept Offer</a>
                                                  <div class="text-center mt-10">
                                                      <a href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'cancle_orderRe','from'=>$from])--}}" onclick="return confirm('are you sure cancle this offer');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Cancel Request
                                                          </button>
                                                      </a>
                                                  </div>
                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.travellerCreateOffer',['matched_id'=> $row['matchedOrder']['id']])}}">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Send Counter Offer
                                                          </button>
                                                      </a>
                                                  </div> -->
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
                                  @if($row->status==5)
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
                                              <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                                  <img src="{{ url('/public/product_img').'/'.$i }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>

                                          <div class="card-body">
                                              <p><span class="productN producthoverE" data-toggle="tooltip" style="font-size:16px!important;" data-placement="top" data-original-title="{{$row['product']['product_name']}}">
                                                      @if (strlen($row->product_name) > 15)
                                                      {{ substr($row->product_name, 0, 15) . '...' }}
                                                      @else
                                                      {{$row->product_name}}
                                                      @endif
                                                  </span>
                                              </p>


                                              <!-- section 4 code start here -->
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row->origincountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row->toCountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->during_time))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              @if($row->box==0)
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">Without box</span><span class="childText"></span>
                                              </div>
                                              @else
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">With box</span><span class="childText"></span>
                                              </div>
                                              @endif
                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Product price &nbsp:&nbsp <span class="" style="font-size: 11px;">${{$row->product_price}}</span></span></a>
                                                      </h4>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{route('stripeIdentity.index')}}" onclick="return confirm('Confirm Payment');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Confirm Identify
                                                          </button>
                                                      </a>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.send_stripeRequest',['order_id'=>$row->id,'status'=>'confirm_identity'])}}" onclick="return confirm('Confirm Payment');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Delivered
                                                          </button>
                                                      </a>
                                                  </div>
                                              </ul>

                                              <!-- section 4 code end here -->
                                              <div>
                                              </div>
                                              <div>
                                                  <!-- <a class="menu-btnXZ" href="{{route('stripeIdentity.index')}}" onclick="return confirm('Confirm Payment');" style="min-width: 111px !important; text-align: center;  margin-right: 10px;">Confirm Identify</a> -->
                                                  <!-- <a class="menu-btnXZ" href="{{route('traveller.send_stripeRequest',['order_id'=>$row->id,'status'=>'confirm_identity'])}}" onclick="return confirm('Confirm Payment');" style="min-width: 111px !important; text-align: center;  margin-right: 10px;">Delivered</a> -->
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                                  @else
                                  @endif
                                  @endforeach
                                  <!-- @foreach($data as $row)
                                    @if($row->trip_status==2 && $row->status==5)
                                        <?php
                                        $img = $row->product_imgs;
                                        $img = explode(' , ', $img);
                                        foreach ($img as $i) {
                                            $i = $i;
                                        }
                                        $i = str_replace([']', '['], " ", $i);
                                        $i = trim($i);
                                        ?> -->

                                  <!-- <div class="col-md-3 mb-3">
            <div class="card">
                <div class="product-img-2">
                        
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" class="img-fluid" alt="">
                        </a>
                       </div>
                       <div class="testimonial-image text-center">
                        <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <img src="https://b4m.veravalonline.com/b4m2/public/product_img/{{$row->image}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                        </a>
                    </div>

                <div class="card-body">
                <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row['product']['product_name']}}">
                @if (strlen($row['product']['product_name']) > 15)
                {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                @else
                {{$row['product']['product_name']}}
                @endif
               </span>
               </p>
                        <p class="card-text cardP"><span class="countryX">From:-{{$row->fromCountry}}</span>,{{$row->fromCity}}</p>
                        <p class="card-text cardP"><span><span class="countryX">To:-</span>{{$row->toCountry}}</p>
                        <p class="card-text cardP"><span>{{$row->toCity}},by {{ date("M d, Y", strtotime($row->during_time))}}</p>
                        @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                        <div class="details-price">
                     <h4 class="card-text productN" style="display: inline; margin-right: 6px;"><a href="#"><span>Product Price: <span class="details-price1">${{$row->product_price}}</span></span></a></h4>
                     </div>
                    <div>
                    <a class="menu-btnXZ"  href="{{-- route('traveller.send_tripRequest',['id'=>$row->ma_id,'status'=>'pick_up']) --}}"  style="min-width: 111px !important;  margin-right: 10px;">Pic Up The Order</a>
                    
                </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach -->
                              </div>
                          </div>
                      </div>

                      <div class="tab-pane fade" id="matchTrip_inTrain" role="tabpanel">
                          <div class="container-fluid">
                              <div class="row">

                                  @foreach($data as $row)


                                  @if($row->status==6)
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
                                              <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                                  <img src="{{ url('/public/product_img').'/'.$i }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>

                                          <div class="card-body">
                                              <p><span class="productN producthoverE" data-toggle="tooltip" style="font-size:16px!important;" data-placement="top" data-original-title="{{$row['product']['product_name']}}">
                                                      @if (strlen($row->product_name) > 15)
                                                      {{ substr($row->product_name, 0, 15) . '...' }}
                                                      @else
                                                      {{$row->product_name}}
                                                      @endif
                                                  </span>
                                              </p>



                                              <!-- section 5 code start here -->
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row->origincountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row->toCountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->deliverd_date))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              @if($row->box==0)
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">Without box</span><span class="childText"></span>
                                              </div>
                                              @else
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">With box</span><span class="childText"></span>
                                              </div>
                                              @endif
                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Product price &nbsp:&nbsp <span class="" style="font-size: 11px;">${{$row->product_price}}</span></span></a>
                                                      </h4>
                                                  </div>

                                                  <div class="text-center mt-10">
                                                      <a href="{{route('traveller.send_transitRequest',['order_id'=>$row->id,'status'=>'delivered'])}}" onclick="return confirm('Confirm Payment');">
                                                          <button type="button" class="btn btn-outline-custom">
                                                              Delivered
                                                          </button>
                                                      </a>
                                                  </div>
                                              </ul>

                                              <!-- section 5 code end here -->
                                              <div>
                                              </div>
                                              <div>
                                                  <!-- <a class="menu-btnXZ" href="{{route('traveller.send_transitRequest',['order_id'=>$row->id,'status'=>'delivered'])}}" onclick="return confirm('Confirm Payment');" style="min-width: 111px !important; text-align: center;  margin-right: 10px;">Delivered</a> -->

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
                                  @if($row->status==3)
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
                                              <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                                  <img src="{{ url('/public/product_img').'/'.$i }}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px; padding-top: 11px !important;">
                                              </a>
                                          </div>
                                          <div class="card-body">
                                              <p><span class="productN producthoverE" data-toggle="tooltip" style="font-size:16px!important;" data-placement="top" data-original-title="{{$row->product_name}}">
                                                      @if (strlen($row['product']['product_name']) > 15)
                                                      {{ substr($row['product']['product_name'], 0, 15) . '...' }}
                                                      @else
                                                      {{$row['product']['product_name']}}
                                                      @endif
                                                  </span>
                                              </p>


                                              <!-- section 6 code start here -->

                                              <!-- <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">City</span><span class="childText">{{$row->toCity}}</span>
                                              </div> -->
                                              <!-- <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" /> -->
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">From</span><span class="childText">{{$row->origincountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">To</span><span class="childText">{{$row->toCountry}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />
                                              <div class="d-flex justify-content-between spacing">
                                                  <span class="boldText">Date</span><span class="childText">by {{ date("M d, Y", strtotime($row->during_time))}}</span>
                                              </div>
                                              <hr class="my-0" style="border-top: 1px solid #1a121273 !important;" />

                                              @if($row->box==0)
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">Without box</span><span class="childText"></span>
                                              </div>
                                              @else
                                              <div class="d-flex justify-content-between spacing ">
                                                  <span class="boldText">With box</span><span class="childText"></span>
                                              </div>
                                              @endif

                                              <ul class="list-group list-group-flush">
                                                  <div class="details-price boxBorder" style="margin-top: 7px;">
                                                      <h4 class="card-text productN" style="display: inline; margin-right: 4px; font-size:13px;">
                                                          <a href="#"><span>Product price &nbsp:&nbsp <span class="" style="font-size: 11px;">${{$row->product_price}}</span></span></a>
                                                      </h4>

                                                  </div>
                                              </ul>
                                              <!-- section 6 code end  here -->
                                              <div>

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