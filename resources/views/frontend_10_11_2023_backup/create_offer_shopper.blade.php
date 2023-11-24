@include('frontend.includes.header')
<?php

setlocale(LC_MONETARY,"en_US"); ?>
<body>

    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
        <div class="pl-100 pr-100">
            <div class="container-fluid">
                <div class="section-title-3 text-center mb-40">
                    <h2>Orders Details</h2>
                <!-- <input type="hidden" id="check_travelOfferurl" value="{{url()->current()}}"> -->
                </div>

                @if(!empty($data))
                    <div class="best-product-style">
                        <?php
                            // dd($data);
                            $i="";
                                $img=$data->image;
                                $img=explode(' , ', $img);
                        ?>
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4 border-end">
                                
                                    <!-- <a href="{{URL::to('/')}}/public/product_img/{{$i}}"> -->
                                    <a href="{{route('shopper.order_details',$data->slug)}}">
                                        <img src="{{ url('/public/product_img').'/'.$data->image }}" alt="" class="img-fluid">
                                    </a>
                                
                                </div>
                                
                                <div class="col-md-8">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                           
                                    <form method="post" action="{{ route('shopper.store_offer_shopper',['id'=>$data->matched_id]) }}">
                                        @csrf
                                        <input type="hidden" value="{{$data->matched_id}}" name="order_id">
                                        
                                    @if(!empty($data))
                                    <input type="hidden" value="{{$data->trip_id}}" name="trip_id">
                                        <input type="hidden" value="{{$data->matched_id}}" name="matched_id">
                                        @else
                                            
                                        <input type="hidden" value="{{$data->trip_id}}" name="trip_id">
                                        @endif
                                        <div class="card-body">
                                        <h4 class="card-title">{{$data->product_name}}</h4>
                                        <dl class="row">
                                            <dt class="col-sm-3">Quantity</dt>
                                            <dd class="col-sm-9">{{$data->quantity}}</dd>
                                        
                                            <dt class="col-sm-3">Packaging</dt>
                                            <dd class="col-sm-9">@if($data->box=='1') With Box @else Without box @endif</dd>
                                        
                                            
                                        </dl>
                                    
                                        <p class="card-text fs-6">{{$data->product_details}}</p>
                                        <input type="hidden" id="pro_ch_price" value="{{$data->product_price}}" name="pro_ch_price">
                                        <input type="hidden" id="qty_ch_price" value="{{$data->quantity}}" name="qty_ch_price">
                                        <input type="hidden" id="traveller_re_ch_price" value="{{$data->traveller_reward}}" name="traveller_re_ch_price">
                                        <input type="hidden" id="status" value="{{$data->status}}" name="status">
                                        <dl class="row">
                                            <dt class="col-sm-3">From</dt>
                                            <dd class="col-sm-9">{{$data->origin_country}}</dd>
                                            <dt class="col-sm-3">To</dt>
                                            <dd class="col-sm-9">{{$data->destination_c}},{{$data->destination_city}}</dd>
                                        
                                            <dt class="col-sm-3">Before</dt>
                                            <dd class="col-sm-9">{{$data->deliverd_date}} </dd>
                                        </dl>
                                        <dl class="row">
                                        <dt class="col-sm-3">Product Price</dt>
                                            <dd class="col-sm-9" >
                                                <!-- <span id="changed_pro_price_tr">${{$data->product_price}}</span> -->
                                                <span id="">${{$data->product_price}}</span>
                                                <input type="number" placeholder="Offer" onkeyup="chnagePriceTraveller('product_price_change','{{$data->Buy4me_fee}}','{{$data->payment}}','{{$data->traveller_reward}}')" class="form-group" id="change_product_price_fee" name="change_product_price_fee" value="{{$data->counter_product_price}}">
                                            
                                               </dd>
                                            <dt class="col-sm-3">Reward</dt>
                                            <dd class="col-sm-9" >
                                                <!-- <span id="changed_traveller_re_tr">{{$data->traveller_reward}}</span>  -->
                                                <span id="">{{$data->traveller_reward}}</span> 
                                                <input type="number" placeholder="Offer" class="form-group" onkeyup="chnagePriceTraveller('traveller_fee','{{$data->Buy4me_fee}}','{{$data->payment}}','{{$data->traveller_reward}}')" id="change_travel_fee" name="change_travel_fee" value="{{$data->traveller_reward}}">
                                            
                                                <!-- <input type="number" placeholder="Offer" class="form-group" onkeyup="chnagePriceTraveller('traveller_fee','{{$data->Buy4me_fee}}','{{$data->payment}}','{{$data->traveller_reward}}')" id="change_travel_fee" name="change_travel_fee" value="counter_traveller_reward}}"> -->
                                            </dd>
                                            <dt class="col-sm-3">Message</dt>
                                            <dd class="col-sm-9" >
                                                    <a 
                                                        href="javascript:void(0)" 
                                                        id="show-user" 
                                                        data-url="{{ $data->match_buyer_id }}" 
                                                        class="btn btn-info"
                                                        >Show</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <span id="user-fname"></span>
                                                    <span id="user-lname"></span>
                                                    <span id="user-message"></span>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                                    <input type="hidden" placeholder="Enter Message" id="trip_id" name="trip_id" value="{{$data->trip_id}}"/>
                                                    <input type="hidden" placeholder="Enter Message" id="order_id" name="order_id" value="{{$data->matched_id}}"/>
                                                    <input type="hidden" placeholder="Enter Message" id="buyer_id" name="buyer_id" value="{{$data->match_buyer_id}}"/>
                                                    <input type="hidden" placeholder="Enter Message" id="traveller_id" name="traveller_id" value="{{$data->matched_id}}"/>
                                                        
                                                    <input type="text" placeholder="Enter Message" id="message" name="message"/>
                                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                                        <button type="button" id="butsave" class="btn btn-primary">Send</button>
                                                </div>
                                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                               
                                                </div>
                                            </div>
                                            </div>
                                            <!-- Model End -->
                                                 
                                            </dd>
                                            <dt class="col-sm-3">Buy4me Fee</dt>
                                            <!-- <dd class="col-sm-9" id="changed_buy4me_fee_tr">{{$data->Buy4me_fee}} </dd> -->
                                            <dd class="col-sm-9" >
                                                <span id="changed_buy4me_fee_tr">${{$data->Buy4me_fee}}</span>
                                            </dd>
                                            <dt class="col-sm-3">Payment Processing</dt>
                                            <dd class="col-sm-9" id="changed_payment_fee_tr">{{$data->proccessing_fee}} </dd>
                                        </dl>
                                        <div class="details-price">
                                            <span>Total Payout </span>:-<span id="changed_totalPrice_tr">
                                            {{$data->total}}   </span>
                                            <input type="hidden" id="pro_total_price_changed" value="{{$data->total}}">
                                            <input type="hidden" id="pro_traveller_price_changed" value="{{$data->traveller_reward}}">
                                            <input type="hidden" id="pro_p_price_changed" value="{{$data->total}}">
                                            <input type="hidden" id="or_id" value="{{--$data->id--}}">
                                        </div>
                                        <h5>Delivery Details</h5>
                                        <hr>
                                        <!-- <button >Add trip</button> -->
                                        <p><input type="checkbox" required> By making a Delivery offer or starting a delivery, I agree to Buy4Me's Terms and Conditions and acknowledge that I am familiar with and agree to abide by the customs rules and regulations of my destination country. I also acknowledge that I am responsible for paying customs duties and covering any extra charges that the customs at my destination country may impose.</p>
                                        <div class="d-flex gap-3 mt-3">
                                            <!-- <button type="submit">Request</button>
                                            <button><a href="{{route('stripeIdentity.index')}}">Confirm </a></button> -->
                                            <div class="menu-custbtn-area text-center mt-1" >
                                                <button  type="submit" class="menu-custbtn" style="border:none;width: 111px;">Request</button>

                                                <a  href="{{route('stripe.shopper',['match_id'=>$data->matched_id,'total'=>$data->total])}}" class="menu-custbtn" style="border:none;width: 111px; padding: 3px 15px 3px 15px;">Confirm</a>
                                                
                                                <!-- <a  href="https://buy.stripe.com/test_fZe8zEfCX7iv0XC9AA" class="menu-custbtn" style="border:none;width: 111px; padding: 3px 15px 3px 15px;">Confirm</a> -->
                                                    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    </div>
                @else
                    Data not found
                @endif
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function () {
       /* When click show user */
        $('body').on('click', '#show-user', function () {
          var userURL = $(this).data('url');
         // $.get(userURL, function (data) {
            $.get('viewmessage/' + userURL, function (data) {
              $('#userShowModal').modal('show');
              data.forEach(function (item) {
                        // $('#user-id').append('<p>' + item.traveller_id + '</p>');
                        $('#user-fname').append('<h6>' + item.first_name + '</h6>');
                        $('#user-lname').append('<h6>' + item.last_name + '</h6>');
                        $('#user-message').append('<h6>' + item.message + '</h6>');
                    });
                   
          })
       });
       
    });
$(document).ready(function() {
    $('#butsave').on('click', function() {
      var message = $('#message').val();
      var trip_id = $('#trip_id').val();
      var order_id = $('#order_id').val();
      var buyer_id = $('#buyer_id').val();
      var traveller_id = $('#traveller_id').val();
    //  console.log("trip_id",trip_id)
      if(message!=""){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              url: base_path+"/traveller/travellermessage",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  type: 1,
                  message: message,
                  trip_id: trip_id,
                  order_id: order_id,
                  buyer_id: buyer_id,
                  traveller_id: traveller_id
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
                //   alert("success");
                  $("#userShowModal").modal("hide");
                  location.reload();
                //  UpdateTax();
                //   var dataResult = JSON.parse(dataResult);
                //   if(dataResult.statusCode==200){
                //     window.location = "/travellermessage";				
                //   }
                //   else if(dataResult.statusCode==201){
                //      alert("Error occured !");
                //   }
                  
              }
          });
      }
      else{
          alert('Please fill all the field !');
      }
  });
});
</script>
<!-- menu area end -->
@include('frontend.includes.footer')
<!-- all js here -->
@include('frontend.includes.footer_script')
</body>
</html>
