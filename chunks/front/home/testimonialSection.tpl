<section class="testimonial sections">
        <div class="rows">
            <h1 class="headline">  <span> [[+testimonialTitle]] </h1>
            <h2  class="headline2">[[+testimonialSubTitle]] </h2>
     <div class="loop owl-carousel owl-theme">
        [[+testimonialItems]]
      </div>
        </div>
    </section>

    <script>
       $('.loop').owlCarousel({
                items: 2,
                loop: false,
                margin: 30,
                 rtl:true, 
                nav:false,
                dots:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:1,
                    },
                    1000:{
                        items: 2,
                    }
                }
              }); 

              $('.loop2').owlCarousel({
                items: 5,
                loop: false,
                margin: 30,
                 rtl:true, 
                nav:false,
                dots:false,
              }); 
           
    </script>