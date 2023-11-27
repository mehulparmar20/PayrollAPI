@include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
      <div class="pl-100 pr-100">
        <div class="container-fluid">
              <div class="section-title-3 text-center mb-40">
                <h4>Orders
                </h4>
              </div>
              <div class="best-product-style">
                <div class="tab-content">
                    <div>
                        <div class="custom-row">
                            <div class="custom-col-12 custom-col-style mb-95">
                                @foreach($data as $row)
                               
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="product-img-2">
                                                <a href="#">
                                                    <img src="https://b4m.veravalonline.com/b4m/public/upload/product_img/{{$i}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div >
                                                <h4><a href="#">{{$row->product_name}}</a></h4>
                                                <span>{{$row->fromCountry}} 
                                                    <i class="ti-arrow-right"></i> {{$row->toCountry}} {{$row->toCIty}} , by  &nbsp; &nbsp; {{date('F d, y',strtotime($row->during_time)); }}</span>
                                                @if($row->box==0)
                                                    <p> Without Box</p>
                                                @else
                                                    <p> With Box</p>
                                                @endif
                                                <div class="product-rating">
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star black"></i>
                                                    <i class="ti-star"></i>
                                                    <i class="ti-star"></i>
                                                </div>
                                                <div class="details-price">
                                                    <span>Product Price</span> :-<span >${{$row->product_price}}</span>
                                                  
                                                </div>
                                                <a class="btn btn-outline-secondary px-4" href="{{route('travel.create_offer',['id'=>$row->id])}}">Make Delivery Offer</a>
                                            </div>
                                        </div>
                                        <hr style="border-bottom: 1px solid #000; padding-top:5px">
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
        <!-- menu area end -->
	    @include('frontend.includes.footer');
		<!-- all js here -->
     @include('frontend.includes.footer_script');
    </body>
</html>
