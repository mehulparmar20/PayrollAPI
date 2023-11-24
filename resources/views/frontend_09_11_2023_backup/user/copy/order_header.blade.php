   <!-- not used this blade-->
   <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">
              <div class="StatusXX"><a class="active menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab">
                      All Orders ({{$reCount}})
                      
                    </a></div>

                    <div class="StatusXX"><a class=" menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab">
                      Order Request
                    </a></div>

                     <div class="StatusXX"><a class=" menuHeader tab-link" href="#matchTrip_requested" data-bs-toggle="tab" role="tab">
                      Counter Orders({{$counterOffercount}})
                    </a></div> 
                    <div class="StatusXX">
                    <!--<a class="active menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab" aria-selected="true">  -->
                    <!--        Counter Orders({{$reCount}}) -->
                    <!--    </a>-->
                    <!--</div>-->

                  

              <div class="StatusXX"><a class="menuHeader tab-link" href="#order_inTransit" data-bs-toggle="tab" role="tab">
                        In Transit ({{$intrailcoun}})
                    </a></div>
                       <div class="StatusXX"><a class="menuHeader tab-link" href="#order_received" data-bs-toggle="tab" role="tab">
                        Received ({{$receviedc}})
                    </a></div>
              <div class="StatusXX"><a class="menuHeader tab-link" href="#order_inactive" data-bs-toggle="tab" role="tab">
                        Canceled ({{$inaCount}})
                    </a></div>
                 <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">
               <a class="menu-custbtn" href="{{route('user.create_order')}}">Add Order</a>
           </div>
        </div>
        </div>
        
        <!--   <div class="section-title-3 text-center mb-15 custmizeMargin" role="tablist">-->
        <!--      <div class="StatusXX"><a class="active menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab">-->
        <!--              All Orders({{$reCount}})-->
                      
        <!--            </a></div>-->

        <!--            <div class="StatusXX"><a class="active menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab">-->
        <!--              Order Request-->
        <!--            </a></div>-->

        <!--             <div class="StatusXX"><a class="active menuHeader tab-link" href="#matchTrip_requested" data-bs-toggle="tab" role="tab">-->
        <!--              Counter Orders({{$reCount}})-->
        <!--            </a></div> -->
        <!--            <div class="StatusXX">-->
        <!--            <a class="active menuHeader tab-link" href="#order_requested" data-bs-toggle="tab" role="tab" aria-selected="true">  -->
        <!--                    Counter Orders({{$reCount}}) -->
        <!--                </a>-->
        <!--            </div>-->

                  

        <!--      <div class="StatusXX"><a class="menuHeader tab-link" href="#order_inTransit" data-bs-toggle="tab" role="tab">-->
        <!--                In Transit ({{$intrailcoun}})-->
        <!--            </a></div>-->
        <!--               <div class="StatusXX"><a class="menuHeader tab-link" href="#order_received" data-bs-toggle="tab" role="tab">-->
        <!--                Received ({{$receviedc}})-->
        <!--            </a></div>-->
        <!--      <div class="StatusXX"><a class="menuHeader tab-link" href="#order_inactive" data-bs-toggle="tab" role="tab">-->
        <!--                Canceled ({{$inaCount}})-->
        <!--            </a></div>-->
        <!--         <div class="menu-custbtn-area text-center mt-1" style="display: inline-block;">-->
        <!--       <a class="menu-custbtn" href="{{route('user.create_order')}}">Add Order</a>-->
        <!--   </div>-->
        <!--</div>-->
        