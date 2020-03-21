
  <footer class="l12 s12 m12 col  no_padding ">
    <div class="rows">
        
    <div class="l4 s6 m4 col imp_links">
        <h3> روابط مهمة </h3>
        <div class="s6 col">
            <ul>
                <a href="#"> <li>   من نحن  </li></a>
                <a href="#"> <li>الرؤية و الرسالة   </li></a>
                <a href="#"> <li>القيم الأساسية   </li></a>
                <a href="#"> <li>   فريق العمل </li></a>
                <a href="#"> <li> رؤساء الوحدات   </li></a>
            </ul> 
        </div>
        <div class="s6 col">
            <ul>
                <a href="#"> <li> المركز الاعلامي  </li></a>
                <a href="#"> <li>النشرة الإخبارية   </li></a>
                <a href="#"> <li>  بيانات صحفية  </li></a>
                <a href="#"> <li> الأخبار  </li></a>
                <a href="#"> <li>   اتصل بنا  </li></a>
            </ul> 
        </div>
    </div> 
    
    <div class="l4 s12 m4 col  contact-widget">
        <h3> اتصل بنا </h3>
            <ul class="footer_social">
                 <a href="#"> <li> <i class="fa fa-facebook"></i>  </li></a>
                 <a href="#"> <li>  <i class=" fa fa-twitter"></i> </li></a>
                 <a href="#"> <li>  <i class=" fa fa-linkedin"></i>  </li></a>
                 <a href="#"> <li> <i class=" fa fa-youtube"></i>   </li> </a>
            </ul>
    </div>
        
    </div>
    
    
        <div class="l12 col no_padding last_footer">
            <div class="rows">
            <div class="l12 s12 m12 col"><h5> جميع الحقوق محفوظة .  التربية الايجابية 2020 </h5></div>
            
        </div>
    </div>
</footer>
  <!-- ==============================================================================================================- -->  
    </div>
  </body>
        <script type="text/javascript" src="js/app.js"></script>  
        <script>
            $(document).ready(function() {
                $('select').material_select();
            });
        </script>
          <script>
            jQuery(document).ready(function($) { 
                  $('.button-collapse').sideNav({
                        menuWidth: 300, // Default is 300
                        edge: 'right', // Choose the horizontal origin
                        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                        draggable: true, // Choose whether you can drag to open on touch screens,
                       
                  });
                        
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
            });
          </script>
</html>