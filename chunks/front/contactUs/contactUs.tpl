[[+head]] [[+header]]

<section class="headerInner" style="background-image: url('[[+mainImage]]')">
  <div class="overlay">
    <div class="titles">
      <h3>[[+headerTitle]]</h3>
    </div>
  </div>
</section>
<!-- HEADER-END -->
<section class="contactUs">
  <div class="container">
    <h4>
      [[+title1]]<br />
      <span> [[+title2]] </span>
    </h4>

    <div class="row">
      <div class="col s12 m4 l4">
        <div class="contactInfo">
          <i class="fa fa-phone "></i>
          <h3>[[+contact]]</h3>
          <p>
            <span>[[+telephone]]</span>
            (+202) -808-749-25
          </p>
          <p>
            <span>[[+fax]]</span>
            (+202) -511-799-25
          </p>
        </div>
      </div>
      <div class="col s12 m4 l4">
        <div class="contactInfo">
          <i class="fa fa-envelope"></i>
          <h3>[[+email]]</h3>
          <p>NCCPIM@gmail.com</p>
        </div>
      </div>
      <div class="col s12 m4 l4">
        <div class="contactInfo">
          <i class="fa fa-map-marker"></i>
          <h3>[[+address]]</h3>
          <p>[[+theAddress]]</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sendMessage">
  <div class="container">
    <div class="row">
      <h2>[[+sendToUs]]</h2>
      <form id="addGLI">
        <div class="col s12 m6 l6 messageForm">
          <input type="hidden" name="operation" value="sendContactMail" />
          <input
            placeholder="[[+name]]*"
            name="name"
            type="text"
            class="validate"
          />
          <input
            placeholder=" [[+email]]*"
            name="email"
            type="text"
            class="validate"
          />
          <input
            placeholder="[[+phoneNumber]]*"
            name="phone"
            type="tel"
            class="validate"
          />
          <!-- <div class="problems">

                            <select class="browser-default">
                                    <option value="0"selected>[[+complaints]] </option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                    </div> -->

          <textarea
            name="message"
            name="subject"
            placeholder="[[+message]]"
          ></textarea>
          <a id="btnSend">[[+send]]</a>
        </div>
      </form>
      <div class="col s12 m6 l6 map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.3511475911605!2d31.23205688501998!3d30.055467581878283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840c2a2468b43%3A0x40fcc2f919c7cb0!2z2YjYstin2LHYqSDYp9mE2K7Yp9ix2KzZitipINin2YTZhdi12LHZitip!5e0!3m2!1sar!2seg!4v1535978657196"
        ></iframe>
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
