[[+head]] [[+header]]

<!-- ==============================================    End Body     =============================================== -->
<section class="l12 s12 m12 col no_padding page_name">
  <div class="l12 s12 m12 col inner_headline center">
    <h1>[[+headerTitle]]</h1>
    <!-- <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">الرئيسية</a>
        <a href="#!" class="breadcrumb"> الفاعليات </a>
      </div>
    </div> -->
  </div>
  <img src="[[+mainImage]]" />
</section>
<!-- ==============================================    End Body     =============================================== -->
<section class="inner_body eventsPage">
  <div class="rows">
    <div class="l12 s12 m12 col no_padding" [[+hideAdd]]>
      <div class="disclaimer">
        <p>[[+youCanAddEvent]]</p>
        <!-- <a
          href="#"
          data-target="modal22"
          class="waves-effect waves-light btn about_btn"
        >
          [[+addEvent]]
        </a>-->
        <a
        target="_blank"
          href="https://docs.google.com/forms/d/e/1FAIpQLSdCpXQ8vCANBGmcbuLU8XQQyFVO-yDhieVTS4ltN4vam3gKDA/viewform?vc=0&c=0&w=1"
          class="waves-effect waves-light btn about_btn"
        >
          [[+addEvent]]
        </a>
      </div>
    </div>

    <div class="filter">
      <div class="s12 l9 m9 col input-field " id="categoryID">
        <select>
          <option value="0" selected>[[+category]]</option>
          [[+categoriesTPL]]
        </select>
      </div>

      <div class="s12 l3 m3 col input-field ">
        <a
          class="waves-effect waves-light btn filterBtn"
          onclick="fnGetEvents(1)"
          >[[+search]]</a
        >
      </div>
    </div>

    <div class="l12 col no_padding" id="contentContainer"></div>

    <div class="s12 center  col" id="pagination"></div>
  </div>
</section>

<!-- Modal Structure -->
<div id="modal22" class="modal">
  <div class="modal-content">
    <form class="col s12" id="newEvent">
      <div class="row">
        <input type="hidden" name="operation" value="newEvent" />
        <div class="input-field col l12 m12 s12">
          <input id="name" name="title" type="text" class="validate" />
          <label for="name">[[+eventTitle]]</label>
        </div>
      </div>
      <div class="row">
        <div class="file-field input-field">
          <div class="btn">
            <span>[[+upload]]</span>
            <input type="file" name="picture" />
          </div>
          <div class="file-path-wrapper">
            <input
              class="file-path validate"
              type="text"
              placeholder="[[+eventImage]]"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l12 m12 s12">
          <input id="Location" name="location" type="text" class="validate" />
          <label for="Location">[[+eventLocation]] </label>
        </div>
      </div>
      <div class="row">
        <label for="Date">[[+eventDate]] </label>
        <div class="input-field col l6 m12 s12">
          <input id="Date" name="publish_date" type="Date" class="validate" />
        </div>
        <!-- <div class="input-field col l6 m12 s12">
          <input id="Time" name="Event Time " type="text" class="validate" />
          <label for="Time">[[+eventDate]] </label>
        </div> -->
        <div class="input-field col l6 m12 s12">
          <input id="Time" name="time" type="text" class="validate" />
          <label for="Time">[[+eventTime]] </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea
            id="textarea1"
            name="description"
            class="materialize-textarea"
          ></textarea>
          <label for="textarea1"> [[+eventDetails]] </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button id="btnEventSend" class="btn left redBtn">[[+submit]]</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- ==============================================================================================================- -->

[[+footer]] [[+scripts]]

<script>
  //save button in the add News modal
  $("#btnEventSend").click(function(event) {
    event.preventDefault();

    isValid = true;

    //form validations
    $("#newEvent .validate").each(function() {
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
    $("#newEvent").submit();
  });

  //add News submission
  $("#newEvent").submit(function(event) {
    event.preventDefault();

    $("#loadingContainer").show();

    var values = new FormData($(this)[0]);
    // var city = 0;
    // city = $("#city option:selected").text();
    // values.append("cityName", city);

    // var location = 0;
    // location = $("#locationID option:selected").text();
    // values.append("locationName", location);

    $.ajax({
      url: "handlers/EventsHandler.php",
      type: "POST",
      data: values,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        var data = JSON.parse(data);
        console.log("data: ", data);
        $("#loadingContainer").hide();
        if (data === 1) {
          $("#newEvent")[0].reset();
          if ($("#lang").val() === "ar") {
            swal(
              {
                title: " تم ارسال طلبك لاضافة الفاعلية",
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
                text: "Thanks for contact us to add the event.",
                type: "success",
                confirmButtonText: "Close"
              },
              function(isConfirm2) {
                if (isConfirm2) location.reload();
              }
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
