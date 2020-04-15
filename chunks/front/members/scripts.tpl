<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  var locationID;
  var cityID;
  $(document).ready(function() {
    fnGetMembers(1);

    $("#locationID select").on("change", function() {
      locationID = $(this).val();
    });
    $("#cityID select").on("change", function() {
      cityID = $(this).val();
    });
  });

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
