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

          <a href="#">
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
        <form class="col s12">
          <div class="row">
            <div class="input-field col l12 m12 s12">
              <input id="first_name" type="email" class="validate" />
              <label for="first_name">البريد الالكتروني </label>
            </div>
            <div class="input-field col l12 m12 s12">
              <input id="last_name" type="password" class="validate" />
              <label for="last_name">كلمة المرور</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="textarea1" class="btn left redBtn">تسجيل دخول</button>
            </div>
          </div>
        </form>
      </div>

      <div class="s12 m6 l6 col">
        <h2 class="headline ">التسجيل</h2>
        <form class="col s12">
          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="first_name" type="text" class="validate" />
              <label for="first_name"> الاسم </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="last_name" type="text" class="validate" />
              <label for="last_name"> اسم العائلة </label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col l6 m12 s12">
              <input id="first_name" type="text" class="validate" />
              <label for="first_name"> البريد الالكتروني </label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="last_name" type="text" class="validate" />
              <label for="last_name"> رقم الهاتف</label>
            </div>
          </div>

          <div class="row">
            <div class="file-field input-field">
              <div class="btn">
                <span>تحميل</span>
                <input type="file" />
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
              <input id="last_name" type="password" class="validate" />
              <label for="last_name">كلمة المرور</label>
            </div>
            <div class="input-field col l6 m12 s12">
              <input id="last_name" type="password" class="validate" />
              <label for="last_name"> تاكيد كلمة المرور </label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col l6 m12 s12">
              <select>
                <option value="" disabled selected>البلد</option>
                <option value="1">مصر</option>
                <option value="2">لبنان</option>
                <option value="3">الاردن</option>
              </select>
            </div>
            <div class="input-field col l6 m12 s12">
              <select>
                <option value="" disabled selected>المحافظة</option>
                <option value="1">القاهرة</option>
                <option value="2">الاسكندرية</option>
                <option value="3">مرسي مطروح</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <textarea id="textarea1" class="materialize-textarea"></textarea>
              <label for="textarea1">معلومات عني</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <button id="textarea1" class="btn left redBtn">تسجيل</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Structure -->
