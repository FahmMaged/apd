<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    fnGetEvents(currPage);
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
