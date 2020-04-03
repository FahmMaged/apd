
  
  <!-- ==============================================    End Body     =============================================== -->
<section class="join sections">
    <div class="rows ">
      <div class="l12 s12 m12 col no_padding statMain">
        <div class="l9 m9 s12 col center">
          <h4>شارك في القائمة البريدية</h4>
          <p>
            هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم
            تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.
            إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق
          </p>
        </div>
        <div class="l3 m3  s12 col center">
          <a href="#modal1" class="waves-effect waves-light btn about_btn">
            اشترك الان
          </a>
        </div>
      </div>
    </div>
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
      <a class=" modal-action modal-close waves-effect waves-green btn-flat">X</a>
      <div class="modal-content">
        <h1 class="headline ">اشترك الان</h1>
        <form>
          <input
            type="text"
            name="email"
            id="news_name"
            placeholder="البريد الالكتروني"
          />
  
          <a href="#" class="waves-effect waves-light btn  left"> اشترك </a>
        </form>
      </div>
    </div>
    <!-- Modal Structure -->
  </section>
  <footer class="l12 s12 m12 col  no_padding ">
    <div class="rows">
        
    <div class="l4 s6 m4 col imp_links">
        <h3> روابط سريعة </h3>
        <div class="s6  col">
            <ul>
               <li>  <a href="#">  من نحن  </a></li>
                <a href="#"> <li>الرؤية و الرسالة   </a></li>
                <a href="#"> <li>القيم الأساسية   </a></li>
               <li>  <a href="#">  فريق العمل </a></li>
               <li>  <a href="#">رؤساء الوحدات   </a></li>
            </ul> 
        </div>
        <div class="s6 col">
            <ul>
               <li>  <a href="#">المركز الاعلامي  </a></li>
                <a href="#"> <li>النشرة الإخبارية   </a></li>
               <li>  <a href="#"> بيانات صحفية  </a></li>
               <li>  <a href="#">الأخبار  </a></li>
               <li>  <a href="#">  اتصل بنا  </a></li>
            </ul> 
        </div>
    </div> 
    
    <div class="l4 s12 m4 col  contact-widget">
        <h3> اتصل بنا </h3>
            <ul class="footer_contatc">
                <li>  <a href="#"><span> الهاتف </span> 010215151615 </a></li>
                <li>  <a href="#"><span> الايميل </span> info@sad.com </a></li>
                <li>  <a href="#"><span> العنوان </span> التجمع الخامس - القاهرة - مصر  </a></li>
            </ul>
    </div>

    <div class="l4 s12 m4 col  contact-widget">
        <h3>  تابعنا علي  </h3>
            <ul class="footer_social">
                <li>  <a href="#"><i class="fa fa-facebook"></i>  </a></li>
                <li>  <a href="#"> <i class=" fa fa-twitter"></i> </a></li>
                <li>  <a href="#"> <i class=" fa fa-linkedin"></i>  </a></li>
                <li>  <a href="#"><i class=" fa fa-youtube"></i>   </li> </a>
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
        <script type="text/javascript" src="admin/js/sweetalert2.min.js"></script>
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