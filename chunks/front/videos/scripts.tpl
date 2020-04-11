<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    fnGetVideos(1);
  });

  //get all items
  function fnGetVideos(toPage) {
    $("#loadingContainer").show();
    $("#loadMore").hide();
    $.ajax({
      url: "handlers/VideosHandler.php",
      type: "POST",
      data: {
        operation: "getAllVideosFront",
        currentpage: toPage,
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
