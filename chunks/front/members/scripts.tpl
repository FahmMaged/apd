<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    fnGetMembers(1);

    console.log("HERE");

    $("#locationID").change(function() {
      locationID = $("#locationID").val();
      // getCoursesList(catID);
      console.log("HERE11");
      console.log(locationID);
    });
  });

  //get all items
  function fnGetMembers(toPage) {
    $("#loadingContainer").show();
    $("#loadMore").hide();

    var location = 0;
    console.log($("#locationID").val());

    location = $("#locationID").val();

    var city = 0;
    city = $("#cityID").val();

    $.ajax({
      url: "handlers/MembersHandler.php",
      type: "POST",
      data: {
        operation: "getAllMembersFront",
        currentpage: toPage,
        location: location,
        city: city,
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
