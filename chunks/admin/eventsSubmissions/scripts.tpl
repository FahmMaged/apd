<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    getAll(1, 0);

    // Load More button
    $("#loadMore").on("click", function(event) {
      currPage = currPage + 1;

      getAll(currPage, 1);
    });
  });
  //get all items
  function getAll(toPage, type) {
    $("#loadingContainer").show();
    $.ajax({
      url: "../handlers/EventsSubmissionsHandler.php",
      type: "POST",
      data: { operation: "getAll", currentpage: toPage },
      success: function(data) {
        if (type == 0) {
          $("#contentContainer").html("");
          $("#contentContainer").html(data);
        } else if (type == 1) {
          $("#contentContainer").append(data);
        }

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

        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);

        $("#loadingContainer").hide();
      }
    });
  }

  //delete item
  function fnDel(itemID) {
    swal(
      {
        title: "Are you sure?",
        text: "This submission will be deleted.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function() {
        $("#loadingContainer").show();
        $.ajax({
          url: "../handlers/EventsSubmissionsHandler.php",
          type: "POST",
          data: { itemID: itemID, operation: "delete" },
          success: function(data) {
            swal("Deleted!", "submission has been deleted.", "success");
            getAll(1, 0);

            $("#loadingContainer").hide();
          },
          error: function(xhr, ajaxOptions, thrownError) {
            $("#loadingContainer").hide();
          }
        });
      }
    );
  }
</script>
