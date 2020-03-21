<script type="text/javascript">
  $(document).ready(function() {
    fnGetSliderItems();
    fnGetAboutSection();
    fnGetNewsSection();
    fnGetEventsSection();
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
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#newsSection").html("");
        $("#newsSection").html(data.output);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }
  //get events section
  function fnGetEventsSection() {
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getEventsSection",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);
        var event_height = $(".eventDetails img").height();
        var event_width = $(".eventDetails img").width();
        $(".eventDetails").css("height", event_height);
        $(".eventDetails").css("width", event_width);
        $("#eventsSection").html("");
        $("#eventsSection").html(data.output);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
