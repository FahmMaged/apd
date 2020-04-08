<div class="row">
  <header>
    <div class="s12 col top_header">
      <div class="rows">
        <ul class="social_media">
          <a href="#">
            <li><i class="fa fa-facebook"></i></li>
          </a>
          <a href="#">
            <li><i class=" fa fa-twitter"></i></li>
          </a>
          <a href="#">
            <li><i class=" fa fa-linkedin"></i></li>
          </a>
          <a href="#">
            <li><i class=" fa fa-youtube"></i></li>
          </a>
          <a href="#">
            <li>
              info@apdegypt.com
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </li>
          </a>
          <a href="#">
            <li>
              info@apdegypt.com
              <i class="fa fa-phone-square" aria-hidden="true"></i>
            </li>
          </a>
          <input type="hidden" id="lang" value="[[+lang]]" />
          <a
            href="javascript:void(0)"
            onclick="changeLanguage('[[+lang]]')"
            class="langLink"
            id="langLink"
          >
            <li>English <i class="fa fa-flag" aria-hidden="true"></i></li>
          </a>
        </ul>
      </div>
    </div>
    <div class="l12 col no_padding header-body">
      <div class="rows">
        <div class="l3 s6 m4 col">
          <div class="logo"><img src="images/Logo.png" /></div>
        </div>

        <div class="l9 s6 m8 col menu">
          <ul>
            <li class="active"><a href="index.php"> الرئيسية </a></li>
            <li><a href="#"> من نخن </a></li>
            <li><a href="events.php"> الفاعليات </a></li>
            <li>
              <a href="#"> المصادر </a>
              <ul class="sub_menu">
                <li><a href="news.php"> المقالات </a></li>
                <li><a href="videos.php"> الفيديو </a></li>
                <li><a href="pdfs.php"> المطبوعات </a></li>
              </ul>
            </li>
            <li><a href="/static/Instructors.html"> المدربين </a></li>
            <li><a href="#"> خدمتنا </a></li>
            <li><a href="contactUs.php"> اتصل بنا </a></li>
            <li><a href="#modal2"> تسجيل </a></li>
          </ul>

          <a href="#" data-activates="slide-out" class="button-collapse"
            ><i class="fa fa-bars" aria-hidden="true"></i
          ></a>
        </div>
      </div>
    </div>
  </header>

  <ul id="slide-out" class="side-nav">
    <li class="active"><a href="index.php"> الرئيسية </a></li>
    <li><a href="#"> من نخن </a></li>
    <li><a href="events.php"> الفاعليات </a></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header"> المصادر </a>
          <div class="collapsible-body">
            <ul>
              <li><a href="news.php"> المقالات </a></li>
              <li><a href="videos.php"> الفيديو </a></li>
              <li><a href="pdfs.php"> المطبوعات </a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li><a href="/static/Instructors.html"> المدربين </a></li>
    <li><a href="#"> خدمتنا </a></li>
    <li><a href="contactUs.php"> اتصل بنا </a></li>
    <li><a href="#modal2"> تسجيل </a></li>
  </ul>

  <!-- Modal Structure -->
  <div id="modal2" class="modal">
    <a class=" modal-action modal-close waves-effect waves-green btn-flat">X</a>
    <div class="modal-content">
      <div class="s12 m6 l6 col">
        <h2 class="headline ">تسجيل دخول</h2>
        <form class="col s12" id="login">
          <input type="hidden" name="operation" value="login" />
          <div class="row">
            <div class="input-field col l12 m12 s12">
              <input id="email" name="email" type="email" class="validate" />
              <label for="email">البريد الالكتروني </label>
            </div>
            <div class="input-field col l12 m12 s12">
              <input
                id="password"
                name="password"
                type="password"
                class="validate"
              />
              <label for="password">كلمة المرور</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="submit" class="btn left redBtn">تسجيل دخول</button>
            </div>
          </div>
        </form>
      </div>

      <div class="s12 m6 l6 col">
        <h2 class="headline ">التسجيل</h2>
        <form class="col s12" id="register">
          <input type="hidden" name="operation" value="add" />
          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input
                id="first_name"
                name="first_name"
                type="text"
                class="validate"
              />
              <label for="first_name"> الاسم </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input
                id="last_name"
                name="last_name"
                type="text"
                class="validate"
              />
              <label for="last_name"> اسم العائلة </label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="email" name="email" type="text" class="validate" />
              <label for="email"> البريد الالكتروني </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="phone" name="phone" type="text" class="validate" />
              <label for="phone"> رقم الهاتف</label>
            </div>
          </div>

          <div class="row">
            <div class="file-field input-field">
              <div class="btn">
                <span>تحميل</span>
                <input type="file" name="image" />
              </div>
              <div class="file-path-wrapper">
                <input
                  class="file-path validate"
                  type="text"
                  placeholder="الصورة الشخصية"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input
                id="password"
                name="password"
                type="password"
                class="validate"
              />
              <label for="password">كلمة المرور</label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input
                id="confirmPassword"
                name="confirmPassword"
                type="password"
                class="validate"
              />
              <label for="confirmPassword"> تاكيد كلمة المرور </label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <select id="city" name="city">
                <option value="0" disabled selected>البلد</option>
                <option value="1">مصر</option>
                <option value="2">لبنان</option>
                <option value="3">الاردن</option>
              </select>
            </div>
            <div class="input-field col l6 m12 s12">
              <select id="locationID" name="locationID">
                <option value="0" disabled selected>المحافظة</option>
                <option value="1">القاهرة</option>
                <option value="2">الاسكندرية</option>
                <option value="3">مرسي مطروح</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <textarea
                id="bio"
                name="bio"
                class="materialize-textarea"
              ></textarea>
              <label for="bio">معلومات عني</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="btnSend" class="btn left redBtn">تسجيل</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Structure -->

  <script type="text/javascript">
    $(document).ready(function() {
      var langu = $("#lang").val();
      if (langu == "ar") $("#langLink").text("English");
      else $("#langLink").text("عربي");

      // Login Function
      $("#login").submit(function(event) {
        event.preventDefault();

        if (
          $("#email").val() == "" ||
          $("#email").val() == undefined ||
          $("#email").val() == null
        ) {
          swal({
            title: "Required Field is Missing",
            text: "Email addess is a required field",
            type: "error",
            confirmButtonText: "close"
          });
          return;
        }

        if (
          $("#password").val() == "" ||
          $("#password").val() == undefined ||
          $("#password").val() == null
        ) {
          swal({
            title: "Required Field is Missing",
            text: "Password is a required field",
            type: "error",
            confirmButtonText: "close"
          });
          return;
        }

        $("#loadingContainer").show();

        $.ajax({
          url: "handlers/MembersHandler.php",
          type: "POST",
          data: {
            email: $("#email").val(),
            password: $("#password").val(),
            operation: "login"
          },
          cache: false,
          success: function(data) {
            data = $.parseJSON(data);

            if (data.res == 1) {
              window.location = "index.php";
            } else {
              swal({
                title: "Invalid mail or password",
                text: data.message,
                type: "error",
                confirmButtonText: "Close"
              });
              $("#loadingContainer").hide();
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.statusText);
            console.log(xhr.responseText);
            console.log(xhr.status);
            swal({
              title: "Something went wrong",
              text: xhr.responseText,
              type: "error",
              confirmButtonText: "close"
            });
            $("#loadingContainer").hide();
          }
        });
      });
    });

    function changeLanguage(lang) {
      $("#loadingContainer").show();

      $.ajax({
        url: "handlers/LangHandler.php",
        type: "POST",
        data: {
          operation: "changeLanguage",
          lang: lang,
          currentURL: location.href
        }
      })
        .done(function(data) {
          // return;
          window.location.href = data;
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          $("#loadingContainer").hide();
        });
    }

    //save button in the add News modal
    $("#btnSend").click(function(event) {
      event.preventDefault();

      isValid = true;

      //form validations
      $("#register .validate").each(function() {
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

        if ($("#city").val() == null || $("#city").val() == 0) {
          if ($("#lang").val() === "ar") {
            swal({
              title: "الحقول المطلوبة",
              text: "لابد من اختيار بلد",
              type: "error",
              confirmButtonText: "غلق"
            });
          } else {
            swal({
              title: "Required Fields",
              text: "you should choose country",
              type: "error",
              confirmButtonText: "Close"
            });
          }
          isValid = false;
          return;
        }

        if ($("#locationID").val() == null || $("#locationID").val() == 0) {
          if ($("#lang").val() === "ar") {
            swal({
              title: "الحقول المطلوبة",
              text: "لابد من اختيار مدينة",
              type: "error",
              confirmButtonText: "غلق"
            });
          } else {
            swal({
              title: "Required Fields",
              text: "you should choose city",
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
      $("#register").submit();
    });

    //add News submission
    $("#register").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);
      var city = 0;
      city = $("#city option:selected").text();
      values.append("cityName", city);

      var location = 0;
      location = $("#locationID option:selected").text();
      values.append("locationName", location);

      $.ajax({
        url: "handlers/MembersHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          var data = JSON.parse(data);
          console.log("data: ", data.saved);
          $("#loadingContainer").hide();
          if (data.saved === true) {
            $("#register")[0].reset();
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
          }

          if (data.saved === 2) {
            if ($("#lang").val() === "ar") {
              swal(
                {
                  title: "هذا البريد الالكتروني موجود بالفعل",
                  text: "خطأ",
                  type: "error",
                  confirmButtonText: "اغلاق"
                }
                // function(isConfirm2) {
                //   if (isConfirm2) location.reload();
                // }
              );
            } else {
              swal(
                {
                  title: "Error",
                  text: "This e-mail already exist",
                  type: "error",
                  confirmButtonText: "Close"
                }
                // function(isConfirm2) {
                //   if (isConfirm2) location.reload();
                // }
              );
            }
          }

          if (data.saved === 3) {
            if ($("#lang").val() === "ar") {
              swal(
                {
                  title: "كلمة المرور و تأكيد كلمة المررور غير متطابقين",
                  text: "خطأ",
                  type: "error",
                  confirmButtonText: "اغلاق"
                }
                // function(isConfirm2) {
                //   if (isConfirm2) location.reload();
                // }
              );
            } else {
              swal(
                {
                  title: "Error",
                  text: "The password and confirm password didn't match",
                  type: "error",
                  confirmButtonText: "Close"
                }
                // function(isConfirm2) {
                //   if (isConfirm2) location.reload();
                // }
              );
            }
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });
  </script>
</div>
