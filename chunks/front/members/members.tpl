[[+head]] [[+header]]

<section class="l12 s12 m12 col no_padding page_name">
  <div class="l12 s12 m12 col inner_headline center">
    <h1>[[+headerTitle]]</h1>
  </div>
  <img src="[[+mainImage]]" />
</section>
<!-- ==============================================    End Body     =============================================== -->
<section class="inner_body instructors">
  <div class="rows">
    <div class="filter">
      <div class="s12 l5 m5 col input-field " id="cityID">
        <select>
          <option value="0" selected>[[+country]]</option>
          [[+countriesTPL]]
        </select>
      </div>

      <div class="s12 l5 m5 col input-field " id="locationID">
        <select>
          <option value="0" selected>[[+city]] </option>
          [[+locationsTPL]]
        </select>
      </div>

      <div class="s12 l2 m2 col input-field ">
        <a
          class="waves-effect waves-light btn filterBtn"
          onclick="fnGetMembers(1)"
          >[[+search]]</a
        >
      </div>
    </div>
    <div class="l12 col no_padding" id="contentContainer"></div>
    
<div id="bioModal" class="modal">
    <div class="modal-content teacher_box">
      <div class="s12 l4 m4 col"> <img src="[[+image]]" /></div>
      <div class="s12 l8 m8 col"> 
        <h3>[[+name]]</h3> 
        <h5> [[+position]] </h5>
        <div class="bio">
        <div class="s12 l6 col"> <h6>  <i class="fa fa-envelope"></i> [[+email]]</h6> </div>
        <div class="s12 l6 col"><h6>  <i class="fa fa-mobile-phone"></i> [[+phone]] </h6> </div>
            
            <ul class="teacher_social">
                <li [[+hideF]]>  <a href="[[+FacebookLink]]"><i class="fa fa-facebook"></i>  </a></li>
                <li [[+hideT]]>  <a href="[[+TwitterLink]]"> <i class=" fa fa-twitter"></i> </a></li>
                <li [[+hideI]]>  <a href="[[+InstagramLink]]"> <i class=" fa fa-instagram"></i>  </a></li>
                <li [[+hideL]]>  <a href="[[+LinkedinLink]]"><i class=" fa fa-linkedin"></i>   </li> </a>
                <!-- <li>  <a href="#"><i class=" fa fa-youtube"></i>   </li> </a> -->
            </ul>
        </div>

        <p>
        وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.
        </p>
</div>
    </div>
  </div>

    <div class="s12 center  col" id="pagination"></div>
  </div>
</section>

[[+footer]] [[+scripts]]
