<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    getAll(1, 0);

    // Load More button
    $("#loadMore").on("click", function(event) {
      currPage = currPage + 1;

      getAll(currPage, 1);
    });

    //open the add modal
    $("#addCategory").on("click", function(event) {
      event.preventDefault();
      $("#addCategoryModal").openModal();
      $("#addTabs").tabs("select_tab", "TabEN");
    });

    //save button in the add Category modal
    $("#btnCategoryAdd").click(function(event) {
      event.preventDefault();

      isValid = true;

      //form validations
      $("#addGLI .validate").each(function() {
        if ($.trim($(this).val()) == "") {
          swal({
            title: "Required Fields",
            text: "Fields has * next to it are required",
            type: "error",
            confirmButtonText: "Close"
          });
          isValid = false;
          return;
        }
      });

      if (!isValid) return;

      //submit the form after validations
      $("#addGLI").submit();
    });
    // show and hide parent list
    var isParent = 0;
    var parentID = 0;
    $("#hide").show();
    $(".hideDesc").hide();
    $("#isParent").change(function() {
      if ($("#isParent").is(":checked")) {
        $("#hide").hide();
        $(".hideDesc").show();
        isParent = 1;
        parentID = 0;
      } else {
        $("#hide").show();
        $(".hideDesc").hide();
        isParent = 0;
        parentID = $("#parentID").val();
      }
    });
    //add News submission
    $("#addGLI").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      $.ajax({
        url: "../handlers/MemberCategoriesHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#addGLI")[0].reset();
          getAll(1, 0);
          $("#loadingContainer").hide();
          $("#addCategoryModal").closeModal();

          swal({
            title: "Category Created",
            text: "Category has been Created.",
            type: "success",
            confirmButtonText: "Close"
          });
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });

    //edit News validations
    $("#btnCategoryEdit").click(function(event) {
      event.preventDefault();
      isValid = true;
      $("#editGLI .validate").each(function() {
        if ($.trim($(this).val()) == "") {
          swal({
            title: "Required Fields",
            text: "Fields has * next to it are required",
            type: "error",
            confirmButtonText: "Close"
          });
          isValid = false;
          return;
        }
      });

      if (!isValid) return;
      $("#editGLI").submit();
    });
    //edit News form submission
    $("#editGLI").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      $.ajax({
        url: "../handlers/MemberCategoriesHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#editGLI")[0].reset();
          $("#loadingContainer").hide();
          getAll(1, 0);
          $("#editCategoryModal").closeModal();

          swal({
            title: "Category Edited",
            text: "Category has been Edited.",
            type: "success",
            confirmButtonText: "Close"
          });
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });
  });

  //get the edit information for this item
  function fnOpenEdit(itemID) {
    $("#loadingContainer").show();

    $.ajax({
      url: "../handlers/MemberCategoriesHandler.php",
      type: "POST",
      data: { operation: "get", itemID: itemID },
      //dataType : 'json',
      success: function(item) {
        item = $.parseJSON(item);
        $("#editGLI")[0].reset();
        $("#itemID").val(item.ID);
        $("#edit_Title_en").val(item.Title_en);
        $("#edit_Title_ar").val(item.Title_ar);
        $("#edit_sort").val(item.Sort);

        // $('#edit_parentID').val(item.ParentID);
        $("#editParentID option[value=" + item.ParentID + "]").attr(
          "selected",
          "selected"
        );
        $("#editParentID").material_select();
        Materialize.updateTextFields();
        $("#editCategoryModal").openModal();
        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $("#loadingContainer").hide();
      }
    });
  }

  //get all items
  function getAll(toPage, type) {
    $("#loadingContainer").show();
    $.ajax({
      url: "../handlers/MemberCategoriesHandler.php",
      type: "POST",
      data: { operation: "getAll", currentpage: toPage },
      success: function(data) {
        if (type == 0) {
          $("#contentContainerc").html("");
          $("#contentContainerc").html(data);
        } else if (type == 1) {
          $("#contentContainerc").append(data);
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
        text: "This Category will be deleted.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function() {
        $("#loadingContainer").show();
        $.ajax({
          url: "../handlers/MemberCategoriesHandler.php",
          type: "POST",
          data: { itemID: itemID, operation: "delete" },
          success: function(data) {
            //     swal("Deleted!", "News has been deleted.", "success", function(isConfirm2) {
            //     if (isConfirm2)
            //         location.reload();
            // });
            swal({
              title: "Category Deleted",
              text: "Category has been Deleted.",
              type: "success",
              confirmButtonText: "Close"
            });
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
