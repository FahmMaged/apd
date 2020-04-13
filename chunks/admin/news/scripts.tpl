<script type="text/javascript">
  var currPage = parseInt($("#currPage").val());
  $(document).ready(function() {
    getAll(1, 0);
    var status = $("#status").val();

    if (status == 1) {
      $("#page_status").prop("checked", true);
    } else $("#page_status").prop("checked", false);

    //show or hide News page
    var pageStatus = status;

    $("#page_status").on("change", function(event) {
      event.preventDefault();
      $("#loadingContainer").show();

      if ($("#page_status").is(":checked")) {
        pageStatus = 1;
        $("#page_status").prop("checked", false);
      } else {
        pageStatus = 0;

        $("#page_status").prop("checked", true);
      }

      $.ajax({
        url: "../handlers/NewsHandler.php",
        type: "POST",
        data: { pageStatus: pageStatus, operation: "set" },
        success: function(data) {
          location.reload();
          $("#loadingContainer").hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          $("#loadingContainer").hide();
        }
      });
    });

    //Initialize datepicker
    $(".datepicker").pickadate({
      selectMonths: true, // Creates a dropdown to control month
      container: "body",
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

    //open the upload modal
    $("#uploadNews").on("click", function(event) {
      event.preventDefault();
      $("#uploadNewsModal").openModal();
    });

    //save button in the upload News modal
    $("#btnNewsUpload").click(function(event) {
      event.preventDefault();

      isValid = true;

      //form validations
      $("#uploadGLI .validate").each(function() {
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
      $("#uploadGLI").submit();
    });

    //upload News submission
    $("#uploadGLI").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);

      $.ajax({
        url: "../handlers/NewsHandler.php",
        type: "POST",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#uploadGLI")[0].reset();
          getAll(1, 0);
          $("#loadingContainer").hide();
          $("#uploadNewsModal").closeModal();

          swal(
            {
              title: "News Uploaded",
              text: "News has been Uploaded.",
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

      var inHome = 0;
      if ($("#inHome").is(":checked")) {
        inHome = 1;
      }
      values.append("inHome", inHome);

      $.ajax({
        url: "../handlers/NewsHandler.php",
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
              title: "News Created",
              text: "News has been Created.",
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

      var editInHome = 0;
      if ($("#edit_inHome").is(":checked")) {
        editInHome = 1;
      }
      values.append("edit_inHome", editInHome);

      $.ajax({
        url: "../handlers/NewsHandler.php",
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
              title: "News Edited",
              text: "News has been Edited.",
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
      tinyMCE.triggerSave();
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
        url: "../handlers/NewsHandler.php",
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
      url: "../handlers/NewsHandler.php",
      type: "POST",
      data: { operation: "getPageContent", itemID: currID },
      dataType: "json",
      success: function(item) {
        // $('#itemID').val(item.ID);
        $("#page_title").val(item.Title);
        $("#edit_hTitle").val(item.HeadTitle);
        tinyMCE.get("page_description").setContent(item.Description);
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
      url: "../handlers/NewsHandler.php",
      type: "POST",
      data: { operation: "get", itemID: itemID },
      //dataType : 'json',
      success: function(item) {
        item = $.parseJSON(item);
        $("#editGLI")[0].reset();
        $("#itemID").val(item.ID);
        $("#edit_title_en").val(item.Title_en);
        $("#edit_intro_en").val(item.Intro_en);
        $("#edit_alias_en").val(item.Alias_en);
        $("#edit_title_ar").val(item.Title_ar);
        $("#edit_intro_ar").val(item.Intro_ar);
        $("#edit_alias_ar").val(item.Alias_ar);
        $("#edit_sort").val(item.Sort);
        if (item.InHome == 1) {
          $("#edit_inHome").prop("checked", true);
        }
        if (item.IsActive == 1) {
          $("#edit_isActive").prop("checked", true);
        }
        if (item.ForMembers == 1) {
          $("#edit_forMembers").prop("checked", true);
        }
        if (item.Description_en != "" && item.Description_en != null) {
          tinyMCE.get("edit_description_en").setContent(item.Description_en);
        }

        if (item.Description_ar != "" && item.Description_ar != null) {
          tinyMCE.get("edit_description_ar").setContent(item.Description_ar);
        }

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
      url: "../handlers/NewsHandler.php",
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
        text: "This News will be deleted.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function() {
        $("#loadingContainer").show();
        $.ajax({
          url: "../handlers/NewsHandler.php",
          type: "POST",
          data: { itemID: itemID, operation: "delete" },
          success: function(data) {
            //     swal("Deleted!", "News has been deleted.", "success", function(isConfirm2) {
            //     if (isConfirm2)
            //         location.reload();
            // });
            swal(
              {
                title: "News Deleted",
                text: "News has been Deleted.",
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
