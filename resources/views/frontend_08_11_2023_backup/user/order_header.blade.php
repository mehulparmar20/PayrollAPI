   <?php 
   $data = App\Models\Order::with('product','destination')
   ->select('orders.*','countries.name as origincountry')
   ->whereNull('deleted_at')
   ->where('buyer_id', '=', Auth::user()->id)
   ->join('countries', function ($join) {
       $join->on('countries.id', '=', 'orders.origin_country');
      
   })
   ->orderBy('updated_at','desc')
   ->get();
    $counterOffer = [];
    $AllOrders = count($data);
    //  dd($data);

    $general_query =  DB::table('matched_orders')
        ->select(
            'matched_orders.trip_id','matched_orders.status',
            'orders.deliverd_date', 'orders.currency', 'orders.quantity', 'orders.product_price','orders.traveller_reward',
            'products.product_name','products.image','products.currency','products.box',
            'c.name as origin_country',
            'states.country_id as state_country_id','states.city_name as destination_city',
            'countries.name as destination_c'
            )

        ->leftjoin('orders', 'matched_orders.order_id', '=', 'orders.id')
        ->leftjoin('products', 'orders.product_id', '=', 'products.id')
        ->leftjoin('countries as c', 'c.id', '=', 'orders.origin_country')
        ->leftjoin('states', 'states.id', '=', 'orders.destination_city')
        ->leftjoin('countries', 'countries.id', '=', 'states.country_id');
        // ->where('matched_orders.status', '=', '2');
    // $quewry=$general_quewry->where('matched_orders.buyer_id', '=',  Auth::user()->id)->whereNull('matched_orders.deleted_at')->where('matched_orders.status', '=', '2');
    // $quewry1=$general_quewry->where('matched_orders.buyer_id', '=',  Auth::user()->id)->whereNull('matched_orders.deleted_at')->where('matched_orders.status', '=', '3');

    // $Requested=$quewry->count();
    // $transit=$quewry1->count();
    $quewryRequested = clone $general_query; // Clone the query for the first count
    $quewryTransit = clone $general_query; // Clone the query for the second count

    $quewryRequested->where('matched_orders.buyer_id', '=',  Auth::user()->id)
        ->whereNull('matched_orders.deleted_at')
        ->where('matched_orders.status', '=', '2');

    $quewryTransit->where('matched_orders.buyer_id', '=',  Auth::user()->id)
        ->whereNull('matched_orders.deleted_at')
        ->where('matched_orders.status', '=', '3');

    $Requested = $quewryRequested->count();
    $transit = $quewryTransit->count();
    // dd($transit);
   ?>
   
   <div class="order-list tabs section-title-3 text-center mb-15 custmizeMargin" id="orders-links" role="tablist">
        <div class="StatusXX " > <a class=" menuHeader tab-link" href="{{route('shopper.orders')}}#all-orders" id="shoperAllOrder">
            All Orders({{$AllOrders}})</a>
        </div>
        <!--<div class="StatusXX"><a class="menuHeader tab-link" href="{{route('user.orders')}}#order_requested" id="order_requested">-->
        <!--  Order Request-->
        <!--</a></div>-->

        <div class="StatusXX"><a class=" menuHeader tab-link" href="{{route('shopper.Requested','Requested')}}#order_requested">
                    Requested({{$Requested}})
        </a></div> 
        <div class="StatusXX">
            <div class="StatusXX" ><a class="menuHeader tab-link" href="{{route('shopper.Requested','Transit')}}#order_requested">
                        Confirm The Order ({{$transit}})
            </a></div>
            <div class="StatusXX"><a class="menuHeader tab-link" href="{{route('shopper.orders')}}#order_received" >
                    Received (0)
            </a></div>
            <div class="StatusXX"><a class="menuHeader tab-link" href="{{route('shopper.orders')}}#order_inactive">
                    Canceled (0)
            </a></div>
            <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
                <a class="menu-custbtn" href="{{route('shopper.create-order')}}">Add Order</a>
            </div>
        </div>
    </div>
        
  
        <script>
            
            // $(document).ready(function(){
            //     var current = location.pathname;
              
               
            //   $('#orders-links div a').each(function(){
            //     var $this = $(this);
            //     // console.log($this.attr('href'));
            //     // if the current path is like this link, make it active
            //     if($this.attr('href').indexOf(current) !== -1){
            //         $this.addClass('active');
            //     }
            // })
            // });
            
             $(document).ready(function () {
        // Function to show/hide tab content based on the URL hash
            function showTabContent() {
                var hash = window.location.hash;
                
                $('.order-list a').removeClass('active');
                $('.order-list  a[href="' + hash + '"]').addClass('active');
                $('.tab-content').hide();
                $(hash + '-content').show();
            }

        // Handle initial tab based on the URL hash
        showTabContent();

        // Handle hash changes (e.g., when navigating from "order-details" page)
        $(window).on('hashchange', showTabContent);
        });
    
    
            
        </script>