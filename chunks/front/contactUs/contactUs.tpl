[[+head]] [[+header]]

<!-- ==============================================    End Body     =============================================== -->
<section class="l12 s12 m12 col no_padding page_name">
  <div class="l12 s12 m12 col inner_headline center">
    <h1>[[+headerTitle]]</h1>
    <!-- <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">الرئيسية</a>
        <a href="#!" class="breadcrumb">اتصل بنا</a>
      </div>
    </div> -->
  </div>
  <img src="images/pexels-photo-1157557.jpeg" />
</section>
<!-- ==============================================    End Body     =============================================== -->
<section class="inner_body">
  <div class="rows">
    <div class="l12 col no_padding">
      <div class="contact_us ">
        <div class="l5 m5 s12 col contact_info">
          <iframe
            src=" https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d55281.1924264357!2d31.384468880548614!3d30.006016365279518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x14583ceb32248c7f%3A0x8ca7b1d76d8a1953!2s52+Passage!3m2!1d30.006020999999997!2d31.4194885!5e0!3m2!1sen!2seg!4v1477904660592 "
            width="100%"
            height="200"
            frameborder="0"
            style="border:0"
            allowfullscreen
          ></iframe>

          <ul class="contact-info">
            <li class="center  ">
              <span
                ><i class="fa fa-home" aria-hidden="true"></i> [[+address]]
              </span>
              <div>[[+theAddress]]</div>
            </li>
            <li class="center  ">
              <span>
                <i class="fa fa-envelope-o" aria-hidden="true"></i
                >[[+email]]</span
              >
              info@kijamii.com
            </li>
            <li class="center  Show">
              <span
                ><i class="fa fa-phone" aria-hidden="true"></i>[[+telephone]]
              </span>
              01250555666
            </li>
            <!---- <li class="center  "><span><i class="fa fa-fax" aria-hidden="true"></i>Fax :</span>   </li> -->
          </ul>
        </div>
        <div class="l7 m7 s12 col contact_form">
          <form class="col s12" id="addGLI">
            <div class="row">
              <div class="input-field col s12">
                <input type="hidden" name="operation" value="sendContactMail" />
                <input id="name1" name="name" type="text" class="validate" />
                <label for="name1">[[+name]]*</label>
              </div>
              <!-- <div class="input-field col l6 m12 s12">
                <input id="last_name" type="text" class="validate" />
                <label for="last_name">Last Name</label>
              </div> -->
            </div>
            <div class="row">
              <div class="input-field col l6 m12 s12">
                <input id="email1" name="email" type="text" class="validate" />
                <label for="email1">[[+email]]* </label>
              </div>
              <div class="input-field col l6 m12 s12">
                <input id="phone1" name="phone" type="text" class="validate" />
                <label for="phone1">[[+telephone]]*</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea
                  id="textarea1"
                  class="materialize-textarea"
                  name="message"
                ></textarea>
                <label for="textarea1">[[+message]]</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <!-- <a id="btnSend" class="btn left redBtn"> -->
                <button id="btnSend1" class="btn left redBtn">
                  [[+send]]
                </button>
                <!-- </a> -->
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==============================================================================================================- -->
[[+footer]]

<script type="text/javascript">
  //get all items
  //save button in the add News modal
  $("#btnSend1").click(function(event) {
    event.preventDefault();
    console.log("XXXX");
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
      url: "handlers/ContactHandler.php",
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
</script>
