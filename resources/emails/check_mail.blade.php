@include('frontend.includes.header')
    <body>
    @include('frontend.includes.nav')
        <!-- header end -->
        <!-- testimonials area start -->
        <div class="testimonials-area pt-120 pb-115">
            <div class="container">
                <div class="testimonials-active owl-carousel">
                    <div class="single-testimonial-2 text-center">
                    <h3>Verify Your Email Address</h3>
                        <p> A fresh verification link has been sent to your email address</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonials area end -->
        <!-- footer area start -->
        @include('frontend.includes.footer')
        @include('frontend.includes.footer_script')
    </body>
</html>
<script>
//     setTimeout(() => {
//   document.location.reload();
// }, 3000);
</script>
