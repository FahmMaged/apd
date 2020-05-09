<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  var categoryID = 0;
  $(document).ready(function() {
    fnGetEvents(currPage);

    $("#categoryID select").on("change", function() {
      categoryID = $(this).val();
    });
  });

  //get all items
  function fnGetEvents(toPage) {
    $("#loadingContainer").show();
    $("#loadMore").hide();
    $.ajax({
      url: "handlers/EventsHandler.php",
      type: "POST",
      data: {
        operation: "getAllEventsFront",
        currentpage: toPage,
        categoryID: categoryID,
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);

        $("#contentContainer").html("");
        $("#contentContainer").html(data.output);
        $("#pagination").html("");
        $("#pagination").html(data.pagination);

        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);

        $("#loadingContainer").hide();
      }
    });
  }
</script>
