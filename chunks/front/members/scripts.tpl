<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  var locationID = 0;
  var cityID = 0;
  $(document).ready(function() {
    fnGetMembers(1);

    $("#location2ID select").on("change", function() {
      locationID = $(this).val();
    });

    $("#cityID select").on("change", function() {
      cityID = $(this).val();
    });
  });

  function getCityLocations(cityID) {
    $.ajax({
      url: "handlers/EventsLocationsHandler.php",
      type: "POST",
      data: {
        operation: "getCityLocations",
        cityID: cityID,
        lang: $("#lang").val()
      },
      success: function(data) {
        console.log(data);
        //  return data;
        $("#cityID select").append(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }

  //get all items
  function fnGetMembers(toPage) {
    $("#loadingContainer").show();
    $("#loadMore").hide();

    $.ajax({
      url: "handlers/MembersHandler.php",
      type: "POST",
      data: {
        operation: "getAllMembersFront",
        currentpage: toPage,
        location: locationID,
        city: cityID,
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#contentContainer").html("");
        $("#contentContainer").html(data.output);
        $("#pagination").html("");
        $("#pagination").html(data.pagination);

        if (
          $(".totalpages")
            .last()
            .val() == currPage
        ) {
          $("#loadMore").hide();
        } else {
          $("#loadMore").show();
        }

        if (!$(".totalpages").length) {
          $("#loadMore").hide();
        }

        // $('.newsCard p').ellipsis({
        //     row: 4
        // });

        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);

        $("#loadingContainer").hide();
      }
    });
  }
</script>
