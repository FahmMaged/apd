<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    getAll(1, 0);

    //Initialize datepicker
    $(".datepicker").pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $(".datepicker").on("mousedown", function(event) {
      event.preventDefault();
    });

    // Load More button
    $("#loadMore").on("click", function(event) {
      currPage = currPage + 1;

      getAll(currPage, 1);
    });

    //open the add modal
    $("#addNews").on("click", function(event) {
      event.preventDefault();
      $("#addNewsModal").openModal();
      $("#addTabs").tabs("select_tab", "TabAR");
    });

    //save button in the add News modal
    $("#btnNewsAdd").click(function(event) {
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
        // if ($("#locationID").val() == null || $("#locationID").val() == 0) {
        //   swal({
        //     title: "Required Fields",
        //     text: "You should select a location",
        //     type: "error",
        //     confirmButtonText: "Close"
        //   });
        //   isValid = false;
        //   return;
        // }
      });

      if (!isValid) return;

      //submit the form after validations
      $("#addGLI").submit();
    });

    //add News submission
    $("#addGLI").submit(function(event) {
      event.preventDefault();
      tinyMCE.triggerSave();
      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      var isActive = 0;
      if ($("#isActive").is(":checked")) {
        isActive = 1;
      }
      values.append("isActive", isActive);

      var forMembers = 0;
      if ($("#forMembers").is(":checked")) {
        forMembers = 1;
      }
      values.append("forMembers", forMembers);

      //   var inHome = 0;
      //   if ($("#inHome").is(":checked")) {
      //     inHome = 1;
      //   }
      //   values.append("inHome", inHome);

      //   var locationID = 0;
      //   locationID = $("#locationID").val();
      //   values.append("locationID", locationID);

      $.ajax({
        url: "../handlers/EventsHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#addGLI")[0].reset();
          getAll(1, 0);
          $("#loadingContainer").hide();
          $("#addNewsModal").closeModal();

          swal(
            {
              title: "Event Created",
              text: "Event has been Created.",
              type: "success",
              confirmButtonText: "Close"
            },
            function(isConfirm2) {
              if (isConfirm2) location.reload();
            }
          );
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });

    //edit News validations
    $("#btnNewsEdit").click(function(event) {
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
      tinyMCE.triggerSave();
      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      var editIsActive = 0;
      if ($("#edit_isActive").is(":checked")) {
        editIsActive = 1;
      }
      values.append("edit_isActive", editIsActive);

      var editForMembers = 0;
      if ($("#edit_forMembers").is(":checked")) {
        editForMembers = 1;
      }
      values.append("edit_forMembers", editForMembers);

      //   var editInHome = 0;
      //   if ($("#edit_inHome").is(":checked")) {
      //     editInHome = 1;
      //   }
      //   values.append("edit_inHome", editInHome);

      //   var editLocationID = 0;
      //   editLocationID = $("#editLocationID").val();
      //   values.append("edit_locationID", editLocationID);

      $.ajax({
        url: "../handlers/EventsHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#editGLI")[0].reset();
          $("#loadingContainer").hide();
          getAll(1, 0);
          $("#editNewsModal").closeModal();

          swal(
            {
              title: "Event Edited",
              text: "Event has been Edited.",
              type: "success",
              confirmButtonText: "Close"
            },
            function(isConfirm2) {
              if (isConfirm2) location.reload();
            }
          );
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });

    //edit page validations
    $("#btnEditPage").click(function(event) {
      event.preventDefault();
      isValid = true;
      $("#editPage .validate").each(function() {
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
      $("#editPage").submit();
    });

    //edit form submission
    $("#editPage").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      $.ajax({
        url: "../handlers/EventsHandler.php",
        type: "post",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#editPage")[0].reset();
          $("#loadingContainer").hide();
          $("#editPageModal").closeModal();
          swal(
            {
              title: "Page Content Edited",
              text: "Page Content has been Edited.",
              type: "success",
              confirmButtonText: "Close"
            },
            function(isConfirm2) {
              if (isConfirm2) location.reload();
            }
          );
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.responseText);

          $("#loadingContainer").hide();
        }
      });
    });
  });

  //get the edit page information for this Item
  function fnPageEdit(currID) {
    $("#loadingContainer").show();

    $.ajax({
      url: "../handlers/EventsHandler.php",
      type: "POST",
      data: { operation: "getPageContent", itemID: currID },
      dataType: "json",
      success: function(item) {
        // $('#itemID').val(item.ID);
        $("#page_title").val(item.Title);
        $("#edit_hTitle").val(item.HeadTitle);
        //if( page_description!=undefined && page_description!="" ) { $('#page_description').froalaEditor('html.set', item.Description);}

        Materialize.updateTextFields();
        $("#editPageModal").openModal();
        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $("#loadingContainer").hide();
      }
    });
  }

  //get the edit information for this item
  function fnOpenEdit(itemID) {
    $("#loadingContainer").show();

    $.ajax({
      url: "../handlers/EventsHandler.php",
      type: "POST",
      data: { operation: "get", itemID: itemID },
      //dataType : 'json',
      success: function(item) {
        item = $.parseJSON(item);
        $("#editGLI")[0].reset();
        $("#itemID").val(item.ID);
        $("#edit_title_en").val(item.Title_en);
        $("#edit_alias_en").val(item.Alias_en);
        $("#edit_title_ar").val(item.Title_ar);
        $("#edit_alias_ar").val(item.Alias_ar);
        $("#edit_location_ar").val(item.Location_ar);
        $("#edit_location_en").val(item.Location_en);
        $("#edit_time_ar").val(item.Time_ar);
        $("#edit_time_en").val(item.Time_en);
        // $('#edit_start').val(item.StartTime);
        // $('#edit_end').val(item.EndTime);
        $("#edit_sort").val(item.Sort);
        // if (item.InHome == 1) {
        //   $("#edit_inHome").prop("checked", true);
        // }
        if (item.IsActive == 1) {
          $("#edit_isActive").prop("checked", true);
        }
        if (item.ForMembers == 1) {
          $("#edit_forMembers").prop("checked", true);
        }

        // $("#editLocationID option[value=" + item.LocationID + "]").attr("selected", "selected");
        // $('#editLocationID').material_select();
        tinyMCE.get("edit_description_en").setContent(item.Description_en);
        tinyMCE.get("edit_description_ar").setContent(item.Description_ar);

        $("#edit_publish_date").val(item.PublishDate);
        Materialize.updateTextFields();
        $("#editNewsModal").openModal();
        $("#addTabsEdit").tabs("select_tab", "TabAREdit");
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
      url: "../handlers/EventsHandler.php",
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
        text: "This event will be deleted.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function() {
        $("#loadingContainer").show();
        $.ajax({
          url: "../handlers/EventsHandler.php",
          type: "POST",
          data: { itemID: itemID, operation: "delete" },
          success: function(data) {
            //     swal("Deleted!", "News has been deleted.", "success", function(isConfirm2) {
            //     if (isConfirm2)
            //         location.reload();
            // });
            swal(
              {
                title: "Event Deleted",
                text: "Event has been Deleted.",
                type: "success",
                confirmButtonText: "Close"
              },
              function(isConfirm2) {
                if (isConfirm2) location.reload();
              }
            );
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
