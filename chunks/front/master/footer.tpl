<!-- ==============================================    End Body     =============================================== -->
<section class="join sections">
  <div class="rows ">
    <div class="l12 s12 m12 col no_padding statMain">
      <div class="l9 m9 s12 col center">
        <h4>[[+subscribeTitle]]</h4>
        <p>
          [[+subscribeDesc]]
        </p>
      </div>
      <div class="l3 m3  s12 col center">
        <a href="#modal1" class="waves-effect waves-light btn about_btn">
          [[+subscribeNow]]
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Modal Structure -->
<div id="modal1" class="modal newsLetterModal">
  <form id="letterForm">
    <input type="hidden" name="operation" value="addMail">
    <a class=" modal-action modal-close waves-effect waves-green btn-flat">X</a>
    <div class="modal-content">
      <h1 class="headline "> [[+subscribeNow]]</h1>
      <form>
        <input type="text" name="mail" id="news_name" placeholder="[[+subscribeEmail]]" class="validate" />

        <a href="#" class="waves-effect waves-light btn  left" id="newsLetter"> [[+subscribe]] </a>
      </form>
    </div>
  </form>
</div>
<!-- Modal Structure -->
<footer class="l12 s12 m12 col  no_padding ">
  <div class="rows">

    <div class="l4 s6 m4 col imp_links">
      <h3> [[+links]] </h3>
      <div class="s6  col">
        <ul>
          <li> <a href="index.php"> [[+home]] </a></li>
          <li> <a href="aboutUs.php"> [[+aboutUs]] </a></li>
          <li> <a href="members.php"> [[+trainers]] </a></li>
          <li> <a href="events.php"> [[+events]] </a></li>
        </ul>
      </div>
      <div class="s6 col">
        <ul>
          <li> <a href="news.php"> [[+articles]] </a></li>
          <li> <a href="pdfs.php"> [[+pdfs]] </a></li>
          <li> <a href="videos.php"> [[+videos]] </a></li>
          <li> <a href="contactUs.php"> [[+contactUs]] </a></li>
          <!-- <li> <a href="services.php"> [[+services]]  </a></li> -->
        </ul>
      </div>
    </div>

    <div class="l4 s12 m4 col  contact-widget">
      <h3> [[+contactUs]] </h3>
      <ul class="footer_contatc">
        <li> <a href="#"><span> [[+phoneText]] </span> [[+phone]] </a></li>
        <li> <a href="#"><span> [[+emailText]] </span> [[+email]] </a></li>
        <li> <a href="#"><span> [[+address]] </span> [[+theAddress]] </a></li>
      </ul>
    </div>

    <div class="l4 s12 m4 col  contact-widget">
      <h3> [[+follow]] </h3>
      <ul class="footer_social">
        <li> <a href="#"><i class="fa fa-facebook"></i> </a></li>
        <li> <a href="#"> <i class=" fa fa-twitter"></i> </a></li>
        <li> <a href="#"> <i class=" fa fa-linkedin"></i> </a></li>
        <li> <a href="#"><i class=" fa fa-youtube"></i> </li> </a>
      </ul>
    </div>

  </div>


  <div class="l12 col no_padding last_footer">
    <div class="rows">
      <div class="l12 s12 m12 col">
        <h5> [[+aboutFooter]] </h5>
      </div>

    </div>
  </div>
</footer>
<!-- ==============================================================================================================- -->
</div>
</body>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="admin/js/sweetalert2.min.js"></script>
<script>
  $(window).load(function () {
    $("html, body").animate({ scrollTop: 0 }, "fast");
      $(".loader").remove();
    setTimeout(function () {
      $(" .testimonial p:empty").remove();
      $('p').each(function () {
        var $this = $(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
          $this.remove();
      });
    }, 3000);


  });
  $(document).ready(function () {
    $('select').material_select();
  });
</script>
<script>
  $(document).ready(function ($) {
     

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
      rtl: true,
      nav: false,
      dots: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 1,
        },
        1000: {
          items: 2,
        }
      }
    });

    $('.loop2').owlCarousel({
      items: 5,
      loop: false,
      margin: 30,
      rtl: true,
      nav: false,
      dots: false,
    });
  });


  function validEmail(email) {
    var re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  };
  $("#newsLetter").click(function (event) {
    event.preventDefault();

    isValid = true;

    //form validations
    $('#letterForm .validate').each(function () {
      if ($.trim($(this).val()) == "") {
        if ($("#lang").val() == "en") {
          swal({
            title: "Email Empty",
            text: "Email Field Can't Be Empty",
            type: "error",
            confirmButtonText: "Close"
          });
          isValid = false;
          return;
        } else {
          swal({
            title: "خطأ",
            text: "لابد من ادخال البريد الالكتروني",
            type: "خطأ",
            confirmButtonText: "Close"
          });
          isValid = false;
          return;

        }
      }

      var check = validEmail($('#news_name').val());
      if (!check) {
        if ($("#lang").val() == "en") {
          swal({
            title: "Email Not Valid",
            text: "Enter a valid Email address",
            type: "error",
            confirmButtonText: "Close"
          });
          isValid = false;
          return;
        } else {
          swal({
            title: "خطأ",
            text: "لابد من ادخال بريد الكتروني صحيح",
            type: "error",
            confirmButtonText: "اغلاق"
          });
          isValid = false;
          return;

        }
      }

    });

    if (!isValid) return;

    //submit the form after validations
    $('#letterForm').submit();
  });

  $('#letterForm').submit(function (event) {
    event.preventDefault();

    $("#loadingContainer").show();

    var values = new FormData($(this)[0]);
    $.ajax({
      url: "handlers/NewsLetterHandler.php",
      type: "post",
      data: values,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data == 1) {
          if ($("#lang").val() == "en") {
            swal({
              title: "Email Submitted",
              type: "success",
              confirmButtonText: "Close"
            });
          } else {
            swal({
              title: "تم الاشتراك",
              type: "success",
              confirmButtonText: "اغلاق"
            });
          }
        } else {
          if ($("#lang").val() == "en") {
            swal({
              title: "Email Existed",
              text: "This Email Existed",
              type: "error",
              confirmButtonText: "Close"
            });
          } else {
            swal({
              title: "خطأ",
              text: "هذا البريد الالكتروني موجود بالفعل",
              type: "error",
              confirmButtonText: "اغلاق"
            });
          }
        }
        $('#letterForm')[0].reset();
        $('#modal1').modal('close');
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);

        $("#loadingContainer").hide();
      }
    });
  });
</script>

</html>