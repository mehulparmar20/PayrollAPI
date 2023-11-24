@extends('layouts.app')

@section('pages')




<div class="slider-area">
  <div class="container-fluid p-0">
    <div class="containerimage mydeivtest" style=" background-image: url(
        'public/frontend/custom/img/Banner Final - 1.jpg' );">
      <div class="bottom-left text-block btn-1"><a href="{{route('shopper.index')}}">Shopper</a></div>

      <div class="bottom-right text-block btn-1"><a href="{{route('traveller')}}">Traveller</a></div>
    </div>
  </div>
</div>




<!-- slider-area end-->
<!-- <div class="slider-active owl-carousel">
        <div class="food-slider bg-img slider-height-5" style="background-image: url(public/frontend/custom/img/Banner-1.jpg)">
            <div class="container">
                <div class="food-slider-content text-center fadeinup-animated-1">
                     <img class="animated" src="assets/img/slider/6.png" alt="">
                    <p class="animated">Earn $200+ USD every time you travel abroad</p>
                    <a class="food-slider-btn food-slider-btn-2 animated" href="#">How Buyforme works</a> -->
<!-- Recent Transactions area start -->
<div class="popular-product-area wrapper-padding-3 pt-15 pb-60">
  <div class="container-fluid">
    <div class="section-title-6 text-center mb-50">
      <h1 class="custom-heading">Recent Transactions</h1>
      <p>Bridging Nations, One Transaction at a Time.</p>
    </div>
    <div class="product-style">
      <div class="popular-product-active owl-carousel">
        @foreach($latestProduct as $row)
        <?php
        $img = $row->product_imgs;
        $img = explode(' , ', $img);
        foreach ($img as $i) {
          $i = $i;
        }
        $i = str_replace([']', '['], " ", $i);
        $i = trim($i);
        ?>
        <div class="product-wrapperx">

          <!-- <div class="product-img-1x">
                                <a href="#">
                                <a href="{{route('user.order_details',['id'=>$row->id])}}">
                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}"alt="">
                          </a>
                                </a>
                            </div>
                            <div class="funiture-product-content text-center">
                                <h4><a href="#">{{$row->product_name}}</a></h4>
                                <span>${{$row->product_price}}</span>
                    
                            </div> -->






          <!-- <a href="{{route('user.order_details',['id'=>$row->id])}}"> -->
          <div class="testimonial-box1 d-flex flex-column align-items-center">
            <div class="testimonial-image text-center">
              <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="Testimonial Image" class="img-fluid" style="max-height: 200px;">
            </div>
            <div class="testimonial-text">
              <p><span class="productN producthoverE" data-toggle="tooltip" data-placement="top" data-original-title="{{$row->product_name}}">
                  @if (strlen($row->product_name) > 15)
                  {{ substr($row->product_name, 0, 15) . '...' }}
                  @else
                  {{$row->product_name}}
                  @endif
                </span>
                <span class="menu-product-new" style="margin-left: 20px;">${{$row->product_price}}</span>
              </p>
            </div>
          </div>
          <!-- </a> -->
        </div>








        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- Recent Transactions area end -->
<!-- whybuyforme area start -->
<div class="food-menu-area bg-img pt-110" style="background-image: url(assets/img/bg/13.jpg)">
  <div class="services-area wrapper-padding-4 gray-bg pt-0 pb-6">
    <div class="container-fluid">
      <div class="section-title-6 text-center mb-50">
        <h1 class="custom-heading">Why Buy4Me </h1>
        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p> -->
      </div>

      <div class="container mt-4 mb-4 bg-light"> <!-- Added bg-light class for the light gray background -->
        <div class="row">
          <!-- Left Side Column 1 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Faster, Cost-Effective Shipping.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Faster, Cost-Effective Shipping</h3>
                <p>Say goodbye to lengthy shipping times and high costs. Our innovative approach leverages travelers' existing trips to deliver items swiftly and economically, meeting urgent and specialized shipping requirements.</p>
              </div>
            </div>
          </div>

          <!-- Middle Column 2 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Secure and Transparent Transactions.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Dedicated Customer Support</h3>
                <p>Have a question or need assistance? Our dedicated customer support team is here to help. We're committed to providing you with a seamless and hassle-free experience.</p>
              </div>
            </div>
          </div>

          <!-- Right Side Column 3 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Secure and Transparent Transactions.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Secure and Transparent Transactions</h3>
                <p>We prioritize the security of your transactions and personal information. Our platform employs cutting-edge security measures, and our transparent tracking system keeps you informed at every step of the journey.</p>
              </div>
            </div>
          </div>
        </div>
      </div>




      <div class="container mt-4 mb-4 bg-light"> <!-- Added bg-light class for the light gray background -->
        <div class="row">
          <!-- Left Side Column 1 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->

            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Earning Opportunities for Travelers.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Earning Opportunities for Travelers</h3>
                <p>Traveling becomes more rewarding than ever. Travelers can earn extra income by carrying items requested by shoppers during their trips. It's a win-win situation that turns your travel plans into profitable ventures.</p>
              </div>
            </div>
          </div>

          <!-- Middle Column 2 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Reliable Travelers, Trusted Deliveries.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Reliable Travelers, Trusted Deliveries</h3>
                <p>We take trust seriously. Our rigorous verification process ensures that travelers and shoppers on our platform are reliable and trustworthy. Rest assured that your items are in safe hands from pick-up to delivery.</p>
              </div>
            </div>
          </div>

          <!-- Right Side Column 3 -->
          <div class="col-md-4 mb-4"> <!-- Added mb-4 for margin-bottom -->
            <div class="p-4 rounded-lg h-100 bgColor-t"> <!-- Added h-100 to make all columns equal in height -->
              <div class="text-center"> <!-- Center align the content -->
                <div class="services-img mb-3">
                  <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Seamless Global Connectivity.png" alt="">
                </div>
                <h3 class="mb-3 headCust2">Seamless Global Connectivity</h3>
                <p>Our platform bridges the gap between travelers and shoppers worldwide. With a vast network of users spanning across countries, we offer an unmatched global reach for your shipping and needs.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- whybuyforme area end -->

<div class="container-fluid">
  <div id="work-sec">
    <h2 class="work-tag">How do we work?</h2>
    <div class="container-lg row">
      <div class="col col-md-6 shopper">
        <h3>Shopper</h3>
        <p class="sub-title">Receive items from all around the world.</p>
        <div class="upload-item">
          <div class="upload-se-item">1&nbsp;&nbsp;<span>Upload your selected item</span></div>
          <p>Add the URL link of the product and order details.</p>
        </div>
        <div class="get-traveler">
          <div class="upload-se-item">2&nbsp;&nbsp;<span>Get assigned a Traveler</span></div>
          <p>Travelers will make offers and you can chose one
            by reviewing them and contacting them.
          </p>
        </div>
        <div class="pay-product">
          <div class="upload-se-item">3&nbsp;&nbsp;<span>Pay and receive your product</span></div>
          <p>
            Choose your traveler and pay for the agreed price.
            Track the item and receive your desired product.
          </p>
        </div>
      </div>
      <div class="col col-md-6 travelar">
        <h3>Traveler</h3>
        <p class="sub-title">Turn your journey into Money.</p>
        <div class="upload-trip">
          <div class="upload-se-item">1&nbsp;&nbsp;<span>Upload your Trip Details</span></div>
          <p>Add the URL link of the product and order details.</p>
        </div>
        <div class="collect-item">
          <div class="upload-se-item">2&nbsp;&nbsp;<span>Collect the item</span></div>
          <p>Travelers will make offers and you can chose one
            by reviewing them and contacting them.
          </p>
        </div>
        <div class="receive-payment">
          <div class="upload-se-item">3&nbsp;&nbsp;<span>Receive your payment</span></div>
          <p>
            Choose your traveler and pay for the agreed price.
            Track the item and receive your desired product.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- testimonials area start -->
<!-- <div class="testimonials-area  pt-15 pb-50 wishlist bg-img" style="background-image: url(public/frontend/custom/img/47.jpg)">
    
    <div class="container">
        <h1 class="custom-heading">Our Testimonials</h1>
        <p style="text-align: center;">Real Stories from Our Community</p>
            <div class="testimonials-active owl-carousel">
                <div class="fruits-single-testimonial text-center">
                    <img alt="" src="assets/img/team/1.png">
                    
                    <p>I was skeptical about the concept initially, but Buy4Me exceeded my expectations. The website is well-designed, and the entire process is so straightforward. I've recommended it to friends already! </p>
                    <div class="client-name">
                        <span class="client-name-bright">Rachel B/</span>
                        <span>UIUX DEsigner</span>
                    </div>
                    <div class="fruits-ratting">
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                    </div>
                </div>
                <div class="fruits-single-testimonial text-center">
                    <img alt="" src="assets/img/team/1.png">
                    <p>As a fashion enthusiast, I often find unique pieces online that aren't available in my country. Buy4Me made it simple to get those pieces delivered right to my door. I'm thrilled with the service! </p>
                    <div class="client-name">
                        <span class="client-name-bright">Mia L /</span>
                        <span>UIUX DEsigner</span>
                    </div>
                    <div class="fruits-ratting">
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                    </div>
                </div>
                <div class="fruits-single-testimonial text-center">
                    <img alt="" src="assets/img/team/1.png">
                    <p>Buy4Me is a game-changer in the shipping industry. It's the future of cross-border shopping and travel. The platform's transparency and user-friendliness are remarkable. </p>
                    <div class="client-name">
                        <span class="client-name-bright">David W /</span>
                        <span>UIUX DEsigner</span>
                    </div>
                    <div class="fruits-ratting">
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                        <i class="icofont icofont-star yellow"></i>
                    </div>
                </div>
            </div>
        </div>




    </div> -->

<!-- testimonials area end -->
<div class="food-menu-area bg-img pt-110">
  <div class="services-area wrapper-padding-4 gray-bg pt-0 pb-6">
    <div class="container-fluid containerBox1">
      <div class="section-title-6 text-center mb-50">
        <h1 class="custom-headingX1">Testimonials</h1>
        <h1 class="custom-heading">Our Shoppers and Travelers</h1>
      </div>
      <div class="container mt-4 mb-4 custM34">
        <div class="row">
          <div class="col-md-4">
            <div class="testimonial-box d-flex flex-column align-items-center">
              <div class="testimonial-image text-center">
                <img src="https://m.media-amazon.com/images/I/41NYfAbBY2L._SX300_SY300_QL70_FMwebp_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 200px;">
              </div>
              <div class="testimonial-text">
                <!-- <h3>Testimonial 1</h3> -->
                <p>Deliver the product safely and receive the payment as discussed with the shopper. Deliver the product safely and receive the payment as discussed with the shopper.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="testimonial-box d-flex flex-column align-items-center">
              <div class="testimonial-image text-center">
                <img src="https://m.media-amazon.com/images/I/71PfyTreJIL._SX679_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 200px;">
              </div>
              <div class="testimonial-text">
                <!-- <h3>Testimonial 2</h3> -->
                <p>Deliver the product safely and receive the payment as discussed with the shopper. Deliver the product safely and receive the payment as discussed with the shopper.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="testimonial-box d-flex flex-column align-items-center">
              <div class="testimonial-image text-center">
                <!-- <img src="https://via.placeholder.com/150" alt="Testimonial Image" class="img-fluid" style="max-height: 200px;"> -->
                <img src="https://m.media-amazon.com/images/I/61iL8dZRFkL._SX679_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 200px;">

              </div>
              <div class="testimonial-text">
                <!-- <h3>Testimonial 3</h3> -->
                <p>Deliver the product safely and receive the payment as discussed with the shopper. Deliver the product safely and receive the payment as discussed with the shopper.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>












<!-- <div class="faq container-lg">
  <div class="row">
  <div class="col-md-2 faq-txt">FAQ</div>
    <div class="col-md-5">
      <div class="faq-part-1">
        <div class="accordion" id="accordionExample" style="62%;">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What is Buy4Me?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Buy4Me is a platform that connects shoppers with travelers. Shoppers can request 
                        travelers to purchase and deliver items from one country to another during their trips, 
                        while travelers can earn money by fulfilling these requests. Buy4Me emphasizes safety, 
                        trust, and cost-effective global shipping.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How do I sign up for Buy4Me? 
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            <li>Visit the Buy4Me website</li>
                            <li>Click on the "Sign Up" or "Register" button.</li>
                            <li>Fill out the required information, including your personal details and email address.</li>
                            <li>Follow the on-screen instructions to complete the registration process</li>
                            <li>Once registered, you can log in and start using Buy4Me as a shopper or traveler.</li>
                        </ul>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How do I place an order as a shopper? 
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <ul>
                        <li>Step 1: Go to the shopper’s page on the website.</li>
                        <li>Step 2: Add the details of your selected item, either by providing a URL link or manually 
                            entering order details
                        </li>
                        <li>Step 3: Connect with Travelers who have trips that fit your needs. Review traveler 
                            profiles and agree on the final price and choose the best traveler for you
                        </li>
                        <li>Step 4: Pay for the travel offer, track the item, and receive your desired product</li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="faq-part-2">
        <div class="accordion" id="accordionExample" style="62%;">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button partH2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How do I choose a traveler for my order? 
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <ul>
                        <li>Step 1: Go to the traveler’s page on the website.</li>
                        <li>Step 2: Upload your trip details, including travel dates and destinations. Browse 
                            available orders for your trip.
                        </li>
                        <li>Step 3: Choose an order, make an offer, and confirm order details</li>
                        <li>Step 4: Collect the item before your journey starts</li>
                        <li>Step 5: Safely deliver the product and receive payment as agreed with the shopper</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed partH2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What payment methods are accepted? 
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                       <ul>
                        <li>All payments to and from Buy4Me are secured through third-party gateway 
                            services provided by Stripe
                        </li>
                        <li>
                            Shoppers can choose to pay through their net banking, credit cards or debit cards
                        </li>
                        <li>
                            Post completion of orders, travelers can get paid directly to the bank account provided 
                            by them at the time of registration
                        </li>
                       </ul>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed partH2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How does Buy4Me ensure reliability? 
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>We take trust seriously. Our rigorous verification process ensures that travelers and 
                        shoppers on our platform are reliable and trustworthy. Rest assured that your items are 
                        in safe hands from pick-up to delivery.</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- accordian-code-start -->
<div class="container-lg">
  <div class="row">
    <div class="col-md-2 faq-txt">
      <h1 class="custom-heading">FAQ</h1>
    </div>

    <div class="col-md-5">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              What is Buy4Me?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Buy4Me is a platform that connects shoppers with travelers. Shoppers can request travelers to purchase and deliver items from one country to another during their trips, while travelers can earn money by fulfilling these requests. Buy4Me emphasizes safety, trust, and cost-effective global shipping.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              How do I sign up for Buy4Me?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul>
                <li>Visit the Buy4Me website</li>
                <li>Click on the "Sign Up" or "Register" button.</li>
                <li>Fill out the required information, including your personal details and email address.</li>
                <li>Follow the on-screen instructions to complete the registration process</li>
                <li>Once registered, you can log in and start using Buy4Me as a shopper or traveler.</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              How do I place an order as a shopper?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul>
                <li>Step 1: Go to the shopper’s page on the website.</li>
                <li>Step 2: Add the details of your selected item, either by providing a URL link or manually entering order details.</li>
                <li>Step 3: Connect with Travelers who have trips that fit your needs. Review traveler profiles and agree on the final price and choose the best traveler for you.</li>
                <li>Step 4: Pay for the travel offer, track the item, and receive your desired product.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
              How do I choose a traveler for my order?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul>
                <li>Step 1: Go to the traveler’s page on the website.</li>
                <li>Step 2: Upload your trip details, including travel dates and destinations. Browse available orders for your trip.</li>
                <li>Step 3: Choose an order, make an offer, and confirm order details.</li>
                <li>Step 4: Collect the item before your journey starts.</li>
                <li>Step 5: Safely deliver the product and receive payment as agreed with the shopper.</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              What payment methods are accepted?
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul>
                <li>All payments to and from Buy4Me are secured through third-party gateway services provided by Stripe.</li>
                <li>Shoppers can choose to pay through their net banking, credit cards, or debit cards.</li>
                <li>Post completion of orders, travelers can get paid directly to the bank account provided by them at the time of registration.</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingSix">
            <button class="accordion-button collapsed accordianPadding" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              How does Buy4Me ensure reliability?
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse accordianPadding" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              We take trust seriously. Our rigorous verification process ensures that travelers and shoppers on our platform are reliable and trustworthy. Rest assured that your items are in safe hands from pick-up to delivery.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- accordian code end -->



<div class="food-menu-area bg-img pt-110">
  <div class="services-area wrapper-padding-4 gray-bg pt-15 pb-60">
    <div class="container-fluid containerBox2">
      <div class="food-menu-area bg-img pt-110">
        <div class="services-area wrapper-padding-4  pt-15 pb-60">
          <div class=" containerBox2">
            <div class="container">
              <h1 class="text-center mb-4 buy4meText">What makes <span class="buy4meColor">BUY4Me</span> Special?</h1>
              <div class="row">
                <!-- Card 1 -->
                <div class="col-12 col-md-4 mb-4">
                  <div class="text-center card-div">
                    <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Faster, Cost-Effective Shipping.png" alt="" class="img-fluid">
                    <h2 class="headCust2">SAVE YOUR MONEY</h2>
                    <p class="paraText">Want something from another country? Don't worry, you can order from anywhere and not worry about the shipping charges.</p>
                  </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-4 mb-4">
                  <div class="text-center card-div">
                    <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Faster, Cost-Effective Shipping.png" alt="" class="img-fluid">
                    <h2 class="headCust2">MAKE MONEY TRAVELLING</h2>
                    <p class="paraText">Deliver a product of your convenience and earn money.You will be able to cover all your travel expenses.</p>
                  </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-4 mb-4">
                  <div class="text-center card-div">
                    <img src="{{URL::to('/')}}/public/frontend/custom/img/icon-img/Faster, Cost-Effective Shipping.png" alt="" class="img-fluid">
                    <h2 class="headCust2">SAFETY FOR EVERYONE</h2>
                    <p class="paraText">100% verification of both the users.</p>
                    <p class="paraText">100% transparency of both the users.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
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