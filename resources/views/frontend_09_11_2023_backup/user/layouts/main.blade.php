  
 
 
  @include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
    <!-- header end -->
    <div class="best-product-area pb-15">
        <div class="pl-10">
            <!-- pl-100 pr-100 -->
        
            <!-- Dipali code start here -->
            <div class="container-fluid">
        
                @yield('pages')

            </div>
            </div>
        <!-- menu area end -->
	    @include('frontend.includes.footer')
		<!-- all js here -->
     @include('frontend.includes.footer_script')
    </body>
</html>
