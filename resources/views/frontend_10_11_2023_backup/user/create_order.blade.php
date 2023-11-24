
@include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
      <!-- header end -->
      <!-- <div id="display"></div> -->
      

   
 


      
    
<!-- <div class="cover" style="background: url('public/frontend/custom/img/Banner Final - 1.jpg') no-repeat center center;">
    <div class="cover-content">
        <h1 class="cover-header">Fuga Maiores</h1>
        <p class="cover-tagline">Sint pariatur, dolorum impedit dignissimos asperiores quidem doloribus alias?</p>
    </div>
</div> -->


<!-- <div class="food-menu-area bg-img">
  <div class="services-area wrapper-padding-4  pb-60">
    <div class="container-fluid containerBox3">
       <div class="food-menu-area bg-img pt-110">
         <div class="services-area wrapper-padding-4  pt-15 pb-60">
           
            <div class="container">
             <h1 class="text-center mb-4 buy4meText">What makes <span class="buy4meColor">BUY4Me</span> Special?</h1>
             
                 
          </div>
        </div>
      </div>
      </div>
   </div>             
</div> -->
<div class="food-menu-area bg-img">
    <div class="services-area wrapper-padding-4 pb-0">
        <div class="container-fluid containerBox3">
            <div class="food-menu-area bg-img pt-110">
                <div class="services-area wrapper-padding-4 pt-15 pb-60">
                  
                    <div class="container">
                        <div class="row">
                        <div class="team-area bg-img pt-115 pb-90">
                        <!-- <h2 class="h2X1">Shop products from USA and <span style="color:#ffc300">save up to 40%</span></h2> -->
                        <h2 class="h2X1">Shop products from USA and save up to 40% </h2>
            
            <form action="{{route('user.product_details')}}" method="get" class="formXS">
            @csrf
            <div class="container searchdiv pt-50">
                <div class="row">
                    <div class="col-md-10">  
                        <input type="url" placeholder="Place the URL of the Product or Create Your own Order"  class="form-control searchclass" name="url" id="fromduct_from_url"> 
                    </div>      
                    <div class="col-md-2">  
                  <!-- <div class="menu-btnX-area text-center mt-1" >
                <button  type="submit" class="menu-btnX btn-hover" style="border:none;width: 165px;">Create Order</button>
            </div> -->
            <div class="menu-custbtn-area text-center mt-1" >
                <button  type="submit" class="menu-custbtn" style="border:none;width: 165px;">Create Order</button>
            </div>

                    </div>   
                </div>
            </div>
         
            <br>
        </form>
        </div>
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




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





        <!-- sectionA start here -->
        
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
                    <h3 class="mb-3 headCust2">Reliable Travelers, Trusted Deliveries</h3>
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
                    <h3 class="mb-3 headCust2">Faster, Cost-Effective Shipping</h3>
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
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>   
    </div>
        <!-- sectionA end here -->


        

   

<!--       
       <div class="centerhome">
        <div class="header">
	        <h2 class="h2X1">Shop products from USA and <span style="color:#ffc300">save up to 40%</span></h2>
	    </div>   
        <form action="{{route('user.product_details')}}" method="get" class="formXS">
            @csrf
            <div class="container searchdiv pt-50">
                <div class="row">
                    <div class="col-md-10">  
                        <input type="url" placeholder="Paste the URL of the Product"  class="form-control searchclass" name="url" id="fromduct_from_url"> 
                    </div>      
                    <div class="col-md-2">  
                  <div class="menu-btnX-area text-center mt-1" >
                <button  type="submit" class="menu-btnX btn-hover" style="border:none">Create Order</button>
            </div>

                    </div>   
                </div>
            </div>
         
            <br>
        </form> -->

    
        

        



          
        <!-- Trending products area start -->
        <div class="food-menu-area bg-img pt-110 pb-10" style="margin: 35px;">
            <div class="container-fluid">
                <div class="section-title-10 text-center mb-20">
                    
                    <h3 style="font-weight: bold;">Trending Transaction on Buy4Me</h3>
                </div>
                <div class="food-menu-product-style">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="menu1" role="tabpanel">
                         
            <!-- <div class="row">
                               <div class="col-lg-12">
                        <div class="menu-product-wrapper row">
                     @foreach($latestProduct as $row)
                                            <?php
                                                $img=$row->product_imgs;
                                                $img=explode(' , ', $img);
                                                foreach($img as $i)
                                                {
                                                    $i=$i;
                                                }
                                                $i=str_replace([']','[']," " ,$i);
                                                $i=trim($i);
                                            ?>  
                <div class="col-md-2 mb-3">
                    <a href="{{route('user.order_details',['id'=>$row->id])}}">
                        <div class="card">
                            <div class="product-img-2cX">
                        <a href="#">
                         <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="">
                            </a>
                       </div>
                            <div class="card-body custMr">
                                <h4 class="card-title"><a href="#"><span class="productN">{{$row->product_name}}</span></a></h4>
                                <div class="menu-product-price-rating">
                                <div class="row">
                                    <div class="">
                                      <div class="price-container">
                                         <span class="menu-product-old">${{$row->product_price}}</span>
                                         <span class="menu-product-new">${{$row->product_price}}</span>
                                     </div>
                                     </div>
                                    </div>
                                </div> 
         

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
           </div> -->


<div class="row">
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

<div class="col-md-3">
            <a href="{{route('user.order_details',['id'=>$row->id])}}">
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
            </a>
                 </div>
              @if($loop->iteration % 4 == 0)
              </div> 
             <div class="row"> 
        @endif
    @endforeach
</div>





                   </div>
         </div>

                        </div>
        </div>






  





























                   
                    <!-- <div class="menu-btnX-area text-center mt-1" >
                <button  type="button" class="menu-btnX" style="border:none">Buy Product</button>
            </div> -->
            <div class="menu-custbtn-area text-center mt-1" >
                <button  type="button" class="menu-custbtn" style="border:none;width: 165px;">Buy Product</button>
            </div>
                </div>
            </div>
        </div>


        










<!-- popular section start here -->

<div class="container">
          <h2 class="headingPopular">POPULAR CATEGORIES</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/41LVp3iGClL.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px; padding-top: 6px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>SalLady Faux Rose</p>
                      </div>
            </div>
           
           </div>
        <div class="col-md-3">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/41R1-B6-bnS._SY300_SX300_QL70_FMwebp_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px; padding-top: 6px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Red rose</p>
                      </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/41g77wcwocL._SX300_SY300_QL70_FMwebp_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px; padding-top: 6px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Yellow rose</p>
                      </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="testimonial-box2 d-flex flex-column align-items-center">
                      <div class="testimonial-image2 text-center">
                        <img src="https://m.media-amazon.com/images/I/71-6lx+ivuL._AC_UL480_FMwebp_QL65_.jpg" alt="Testimonial Image" class="img-fluid" style="max-height: 170px; padding-bottom: 10px; padding-top: 6px;">
                      </div>
                      <div class="testimonial-text2">
                        <p>Pink rose</p>
                      </div>
            </div>
        </div>
    </div>
</div>
<!-- popular section end here -->





        























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



    <!-- FAQ CODE START HERE -->
    <div class="container-lg pt-20 pb-30 mt-20 mb-10">
  <div class="row">
    <div class="col-md-2 faq-txt"><h1 class="custom-heading">FAQ</h1></div>
    
    <div class="col-md-5">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
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
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
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
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
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
      












        <!-- middle area  -->
        <!-- <div class="team-area bg-img pt-115 pb-90" style="background-color: #e5e1f4">
            <h5 style="text-align:center;">Go to any online store and copy and paste the URL of the product you would like from abroad.</h5>
            <form action="{{route('user.product_details')}}" method="get" class="pt-20">
                @csrf
                <div class="container searchdiv">
    <div class="row">
        <div class="col-md-10">  
            <input type="url" placeholder="Paste the URL of the Product" class="form-control searchclass" name="url" id="fromduct_from_url" required> 
        </div>
        <div class="col-md-2">
            <div class="menu-btnX-area text-center mt-1" >
                <button  type="submit" class="menu-btnX btn-hover" style="border:none">Create Order</button>
            </div>
        </div>
    </div>
</div>
</div>
                <br>
            </form>
        </div> -->







        <!-- our shopes section -->
        <div class="food-menu-area bg-img pt-115 pb-90" style="background-image: url(public/frontend/assets/img/bg/13.jpg)">
            <div class="container">
                <div class="food-menu-product-style">
                    <div class="food-menu-list text-center mb-65 nav" role="tablist">
                        <a class="active" href="#menu1" data-bs-toggle="tab" role="tab">
                            <h3>Top shops</h3>                          
                        </a>
                    </div>
                    <div class="container-fluid">
                        <div class="top-product-style">
                            <div class="tab-content">
                                <div class="tab-pane active show fade" id="electro1" role="tabpanel">
                                    <div class="custom-row-2">
                                        @foreach($topShop as $row)
                                            <div class="custom-col-style-2 custom-col-4">
                                                <div class="product-wrapper product-border mb-24">
                                                    <div class="product-img-3x">
                                                        <a href="{{$row->url}}" target="_blank">
                                                            <img src="{{URL::to('/')}}/public/upload/top_shops/logo/{{$row->logo}}">
                                                        </a>
                                                    </div>
                                                    <div class="product-content-4 text-center">
                                                        <h4><a href="{{$row->url}}" target="_blank">{{$row->name}}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end shope section  -->
        <!-- menu area end -->


        




	    @include('frontend.includes.footer')
		<!-- all js here -->
        @include('frontend.includes.footer_script')
       </div>


      
         
     
     
    </body>
</html>
