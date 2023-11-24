  
 
 
  @include('frontend.includes.header')
  <body>
    @include('frontend.includes.nav')
    
        
                @yield('pages')

           
        <!-- menu area end -->
	    @include('frontend.includes.footer')
		<!-- all js here -->
     @include('frontend.includes.footer_script')
    </body>
</html>
