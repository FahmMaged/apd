<div class="loader">
  <div class="loading">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</div>

<div class="row">
  <header>
    <div class="s12 col top_header">
      <div class="rows">
        <ul class="social_media">
          <a href="https://www.facebook.com/ArabPositiveDiscipline/">
            <li><i class="fa fa-facebook"></i></li>
          </a>
          <!-- <a href="#">
            <li><i class=" fa fa-twitter"></i></li>
          </a> -->
          <a
            href="https://instagram.com/arabpositivediscipline?igshid=1eb7js7rkijgg"
          >
            <li><i class=" fa fa-instagram"></i></li>
          </a>
          <!-- <a href="#">
            <li><i class=" fa fa-youtube"></i></li>
          </a> -->
          <a href="#">
            <li>
              [[+email]]
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </li>
          </a>
          <a href="#">
            <li>
              [[+phone]]
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
        <div class="l3 s8 m4 col">
          <div class="logo">
            <a href="/"> <img src="images/logo.png" /> </a>
          </div>
        </div>

        <div class="l9 s4 m8 col menu">
          <ul>
            <li class="active"><a href="index.php"> [[+home]] </a></li>
            <li>
              <a href="aboutUs.php"> [[+aboutUs]] </a>
              <ul class="sub_menu">
                <li><a href="aboutPage.php?id=1"> [[+page1]] </a></li>
                <li><a href="aboutPage.php?id=2"> [[+page2]] </a></li>
                <li><a href="aboutPage.php?id=3"> [[+page3]] </a></li>
              </ul>
            </li>
            <li><a href="events.php"> [[+events]] </a></li>
            <li>
              <a href="#"> [[+resources]] </a>
              <ul class="sub_menu">
                <li><a href="news.php"> [[+articles]] </a></li>
                <li><a href="videos.php"> [[+videos]] </a></li>
                <li><a href="pdfs.php"> [[+pdfs]] </a></li>
              </ul>
            </li>
            <li><a href="members.php"> [[+trainers]] </a></li>
            <!--<li><a href="#"> [[+services]] </a></li>-->
            <li><a href="contactUs.php"> [[+contactUs]] </a></li>
            <li [[+hideLogin]]><a href="#modal2"> [[+register]] </a></li>
            <li [[+hideLogout]]><a onclick="logout()"> [[+logout]] </a></li>
          </ul>

          <a href="#" data-activates="slide-out" class="button-collapse"
            ><i class="fa fa-bars" aria-hidden="true"></i
          ></a>
        </div>
      </div>
    </div>
  </header>

  <ul id="slide-out" class="side-nav">
    <li class="active"><a href="index.php"> [[+home]] </a></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header"
            >[[+aboutUs]]
            <i class="fa fa-chevron-down" style="font-size: 14px;"></i
          ></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="aboutUs.php"> [[+aboutUs]]</a></li>
              <li><a href="aboutPage.php?id=1"> [[+page1]] </a></li>
              <li><a href="aboutPage.php?id=2"> [[+page2]] </a></li>
              <li><a href="aboutPage.php?id=3"> [[+page3]] </a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li><a href="events.php"> [[+events]] </a></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">
            [[+resources]]
            <i class="fa fa-chevron-down" style="font-size: 14px;"></i>
          </a>
          <div class="collapsible-body">
            <ul>
              <li><a href="news.php"> [[+articles]] </a></li>
              <li><a href="videos.php"> [[+videos]] </a></li>
              <li><a href="pdfs.php"> [[+pdfs]] </a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li><a href="members.php"> [[+trainers]] </a></li>
    <!--<li><a href="#"> [[+services]] </a></li>-->
    <li><a href="contactUs.php"> [[+contactUs]] </a></li>
    <li [[+hideLogin]]><a href="#modal2"> [[+register]] </a></li>
    <li [[+hideLogout]]><a href="#"> [[+logout]] </a></li>
  </ul>

  <!-- Modal Structure -->
  <div id="modal2" class="modal">
    <a class=" modal-action modal-close waves-effect waves-green btn-flat">X</a>
    <div class="modal-content">
      <div class="s12 m6 l6 col">
        <h2 class="headline ">[[+login]]</h2>
        <form class="col s12" id="login">
          <input type="hidden" name="operation" value="login" />
          <div class="row">
            <div class="input-field col l12 m12 s12">
              <input
                id="loginEmail"
                name="email"
                type="email"
                class="validate"
              />
              <label for="email">[[+emailText]] </label>
            </div>
            <div class="input-field col l12 m12 s12">
              <input
                id="loginPassword"
                name="password"
                type="password"
                class="validate"
              />
              <label for="password">[[+password]]</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="submit" class="btn left redBtn">[[+login]]</button>
            </div>
          </div>
        </form>
        <div class="input-field col s12" hidden>
          <a id="forgetPassword" class="btn left redBtn">
            Forget Password
          </a>
        </div>
      </div>

      <div class="s12 m6 l6 col">
        <h2 class="headline ">[[+join]]</h2>
        <div class="s12 col center whyModal">
          <a class="waves-effect" href="#modal5">
            <h4>[[+advantage]]<span> [[+clickHere]]</span></h4>
          </a>
        </div>
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
              <label for="first_name"> [[+firstName]] * </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input
                id="last_name"
                name="last_name"
                type="text"
                class="validate"
              />
              <label for="last_name"> [[+lastName]] *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="email" name="email" type="text" class="validate" />
              <label for="email"> [[+emailText]] *</label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="phone" name="phone" type="text" class="validate" />
              <label for="phone"> [[+phoneNumber]] *</label>
            </div>
          </div>
          <div class="input-field col l12 m12 s12">
            <div class="file-field input-field">
              <div class="btn">
                <span>[[+upload]] *</span>
                <input type="file" name="image" />
              </div>
              <div class="file-path-wrapper">
                <input
                  class="file-path validate"
                  type="text"
                  placeholder="[[+image]] *"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col l12 m12 s12">
              <select multiple id="categoryID" name="categoryIDs[]">
                <option value="0" disabled selected>[[+category]] *</option>
                [[+categoriesTPL]]
              </select>
            </div>
          </div>
          <!--<div class="row">
            <div class="input-field col l12 m12 s12">
               <input id="degree" name="degree" type="text" class="validate" />
              <textarea
                id="degree"
                name="degree"
                class="materialize-textarea validate"
                rows="2"
              ></textarea>
              <label for="degree"> [[+degree]] *</label>
            </div>

             <div class="input-field col l6 m12 s12">
              <input
                id="position"
                name="position"
                type="text"
                class="validate"
              />
              <label for="position"> [[+position]] *</label>
            </div>
          </div> -->

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input
                id="password"
                name="password"
                type="password"
                class="validate"
              />
              <label for="password">[[+password]] *</label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input
                id="confirmPassword"
                name="confirmPassword"
                type="password"
                class="validate"
              />
              <label for="confirmPassword"> [[+confirmPassword]] *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <select id="cityID" name="cityID">
                <option value="0" disabled selected>[[+country]] *</option>
                [[+countriesTPL]]
              </select>
            </div>
            <div class="input-field col l6 m12 s12">
              <select id="locationID" name="locationID">
                <option value="0" disabled selected>[[+city]]</option>
                [[+locationsTPL]]
              </select>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="FacebookLink" name="FacebookLink" type="text" />
              <label for="FacebookLink"> [[+FacebookLink]] </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="TwitterLink" name="TwitterLink" type="text" />
              <label for="TwitterLink"> [[+TwitterLink]] </label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="InstagramLink" name="InstagramLink" type="text" />
              <label for="InstagramLink"> [[+InstagramLink]] </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="LinkedinLink" name="LinkedinLink" type="text" />
              <label for="LinkedinLink"> [[+LinkedinLink]] </label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <textarea
                id="bio"
                name="bio"
                class="materialize-textarea"
              ></textarea>
              <label for="bio">[[+bio]] *</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="btnSend" class="btn left redBtn">
                [[+register]]
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Structure -->

  <!-- Modal Structure -->
  <div id="modal5" class="modal bottom-sheet">
    <div class="modal-content">
      <h3>
        يحصل المعلمين الأعضاء في جمعية التربية الإيجابية العربية - مصر على
        المميزات التالية:
      </h3>
      <ol>
        <li>
          عضوية الجمعية الأمريكية، فكل عضو في الجمعية العربية يصبح تلقائيًا عضوا
          في الجمعية الأمريكية دون أن يسدد اشتراكًا منفصلًا للجمعية الأمريكية
          وليس العكس .. بمعنى عضوية الجمعية الأمريكية لا تغني عن عضوية "التربية
          الإيجابية العربية".
        </li>
        <li>
          حساب خاص على الموقع مع كل البيانات الخاصة بالأعضاء ليسهل الوصول إليهم.
        </li>
        <li>
          التسويق يحصل الأعضاء على الفرصة لوضع إعلانات الورش الخاصة بيهم
          (التربية الإيجابية فقط) على موقع التربية الإيجابية العربية.
        </li>
        <li>
          حضور اللقاء السنوي لأسرة لتربية الإيجابية العربية، والذي يسمح به
          للأعضاء فقط.
        </li>
        <li>حضور كل التدريبات التي تقدم للأعضاء للتطوير.</li>
        <li>
          يمنح الأعضاء منفذا خاصا لبعض المصادر على الموقع العربي ( مثل كل
          الأوراق والفيديوهات والباوربوينت) الذين يعرضون في الاجتماع السنوي ..
          أجندات متنوعة....
        </li>
        <li>
          لقاء الدعم الشهري. وهو لقاء يتم شهريا يجمع الأعضاء المشاركين مع
          المدربين بهدف دعم الأعضاء. وهو قاصر على الأعضاء فقط
        </li>
        <li>
          يتم دعوة الأعضاء لكل ما يستجد من خدمات تقدمها الجمعية العربية لدعم
          أعضائها وتنمية قدراتهم.
        </li>
      </ol>
    </div>
    <div class="modal-footer">
      <a
        href="#"
        class="modal-close waves-effect waves-green btn-flat"
        style="position: relative;
              width: 100%;
              text-align: center;
              background: #eee;
              color: #888;"
        >اغلاق</a
      >
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      var langu = $("#lang").val();
      if (langu == "ar") $("#langLink").text("English");
      else $("#langLink").text("عربي");

      $("#forgetPassword").click(function(event) {
        forgetPassword();
      });

      // Forget Password
      function forgetPassword() {
        $("#loadingContainer").show();

        $.ajax({
          url: "handlers/MembersHandler.php",
          type: "POST",
          data: {
            operation: "forgetPassword",
            email: $("#loginEmail").val()
          }
        })
          .done(function(data) {
            // console.log(data);
            data = $.parseJSON(data);
            var message;
            var title;

            if (data.res == 1) {
              if ($("#lang").val() == "en") {
                message = data.message_en;
                title = "Success";
              } else {
                message = data.message_ar;
                title = "تم";
              }
              swal({
                title: title,
                text: message,
                type: "Success",
                confirmButtonText: "Close"
              });
            } else {
              if ($("#lang").val() == "en") {
                message = data.message_en;
                title = "Error";
              } else {
                message = data.message_ar;
                title = "خطأ";
              }
              swal({
                title: title,
                text: message,
                type: "error",
                confirmButtonText: "Close"
              });
              $("#loadingContainer").hide();
            }
            $("#modal2").modal("close");
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            $("#loadingContainer").hide();
          });
      }

      // Login Function
      $("#login").submit(function(event) {
        event.preventDefault();

        $("#loadingContainer").show();

        $.ajax({
          url: "handlers/MembersHandler.php",
          type: "POST",
          data: {
            email: $("#loginEmail").val(),
            password: $("#loginPassword").val(),
            operation: "login"
          },
          cache: false,
          success: function(data) {
            data = $.parseJSON(data);

            if (data.res == 1) {
              window.location = "index.php";
            } else {
              var message;
              var title;
              if ($("#lang").val() == "en") {
                message = data.message_en;
                title = "Error";
              } else {
                message = data.message_ar;
                title = "خطأ";
              }
              swal({
                title: title,
                text: message,
                type: "error",
                confirmButtonText: "Close"
              });
              $("#loadingContainer").hide();
            }
            $("#modal2").modal("close");
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

    // Change Lang
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

    // Logout
    function logout() {
      $("#loadingContainer").show();

      $.ajax({
        url: "handlers/MembersHandler.php",
        type: "POST",
        data: {
          operation: "logout"
        }
      })
        .done(function(data) {
          // return;
          if (data) {
            location.reload();
          }
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
          console.log("this: ", this);
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

        if ($("#cityID").val() == null || $("#cityID").val() == 0) {
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

        if ($("#categoryID").val() == null || $("#categoryID").val() == 0) {
          if ($("#lang").val() === "ar") {
            swal({
              title: "الحقول المطلوبة",
              text: "لابد من اختيار قسم",
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
      city = $("#cityID option:selected").text();
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
                  if (isConfirm2) {
                    window.location.reload(true);
                  }
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
                  if (isConfirm2) {
                    window.location.reload(true);
                  }
                }
              );
            }
          }

          if (data.saved === 2) {
            if ($("#lang").val() === "ar") {
              swal({
                title: "هذا البريد الالكتروني موجود بالفعل",
                text: "خطأ",
                type: "error",
                confirmButtonText: "اغلاق"
              });
            } else {
              swal({
                title: "Error",
                text: "This e-mail already exist",
                type: "error",
                confirmButtonText: "Close"
              });
            }
          }

          if (data.saved === 3) {
            if ($("#lang").val() === "ar") {
              swal({
                title: "كلمة المرور و تأكيد كلمة المررور غير متطابقين",
                text: "خطأ",
                type: "error",
                confirmButtonText: "اغلاق"
              });
            } else {
              swal({
                title: "Error",
                text: "The password and confirm password didn't match",
                type: "error",
                confirmButtonText: "Close"
              });
            }
          }
          $("#modal2").modal("close");
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });
  </script>
</div>
