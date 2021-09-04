<script type="text/javascript">
  $(document).ready(function() {
    fnGetSliderItems();
    fnGetAboutSection();
    fnGetNewsSection();
    fnGetServicesSection();
    fnGetTestimonialSection();
    $("p:empty").remove();
  });
  //get all items
  function fnGetSliderItems() {
    $("#loadingContainer").show();
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getSliderItems",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#sliderContainer").html("");
        $("#sliderContainer").html(data.output);
        $(".slider").slider();
        $("#loadingContainer").hide();
        $("p:empty").remove();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);

        $("#loadingContainer").hide();
      }
    });
  }
  //get about section
  function fnGetAboutSection() {
    $("#loadingContainer").show();
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getAboutSection",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#aboutUsSection").html("");
        $("#aboutUsSection").html(data.output);
        $("p:empty").remove();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }
  //get news section
  function fnGetNewsSection() {
    $("#loadingContainer").show();
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getNewsSection",
        lang: $("#lang").val(),
        logged: $("#logged").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#newsSection").html("");
        $("#newsSection").html(data.output);
        $("p:empty").remove();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }

  //get services section
  function fnGetServicesSection() {
    $("#loadingContainer").show();
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getServicesSection",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#servicesSection").html("");
        $("#servicesSection").html(data.output);
        $("p:empty").remove();

        $(".show-more").click(function () {
        if($(".text").hasClass("show-more-height")) {
            $(this).addClass("activeText");
        } else {
            $(this).addClass("removeText");
        }
        $(".text").toggleClass("show-more-height");
    });
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }

  //get events section
  function fnGetTestimonialSection() {
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getTestimonialSection",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);
        // var event_height = $(".eventDetails img").height();
        // var event_width = $(".eventDetails img").width();
        // $(".eventDetails").css("height", event_height);
        // $(".eventDetails").css("width", event_width);
        $("#testimonialSection").html("");
        $("#testimonialSection").html(data.output);
        $("p:empty").remove();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
