@extends('layouts.app')

@section('pages')
 
    <div class="row traveller_slider" style="background-image: url({{URL::to('/')}}/public/frontend/custom/img/Web-Banners-1.jpg);height: 500px !important;"> 
      <div class="product-description-review-area pb-90s col-12">
        <div class="container" style="">
            <div class="food-slider-content fadeinup-animated-1">
           <!-- <div class="food-slider-content text-center fadeinup-animated-1"> -->
              <form action="{{route('traveller.create_trip')}}" method="post" class="container1">
                @csrf
                <h1></b>Travel to Earn</b></h1><p>Embark on Your Next Adventure!</p>
                <label>From*</label>
                <select class="form-select single-select-field browsers_country" data-placeholder="Choose one thing" name="origin_country" onchange="getState(this.value,'from_travel')" required>
                </select>
                
                
                <label>To*</label>
                <select class="form-select single-select-field browsers_country" data-placeholder="Choose one thing" name="destination_city" onchange="getState(this.value,'to_travel')" required>
                </select>

                <label>Select*</label>
                <select class="form-select single-select-field " data-placeholder="City" name="destination_city" id="travel_to_state" required>
                </select>
              
                <input type="date" name="travel_date"   class="form-control travel_date" placeholder="travel date" min="</?php echo date('Y-m-d'); ?>" required>
                <div id="trip_check_verify">
                  @if(Auth::check())
                    @if(Auth::user()->email_verified_at != Null)
                      <!-- <button type="submit" class="menu-btn1 btn-hover">Add Trip</button> -->
                      <div class="menu-custbtn-area text-center mt-1" >
                <button  type="submit" class="menu-custbtn" style="border:none">Add Trip1</button>
            </div>
                    @else
                      <!-- <button type="button" class="menu-btn1 btn-hover"> <a href="{{route('email_verify.auth',['email'=>Auth::user()->email])}}">Add Trip</a></button> -->
                      <div class="menu-btn-area text-center mt-40">
                        <a class="menu-btn btn-hover" href="{{route('email_verify.auth',['email'=>Auth::user()->email])}}" style="color:white!important">Add Trip</a>
                    </div>
                      @endif
                  @else
                    <!-- <button type="button" onclick="openLogin()" class="menu-btn1 btn-hover">Add Trip</button> -->

                    <div class="menu-btnX-area text-center mt-1" >
                <button type="button" class="menu-btnX btn-hover" onclick="openLogin()" style="border:none">Add Trip2</button>
            </div>
                  @endif
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>


    <!-- section2 start here -->
    <div class="container container-bg2x">
    <div class="row align-items-center">
         <div class="col-md-3 mb-3">
            <div class="d-flex align-items-center">
              <div class="circle">1</div>
               <div><p>Create your order</p></div>
            </div>
         </div>

         <div class="col-md-3 mb-3">
          <div class="d-flex align-items-center">
            <div class="circle">2</div>
             <div>
              <p class="mb-0">Choose and offer </p>
               <p class="mb-0">and confirm it</p>
             </div>
            </div>
         </div>
         

      <div class="col-md-3 mb-3">
       <div class="d-flex align-items-center">
          <div class="circle">3</div>
          <div>
            <p class="mb-0">Complete the</p>
            <p class="mb-0">secure payment</p>
          </div>
          </div>
       </div>


         <div class="col-md-3 mb-3">
        <div class="d-flex align-items-center">
          <div class="circle">4</div>
          <div><p>Recieve your order</p></div>
        </div>
      </div>

        

    </div>
   </div>
    </div>
</div>
    <!-- section2 end here -->




    <!-- section3 start here -->
    <div class="food-menu-area bg-img pt-110" style="background-image: url(assets/img/bg/13.jpg)">
        <div class="services-area wrapper-padding-4 gray-bg pt-30 pb-6">
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
                    <h3 class="mb-3 headCust2">Earning Opportunities for Travelers</h3>
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
                    <h3 class="mb-3 headCust2">Secure and Transparent Transactions</h3>
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
                    <h3 class="mb-3 headCust2">Dedicated Customer Support</h3>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>   
    </div>

    <!-- section3 end here -->



    

    <!-- secition4 start here -->
    
 <div class="testimonials-area  pt-20 pb-50 mt-20 mb-20 wishlist bg-img" style="background-image: url(public/frontend/custom/img/47.jpg)">
    
    <div class="container">
        <h1 class="custom-heading">Testimonials</h1>
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
    </div> 
    <!-- section4 end here -->


      <!-- FAQ CODE START HERE -->
      <div class="container-lg pt-20 pb-30 mt-20 mb-10">
  <div class="row">
    <div class="col-md-2 faq-txt"><h1 class="custom-heading">FAQ</h1></div>
    
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
          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              We take trust seriously. Our rigorous verification process ensures that travelers and shoppers on our platform are reliable and trustworthy. Rest assured that your items are in safe hands from pick-up to delivery.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- FAQ CODE END HERE -->







    







    <!-- menu area  -->
    <!-- <img src="{{URL::to('/')}}/public/frontend/assets/img/banner/11.png" alt=""> -->
    <!-- <div class="about-story pt-65 pb-55">
      <div class="container">
          <div class="row">
              <div class="col-lg-6">
                  <div class="story-img">
                      <img src="https://www.travelandleisure.com/thmb/K1kcxMhiJi4DOsKF6QM67cC7OY8=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/away-backpacks-lead-2000-e75d037fbf824b8684b55edd4bcaa207.jpg" alt="">
                      <div class="about-logo">
                          <h3>Buy4me</h3>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="story-details pl-50">
                      <div class="story-details-top">
                          <h2>WELCOME TO <span>Buy4me</span></h2>
                          <p>…wondering if you should try Grabr on your next trip? The answer is YES. Shoppers all came to my hotel lobby within two hours. Quick, easy, and fun. What a cool way to meet new people and earn some cash.</p>

                          <div class="menu-btn-area text-center mt-40">
                        <a class="menu-btn btn-hover" href="#">More Buy4me stories</a>
                    </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div> -->
    <!-- menu area end -->



    <!-- section start here -->

     <div class="about-story pt-30 pb-30">
      <div class="container">
          <div class="row">
              <div class="col-lg-6">
                  <div class="story-img">
                      <!-- <img src="{{URL::to('/')}}/public/frontend/assets/img/banner/11.png" alt=""> -->
                      <img src="https://www.travelandleisure.com/thmb/K1kcxMhiJi4DOsKF6QM67cC7OY8=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/away-backpacks-lead-2000-e75d037fbf824b8684b55edd4bcaa207.jpg" alt="">
                      <div class="about-logo">
                          <h3>Buy4me</h3>
                      </div>
                  </div>
              </div>
             
              <div class="col-lg-6">
    <div class="row">
        <div class="col-md-6">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/315+asqXYnL._SY300_SX300_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Suitcase</p>
                      </div>
            </div>
           
           </div>
        <div class="col-md-6">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/41PDym4CoDL._SY300_SX300_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Suitcase</p>
                      </div>
            </div>
        </div>
    </div>
    <div class="row mt-3"> <!-- Add mt-3 (margin-top) to create spacing -->
        <div class="col-md-6">
            <!-- <div class="yellow-box">
                <img src="product3.jpg" alt="Product 3">
            </div> -->
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/61wq2iGSLDL._UX679_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Bag</p>
                      </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- <div class="yellow-box">
                <img src="product4.jpg" alt="Product 4">
            </div> -->
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/41DMYZcvOcL._SY300_SX300_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Bag</p>
                      </div>
            </div>
        </div>
    </div>
</div>


          </div>
      </div>
    </div>
    <!-- section end here -->



























      <!-- blog area start -->
      <div class="blog-area pt-10 pb-80">
        <div class="container">
            <div class="section-title-3 text-center mb-50">
                <h2>Popular Destinations</h2>
            </div>
            <div class="row">
              
              @foreach($popurlDe as $row)
                <div class="col-md-3">
                    <div class="blog-wrapper mb-40">
                      <p>{{$row->country_name}}</p>
                      <p>{{$row->total_order}} orders</p>
                        <div class="blog-img blog-hover mb-15">
                            <a href="#"><img src="{{URL::to('/')}}/public/upload/country_flag/{{$row->flag}}" alt=""></a>
                        </div>
                        <div class="blog-info">
                            <h4><a href="{{route('make_offer_html',['id'=>$row->counrty_id])}}">Add trip</a></h4>
                            <span>${{$row->product_price}}</span>
                        </div>
                    </div>
                </div>
              @endforeach               
            </div>
        </div>
    </div>
  
@endsection