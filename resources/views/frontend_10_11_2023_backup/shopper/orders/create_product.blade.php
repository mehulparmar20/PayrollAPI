@extends('layouts.app')

@section('pages')

<?php
 $buy4meFee=$all_tax->buy4meFee;
 $paymentPro=$all_tax->proccessing_tax;
 $travel_tax=$all_tax->traveller_reward;

 
?>

<div>
<div class="best-product-area pb-15">
	<div class="pl-100 pr-100">
		<div class="container-fluid">
			<div class="section-title-3 text-center mb-40">
			<h2>Products Details</h2>
		</div>
		<div id="stepper1" class="bs-stepper linear" bis_skin_checked="1">
			<div class="card" bis_skin_checked="1">
				<div class="card-header cardHeaderx" bis_skin_checked="1">
					<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist" bis_skin_checked="1">
						<div class="step active" data-target="#test-l-1" bis_skin_checked="1">
							<div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1" aria-selected="true" bis_skin_checked="1">
								<div class="bs-stepper-circle" bis_skin_checked="1">1</div>
								<div class="" bis_skin_checked="1">
									<h5 class="mb-0 steper-title labelX">Product Details</h5>
									<p class="mb-0 steper-sub-title">Enter Product Details</p>
								</div>
							</div>
						</div>
						<div class="bs-stepper-line" bis_skin_checked="1"></div>
							<div class="step" data-target="#test-l-2" bis_skin_checked="1">
								<div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2" aria-selected="false" disabled="disabled" bis_skin_checked="1">
								<div class="bs-stepper-circle" bis_skin_checked="1">2</div>
								<div class="" bis_skin_checked="1">
									<h5 class="mb-0 steper-title labelX">Delivery Details</h5>
									<p class="mb-0 steper-sub-title">Setup Delivery Details</p>
								</div>
							</div>
						</div>
						<div class="bs-stepper-line" bis_skin_checked="1"></div>
							<div class="step" data-target="#test-l-3" bis_skin_checked="1">
								<div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3" aria-selected="false" disabled="disabled" bis_skin_checked="1">
									<div class="bs-stepper-circle" bis_skin_checked="1">3</div>
									<div class="" bis_skin_checked="1">
										<h5 class="mb-0 steper-title labelX">Summary</h5>
										<p class="mb-0 steper-sub-title">Summary Details</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body custmizeBX1a" bis_skin_checked="1">
						<div class="bs-stepper-content" bis_skin_checked="1">
							<form class="contact-form" method="get" enctype="multipart/form-data" id="contact-form" >
								@csrf
								<!-- <input type="hidden" name="name=_token" value="{{csrf_token()}}"> -->

								<div id="test-l-1" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="stepper1trigger1" bis_skin_checked="1">
									<div class="row g-3" bis_skin_checked="1">
										<div class="col-12 col-lg-4" bis_skin_checked="1">
											<label for="FisrtName" class="form-label labelX">Product Link </label>
											<input type="text" class="form-control textFx" id="order_product_link" name="product_link"  placeholder="Enter Product Link" onkeyup="summery_vali('product_link',{{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" value="{{$url}}" >
										</div>
										
										<div class="col-12 col-lg-4" bis_skin_checked="1">
										<label for="LastName" class="form-label labelX">Product Name <span style="color:red">*</span></label>
                                         <input type="text" class="form-control textFx" id="order_productName" name="product_name" value="{{$title}}" placeholder="Enter Product Name" onkeyup="validateProductName()">
                                         <p id="productNameErrorMessage" style="color: red;"></p>
                                       </div>

									
										<div class="col-12 col-lg-4" bis_skin_checked="1">
										<label for="PhoneNumber" class="form-label labelX">Product Image<span style="color:red">*</span></label>
										<input name="product_img[]" class="form-control mTxx1" id="product_images_pro" type="file" multiple="">
										<p id="productImageErrorMessage" style="color: red;"></p>
                                        </div>
										

										<!-- Code by K -->

										<div class="col-12 col-lg-4" bis_skin_checked="1">
										<label for="InputEmail" class="form-label labelX">Currency</label><br/>
										<input type="hidden" id="changed_currency_status" value="1" >
											<select  name="currency" onchange="updateCurrency({{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" id="change_currency">
												<option value='2' selected>USD</option>
												<option value='1' >INR</option>
											</select>
										</div>

										<div class="col-12 col-lg-4" bis_skin_checked="1">
										<div class="col-1" bis_skin_checked="1">
											<label for="InputEmail" class="form-label labelX">Price</label>
											<input name="" class="form-control textFx" type="text" id="order_product_currency" value="$">
											<!-- <input name="product_price" class="form-control textFx" type="text" value="{{$price}}" placeholder="Enter Price"  data-original-value="{{$price}}" onkeyup="summery_vali('product_price',{{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" id="order_product_price"> -->
											<!-- <p id="priceErrorMessage" style="color: red;"></p> -->
                                         </div>
										<div class="col-9 " bis_skin_checked="1">
											<label for="InputEmail" class="form-label labelX"><span style="color:red">*</span></label>
											<!-- <input name="" class="form-control textFx" type="text" id="order_product_currency"> -->
											<input name="product_price" class="form-control textFx" type="text" value="{{$price}}" placeholder="Enter Price"  data-original-value="{{$price}}" onkeyup="summery_vali('product_price',{{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" id="order_product_price">
											<p id="priceErrorMessage" style="color: red;"></p>
                                         </div>
										 </div>

										<div class="col-12 col-lg-4" bis_skin_checked="1">
										<label for="InputCountry" class="form-label labelX">QTY<span style="color:red">*</span></label>
										<input name="product_qty" required class="form-control mTxx1" type="number" onkeyup="summery_vali('product_qty',{{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" id="order_product_qty" value='1'>
										<p id="quantityErrorMessage" style="color: red;"></p>
                                         </div>

										
										<div class="col-12 col-lg-4" bis_skin_checked="1">
											<label for="InputLanguage" class="form-label labelX">With Box</label><br>
											<input type="checkbox" name="box"  id="product_with_box" class="checkbox_create" value="0">Requiring the box may reduce the number of offers you receive. Travelers generally prefer to deliver orders without the box, to save space. 
										</div>
										<div class="col-12 col-lg-8" bis_skin_checked="1">
											<label for="FisrtName" class="form-label labelX">Product Details</label>
											<textarea class="form-control product_details textFx textareH" name="product_details"  onkeyup="summery_vali('product_details',{{$buy4meFee}},{{$paymentPro}},{{$travel_tax}})" id="order_product_details">{{$discription}}</textarea>
										</div>
										<div class="col-12 col-lg-6" bis_skin_checked="1">
										</div>
										<div class="col-12 col-lg-6" bis_skin_checked="1" id="reload_div_auth">
											@if(Auth::check())
												
										
										<!-- <div class="menu-custbtn-area text-center mt-1" >
                <button  type="button" class="menu-custbtn" onclick="stepper1.next()"  id="creatorder_next" style="border:none;width: 165px;">Next<i class="bx bx-right-arrow-alt ms-2"></i></button>
            </div> -->
			<div class="menu-custbtn-area text-center mt-1" >
                <button  type="button" class="menu-custbtn" onclick="stepper1.next()"  id="creatorder_next" style="border:none;width: 111px;">Next<i class="bx bx-right-arrow-alt ms-2"></i></button>
            </div> 
											@else
												
									
										<!-- <div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                        <a class="menu-custbtn" href="#" onclick="openLogin()" href="#" style="min-width: 185px !important;">Next <i class="bx bx-right-arrow-alt ms-2"></i></a>
                    </div> -->
					<div class="menu-btnX-area text-center mt-1" style="display: inline-block;">
                        <a class="menu-custbtn" onclick="openLogin()" href="#" style="width: 111px !important;">Next <i class="bx bx-right-arrow-alt ms-2"></i></a>
                    </div>
					
												@endif
										</div>
									</div><!---end row-->
								</div>
								<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2" bis_skin_checked="1">
									<h5 class="mb-1">Delivery Details</h5>
									<p class="mb-4">Confirm Delivery City and Date</p>
									<div class="row g-3" bis_skin_checked="1">
										<div class="col-12 col-lg-6" bis_skin_checked="1">
											<label for="delivery" class="form-label labelX">From<span style="color:red">*</span></label>
											<select class="form-select single-select-field browsers_country" data-placeholder="Choose one thing" name="devliver_from" onchange="getState(this.value,'devliver_from')" id="delivery_from_ord">
											<p id="fromErrorMessage" style="color: red;"></p>
											</select>
										</div>
										

										<!-- <div class="col-12 col-lg-6" bis_skin_checked="1">
											<label for="InputEmail2" class="form-label">Delivery From City</label>
											<select class="form-select single-select-field" data-placeholder="Choose one thing" name="devliver_from_city" id="deliveryFromCity">
											</select>
										</div> -->
										<div class="col-12 col-lg-6" bis_skin_checked="1">
											<label for="InputPassword" class="form-label labelX">To<span style="color:red">*</span></label>
											<select class="form-select single-select-field browsers_country" data-placeholder="Choose one thing" name="devliver_to" id="deliver_to_ord" onchange="getState(this.value,'deliver_to_ord')" >
											<p id="toErrorMessage" style="color: red;"></p>
										</select>
										</div>
										<div class="col-12 col-lg-6" bis_skin_checked="1">
											<label for="InputConfirmPassword" class="form-label labelX">How long are you willing to wait? <span style="color:red">*</span></label>
											<select name="select" class="during_time" name="during_time" id="how_long">
												<option value="1">Up to 1 Month</option>
												<option value="2">Up to 3 Week</option>
												<option value="3"> Up to 2 week</option>
												<option value="4">Up To 2 months</option>
											</select>
											<p id="howlongErrorMessage" style="color: red;"></p>
										</div>
										<div class="col-12 col-lg-6" bis_skin_checked="1">
											<label for="InputConfirmPassword" class="form-label">Select<span style="color:red">*</span></label>
											<select class="form-select single-select-field" data-placeholder="City" name="devliver_to_city" id="deliver_to_ordCity" onchange="deliver_state_change()">
								
											</select>
											<p id="cityErrorMessage" style="color: red;"></p>
										</div>
										<div class="col-12 col-lg-6" bis_skin_checked="1">
										</div>
										<div class="col-12" bis_skin_checked="1">
											<div class="d-flex align-items-center gap-3" bis_skin_checked="1">
												<button class="btn btn-outline-secondary px-4 butnclass" onclick="stepper1.previous()"><i class="bx bx-left-arrow-alt me-2"></i>Previous</button>
												
												<!-- <div class="menu-btnX-area mt-1" >
                                           <button  type="button" class="menu-btnX" onclick="stepper1.next()" id="delivery_next"  style="border:none">Next<i class="bx bx-right-arrow-alt ms-2"></i></button>
                                        </div> -->

										<div class="menu-custbtn-area text-center mt-1" >
                <button  type="button" class="menu-custbtn" onclick="stepper1.next()" id="delivery_next" style="border:none;width: 111px;">Next<i class="bx bx-right-arrow-alt ms-2"></i></button>
            </div>
						
											</div>
										</div>
									</div><!---end row-->
								</div>
								<div id="test-l-3" role="tabpanel" id="product_summery_p" class="bs-stepper-pane" aria-labelledby="stepper1trigger3" bis_skin_checked="1">
								<p class="error" id="product-error" style="color: red;"></p>
								<h5 class="mb-1">Your order summary</h5>
									
									<div class="product-details-small nav ml-10 product-details-2 gallery" role=tablist>
								</div>
								<div class="row g-3" bis_skin_checked="1">
									<div class="col-12 col-lg-12" bis_skin_checked="1">
										<div class="">
											<span>Deliver from </span> :- <span id="summery_Deliverfrom"></span>
										</div>
										<div class="">
											<span>Deliver to </span> :- <span id="summery_Deliverto"></span>,<span id="summery_Deliverto_city"></span>
										</div>
										<div class="">
											<span>Deliver before </span> :- <span id="summery_Deliverbefore"> Up to 1 Month</span>
										</div>

										<div class="">
											<span>Quantity</span> :- <span id="summery_Quantity">1</span>
										</div>
										
										<div class="">
											<span>Packaging </span> :- <span id="summery_Packaging">Without Box</span>
										</div>
										<div class="">
											<span>product price </span> :- <span id="product price"></span>
										</div>

										
										
										<p id="sum_pro_description"></p>

										



									</div>

									<div class="col-12 col-lg-12" bis_skin_checked="1">
										<h3 id="summ_productName">Product Name</h3>
										<!-- <div class="rating-number">
											<div class="quick-view-rating">
												<i class="pe-7s-star red-star"></i>
												<i class="pe-7s-star red-star"></i>
												<i class="pe-7s-star"></i>
												<i class="pe-7s-star"></i>
												<i class="pe-7s-star"></i>
											</div>
											<div class="quick-view-number">
												<span>2 Ratting (S)</span>
											</div>
										</div> -->
									</div>
									<p id="sum_pro_description"></p>

										<div class="row pDetailsm">
										<!-- <div class="col-12 col-lg-3" bis_skin_checked="1">
										 <label for="summery_Deliverfrom" class="form-label">Deliver from</label>
										 <input class="form-control textFx" id="summery_Deliverfrom" placeholder="Deliver from" disabled>	
									    </div>
										<div class="col-12 col-lg-3" bis_skin_checked="1">
										  <label for="Deliver to" class="form-label">Deliver to</label>
										   <input class="form-control textFx" id="summery_Deliverto" placeholder="Deliver to" disabled>
										
									    </div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="Deliver to city" class="form-label">Deliver to city</label>
										<input class="form-control textFx" id="summery_Deliverto_city" placeholder="Deliver to city" disabled>	
									</div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="Deliver before " class="form-label">Deliver before </label>
										<input class="form-control textFx" id="summery_Deliverbefore" placeholder="Deliver before" disabled>	
									</div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="Quantity" class="form-label">Quantity</label>
										<input class="form-control textFx" id="summery_Quantity" placeholder="Quantity" disabled>	
									</div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="Packaging" class="form-label">Packaging</label>
										<input class="form-control textFx" id="summery_Packaging" placeholder="Packaging" disabled>	
									</div> -->
									<div class="col-12 col-lg-2" bis_skin_checked="1">
										<label for="InputCountry" class="form-label">Product Price</label>
										<input class="form-control" id="summery_pro_price" placeholder="Product Price" disabled>	
									</div>
									<div class="col-12 col-lg-2" bis_skin_checked="1">
										<label for="InputCountry" class="form-label">Traveller Reward</label>
										<input class="form-control" id="summery_traveler_reward" placeholder="Traveler Reward" disabled>	
									</div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="InputCountry" class="form-label">Buy4me Fee</label>
										<input class="form-control" id="summery_buy4me_fee" placeholder="Buy4me Fee" disabled>	
									</div>
									<div class="col-12 col-lg-3" bis_skin_checked="1">
										<label for="InputCountry" class="form-label">Payment Processing</label>
										<input class="form-control" id="summery_payment_processing" placeholder="Payment Processing" disabled>	
									</div>
									<div class="col-12 col-lg-2" bis_skin_checked="1">
										<label for="InputCountry" class="form-label">Estimated Total</label>
										<input class="form-control" id="summery_estimated_total" placeholder="Estimated Total" disabled>	
									</div>
										</div>
									<div class="col-12" bis_skin_checked="1">
										<div class="d-flex align-items-center gap-3" bis_skin_checked="1">
											<button class="btn btn-outline-secondary px-4 butnclass" onclick="stepper1.previous()"><i class="bx bx-left-arrow-alt me-2"></i>Previous</button>
						

											<!-- <div class="menu-btnX-area mt-1" >
                                           <button  type="button" class="menu-btnX" id="store_orderwith_details"  style="border:none">Create Order</button>
                                        </div> -->

										<div class="menu-custbtn-area text-center mt-1" >
											<button  type="button" class="menu-custbtn"  id="store_orderwith_details" style="border:none;width: 165px;">Create Order</button>
										</div>
											
										</div>
									</div>
								</div>
								<!---end row-->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	<!-- </div>
	</div>
</div> -->
@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    function isInputValid(inputId, errorMessageId) {
      var input = $(inputId);
      var inputValue = input.val().trim();
      if (inputValue === "" || parseInt(inputValue) === 0) {
        $(errorMessageId).text("This field is required.");
        return false;
      } else {
        $(errorMessageId).text("");
      }
      return true;
    }
    function enableNextButton() {
      var isValid = isInputValid("#order_product_qty", "#quantityErrorMessage") &&
                    isInputValid("#order_productName", "#productNameErrorMessage") &&
                    isInputValid("#order_product_price", "#priceErrorMessage")&&
					isInputValid("#product_images_pro", "#productImageErrorMessage");
				
      $("#creatorder_next").prop("disabled", !isValid);
    }
    $("#order_product_qty, #order_productName, #order_product_price, #product_images_pro").on("input", enableNextButton);
    enableNextButton();
    $(document).on("click", "#creatorder_next", function (event) {
      if (!isInputValid("#order_product_qty", "#quantityErrorMessage") ||
          !isInputValid("#order_productName", "#productNameErrorMessage") ||
          !isInputValid("#order_product_price", "#priceErrorMessage") ||
		  !isInputValid("#product_images_pro", "#productImageErrorMessage")
		  ) {
        event.stopPropagation();
        return false;
      }
    });
  });




$(document).ready(function () {
    function isDeliveryInputValid(inputId, errorMessageId) {
        var input = $(inputId);
        var inputValue = input.val();
        var errorMessage = $(errorMessageId);

        if (inputValue === null || inputValue === "" || inputValue.toLowerCase() === "country") {
            errorMessage.text("This field is required").css("color", "red");
            return false;
        } else {
            errorMessage.text(""); 
            return true;
        }
    }

    function enableNextButton() {
        var isValid =
            isDeliveryInputValid("#delivery_from_ord", "#fromErrorMessage") &&
            isDeliveryInputValid("#deliver_to_ord", "#toErrorMessage") &&
            isDeliveryInputValid("#how_long", "#howlongErrorMessage") &&
            isDeliveryInputValid("#deliver_to_ordCity", "#cityErrorMessage");

        $("#delivery_next").prop("disabled", !isValid);
    }

    $("#delivery_from_ord, #deliver_to_ord, #how_long, #deliver_to_ordCity").on("change", enableNextButton);
    enableNextButton();
});















function updatePrice() {
    // Get the selected currency value
    var currencySelect = document.getElementById('change_currency');
    var selectedCurrency = currencySelect.options[currencySelect.selectedIndex].value;

    // Get the price input field
    var priceInput = document.getElementById('order_product_price');

    // Set the price value based on the selected currency
    if (selectedCurrency === '1') {
        // If INR is selected, set the price to "0.00"
        priceInput.value = "0.00";
    } else {
        // Otherwise, set it to the original value
        priceInput.value = priceInput.getAttribute('data-original-value');
    }
}































</script>
