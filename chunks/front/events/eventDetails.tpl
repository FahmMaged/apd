[[+head]]
[[+header]]

<!-- ==============================================    End Body     =============================================== -->      
<section class="l12 s12 m12 col no_padding page_name">
                
    <!-- <div class="l12 s12 m12 col inner_headline center">
        <h1> الفاعليات </h1>
            <div class="nav-wrapper">
              <div class="col s12">
                <a href="#!" class="breadcrumb">الرئيسية</a>
                <a href="#!" class="breadcrumb"> الفاعليات </a> 
              </div>
            </div>
     </div> -->
    <img src="[[+mainImage]]">
</section>
<!-- ==============================================    End Body     =============================================== -->        
        <section class="inner_body eventsPage">
            <div class="rows">

                <div class="s12 col eventsInnerPage">
                    
                    <div class="l9 s12 m9 col">
                        <div class="news_img">
                            <img src="[[+image]]" />
                        </div>
                        <h1>[[+title]]</h1>

                        [[+description]]
                    </div>  
                    <div class="l3 s12 m3 col stickyBox">
                        <div">
                            <ul>
                                <h2> [[+details]]</h2>
                                <li>
                                    <h4> [[+date]]</h4>
                                    <div>  
                                        <i class="fa fa-clock-o"></i>
                                         [[+publishDate]]
                                    </div>
                                </li>
                                <li>
                                    <h4> [[+timeText]]</h4>
                                    <div>  
                                        <i class="fa fa-clock-o"></i>
                                          [[+time]]
                                    </div>
                                </li>
                                <li>
                                    <h4> [[+locationText]]</h4>
                                    <div>  
                                        <i class="fa fa-clock-o"></i>
                                        [[+location]] 
                                    </div>
                                </li>
                                <li>
                                    <h4> [[+share]]</h4>
                                    <div>
                                        
                                            <span>
                                                    <a href="javascript:fbShare('[[+url]]', '', '', '', '');"
                                                    ><i class="fa fa-facebook-f"></i>
                                                  </a>
                                                </span>
                                                <span>
                                                    <a
                                                        href="https://twitter.com/intent/tweet?url=[[+url]]&text=[[+title]]"
                                                        target="_blank"
                                                        ><i class="fa fa-twitter"></i>
                                                    </a>
                                                </span>
                                                <span>
                                                    <a
                                                        href="https://www.linkedin.com/shareArticle?mini=true&url=[[+encodedUrl]]
                                                        "
                                                        target="_blank"
                                                        ><i class="fa fa-linkedin"></i>
                                                    </a>
                                                </span>
                                        <!-- <span> <i class="fa fa-facebook"></i>  </span> -->
                                        <!-- <span> <i class="fa fa-facebook"></i>  </span>
                                        <span> <i class="fa fa-facebook"></i>  </span>
                                        <span> <i class="fa fa-facebook"></i>  </span> -->
                                    </div>
                                </li>
                                <button  data-target="modal2" class="btn modal-trigger waves-effect "> [[+join]] </button>
                            </ul>
                        </div">
                    </div>  
                    
                      <!-- Modal Structure -->
                    <div id="modal2" class="modal">
                        <div class="modal-content">
                            <form class="col s12" id="addGLI">
                                <div class="row">
                                        <input type="hidden" name="operation" value="add" />
                                    <div class="input-field col l12 m12 s12">
                                    <input id="name" name="name" type="text" class="validate">
                                    <label for="name">[[+name]]</label>
                                    </div>
                                    <!-- <div class="input-field col l6 m12 s12">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Last Name</label>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="input-field col l6 m12 s12">
                                    <input id="email" name="email" type="text" class="validate">
                                    <label for="email">[[+email]] </label>
                                    </div>
                                    <div class="input-field col l6 m12 s12">
                                    <input id="phone" name="phone"  type="text" class="validate">
                                    <label for="phone">[[+phoneNumber]]</label>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="input-field col s12">
                                    <textarea id="textarea1" name="message"  class="materialize-textarea"></textarea>
                                    <label for="textarea1">[[+message]]</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <button id="btnSend" class="btn left redBtn"> [[+send]] </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
        </div>
    </div>
</section> 

[[+footer]]

<script type="text/javascript">
    //get all items
    //save button in the add News modal
    $("#btnSend").click(function(event) {
      event.preventDefault();
  
      isValid = true;
  
      //form validations
      $("#addGLI .validate").each(function() {
        if ($.trim($(this).val()) == "") {
          if ($("#lang").val() === "ar") {
            swal({
              title: "الحقول المطلوبة",
              text: "الحقول التي تحتوي على علامة * بجانبها مطلوبة",
              type: "error",
              confirmButtonText: "غلق"
            });
          } else {
            swal({
              title: "Required Fields",
              text: "Fields has * next to it are required",
              type: "error",
              confirmButtonText: "Close"
            });
          }
  
          isValid = false;
          return;
        }
      });
  
      if (!isValid) return;
  
      //submit the form after validations
      $("#addGLI").submit();
    });
  
    //add News submission
    $("#addGLI").submit(function(event) {
      event.preventDefault();
  
      $("#loadingContainer").show();
  
      var values = new FormData($(this)[0]);
  
      $.ajax({
        url: "handlers/EventsSubmissionsHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#addGLI")[0].reset();
          $("#loadingContainer").hide();
          if ($("#lang").val() === "ar") {
            swal(
              {
                title: "تم ارسال طلبك",
                text: "نشكرك للتواصل معنا",
                type: "success",
                confirmButtonText: "تم"
              },
              function(isConfirm2) {
                if (isConfirm2) location.reload();
              }
            );
          } else {
            swal(
              {
                title: "Submitted",
                text: "Thanks for contact us.",
                type: "success",
                confirmButtonText: "Close"
              },
              function(isConfirm2) {
                if (isConfirm2) location.reload();
              }
            );
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);
  
          $("#loadingContainer").hide();
        }
      });
    });
  
    function fbShare(e, t, a, o, i, n) {
        var r = screen.height / 2 - n / 2,
        s = screen.width / 2 - i / 2;
        window.open(
        "http://www.facebook.com/sharer.php?s=100&caption=" +
            t +
            "&description=" +
            a +
            "&picture=" +
            o +
            "&u=" +
            e,
        "sharer",
        "top=" +
            r +
            ",left=" +
            s +
            ",toolbar=0,status=0,width=" +
            i +
            ",height=" +
            n
        );
    }
  </script>