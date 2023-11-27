@include('frontend.includes.header')
<body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
        <div class="pl-100 pr-100">
            <div class="container-fluid">
                <div class="section-title-3 text-center mb-40">
                    <!-- <h2>Create Order</h2> -->
                    <div class="menu-btnX-area text-center mt-1" style="display: inline-block; color:white;">
        <a class="menu-btnX btn-hover" href="#">Create Order</a>
    </div>
                </div>
                <!-- <form action="{{route('user.order_product')}}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-input-style mb-30">
                                <label>Product Name</label>
                                <input type="hidden" name="from" value="request">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input name="product_name" required="" type="text" placeholder="Enter Product Name" value="{{$data->product_name}}">
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Product Img</label>
                                <input name="file[]"  type="file" multiple>
                                <?php
                                    $img=$data->product_imgs;
                                    $img=explode(' , ', $img);
                                ?>
                                <div>
                                    @foreach($img as $i)
                                        <?php 
                                            $i=str_replace([']','[']," " ,$i);
                                            $i=trim($i);
                                        ?>
                                        <img src="{{URL::to('/')}}/public/upload/product_img/{{$i}}" width="50px" height="50px;">
                                    @endforeach
                                </div>
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Product price</label>
                                <input name="product_price" required="" type="text" placeholder="Enter Product price" value="{{$data->product_price}}">
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Product qty</label>
                                <input name="product_qty" required="" type="number" placeholder="Enter Product qty" value="{{$data->product_qty}}">
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Product details</label>
                                <textarea name="product_details" required="">{{$data->product_details}}</textarea>
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>With Box</label>
                                <input name="box" type="checkbox"  value="{{$data->box}}" >
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Delivery route</label>
                                <select class="form-select single-select-field " data-placeholder="Choose one thing" name="deliver_from" onchange="getState(this.value,'devliver_fromOrder')">
                                    @foreach($country as $r)
                                        <option <?php if($data->deliver_from_country==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Delivery to</label>
                                <select class="form-select single-select-field " data-placeholder="Choose one thing" name="deliver_to" onchange="getState(this.value,'devliver_ToOrder')">
                                    @foreach($country as $r)
                                        <option <?php if($data->deliver_to_country==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>Delivery To City</label>
                                <select class="form-select single-select-field " data-placeholder="Choose one thing" name="deliver_toOrderCity" id="deliver_toOrderCity">
                                    @foreach($state_to as $r)
                                        <option <?php if($data->deliver_to_state==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="contact-input-style mb-30">
                                <label>How long are you willing to wait?</label>
                                <input name="during_date"  type="date"  min="<?php echo date('Y-m-d'); ?>"  value="<?php echo date('Y-m-d',strtotime($data["during_time"])) ?>" >
                               
                                <button type="submit">create order</button>
                            </div>
                        </div>
                    </div>
                </form> -->


                <form action="{{ route('user.update_order') }}" method="post" enctype="multipart/form-data" class="formXa">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="product_name" class="form-label labelX">Product Name</label>
                <input type="hidden" name="id" value="{{$data->id}}">
                <input name="product_name" required="" type="text" class="form-control textFx" id="product_name" placeholder="Enter Product Name" value="{{$data->product_name}}">
            </div>

            <div class="mb-3">
                <label for="product_img" class="form-label labelX">Product Img</label>
                <input name="product_img[]" type="file" multiple class="form-control-file" id="product_img" style="padding: 4px;">
                

                <?php
                    $img = $data->product_imgs;
                    $img = explode(' , ', $img);
                ?>
                <div class="mt-2">
                    @foreach($img as $i)
                        <?php 
                            $i = str_replace([']','[']," " ,$i);
                            $i = trim($i);
                        ?>
                        <div class="product-img-2cXV">
                        <a href="#">
                        <img src="{{ URL::to('/') }}/public/upload/product_img/{{ $i }}">
                            </a>
                       </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label labelX">Product Price</label>
                <input name="product_price" required="" type="text" class="form-control textFx" id="product_price" placeholder="Enter Product Price" value="{{$data->product_price}}">
            </div>

            <div class="mb-3">
                <label for="product_qty" class="form-label labelX">Product Quantity</label>
                <input name="product_qty" required="" type="number" class="form-control textFx" id="product_qty" placeholder="Enter Product Quantity" value="{{$data->product_qty}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="labelX">With Box</label>
                <input name="box" type="checkbox" class="checkX" id="update_product_box" value="{{$data->box}}" style="">
            </div>
            <div class="mb-3">
                <label for="deliver_from" class="form-label labelX">Delivery Route</label>
                <select class="form-select textFx" data-placeholder="Choose one thing" name="deliver_from" id="deliver_from" onchange="getState(this.value,'devliver_fromOrder')">
                    @foreach($country as $r)
                        <option <?php if($data->deliver_from_country==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="deliver_to" class="form-label labelX">Delivery To</label>
                <select class="form-select textFx" data-placeholder="Choose one thing" name="deliver_to" id="deliver_to" onchange="getState(this.value,'devliver_ToOrder')">
                    @foreach($country as $r)
                        <option <?php if($data->deliver_to_country==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="deliver_toOrderCity" class="form-label labelX">Delivery To City</label>
                <select class="form-select textFx" data-placeholder="Choose one thing" name="deliver_toOrderCity" id="deliver_toOrderCity">
                    @foreach($state_to as $r)
                        <option <?php if($data->deliver_to_state==$r->id){ echo "selected"; } ?> value="{{$r->id}}">{{$r->city_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="during_date" class="form-label labelX">How long are you willing to wait?</label>
                <input name="during_date" type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control textFx" value="<?php echo date('Y-m-d',strtotime($data["during_time"])) ?>">
            </div>
            <div class="mb-3">
                <label for="product_details" class="form-label labelX">Product Details</label>
                <textarea name="product_details" required="" class="form-control textFx heightArea" id="product_details">{{$data->product_details}}</textarea>
            </div>
        </div>
    </div>
    <div class="mb-3">
                <div class="menu-btnX-area text-center mt-1" >
                <button  type="submit" class="menu-btnX btn-hover" style="border:none">Create Order</button>
            </div>
            </div>
</form>
            </div>
        </div>
    </div>
  <!-- menu area end -->
  @include('frontend.includes.footer')
  <!-- all js here -->
  @include('frontend.includes.footer_script')
</body>
</html>

    <!-- menu area end -->
    @include('frontend.includes.footer');
    <!-- all js here -->
    @include('frontend.includes.footer_script');
</body>
</html>
