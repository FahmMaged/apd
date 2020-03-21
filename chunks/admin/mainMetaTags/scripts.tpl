<script type="text/javascript">
  $(document).ready(function() {
    fnOpenEdit();
    $("#editTabs").tabs("select_tab", "EditTabAr");
    //edit validations
    $("#btnSave").click(function(event) {
      event.preventDefault();

      isValid = true;
      //$('#editGL .validate').each(function () {
      //	if ($.trim($(this).val()) == "") {
      //		swal({
      //            title: "Required Fields",
      //			text: "Fields has * next to it are required",
      //			type: "error",
      //            confirmButtonText: "Close"
      //        });
      //		isValid = false;
      //		return;
      //	}
      //});

      if (!isValid) return;
      $("#editGL").submit();
    });

    //edit form submission
    $("#editGL").submit(function(event) {
      event.preventDefault();

      $("#loadingContainer").show();

      var values = new FormData($(this)[0]);
      console.log(values);
      return;

      $.ajax({
        url: "../handlers/MetaTagsHandler.php",
        type: "post",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $("#editGL")[0].reset();
          $("#loadingContainer").hide();
          // $('#editModal').closeModal();
          swal(
            {
              title: "Form Edited",
              // text: "Item has been Edited.",
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

  //get the edit information for this Item
  function fnOpenEdit() {
    tinyMCE.triggerSave();
    $("#loadingContainer").show();

    $.ajax({
      url: "../handlers/MetaTagsHandler.php",
      type: "POST",
      data: { operation: "get", currID: 1 },
      dataType: "json",
      success: function(item) {
        if ($("#editHomeFlag").val() != 1) $("#btnSave").hide();
        else $("#btnSave").show();

        $("#itemID").val(item.ID);

        $("#AboutTitle").val(item.AboutTitle_en);
        if (item.AboutDescription != undefined && item.AboutDescription != "") {
          // { $('#AboutDescription').froalaEditor('html.set', item.AboutDescription_en);}
          tinyMCE.get("AboutDescription").setContent(item.AboutDescription_en);
        }

        $("#HomeTitle").val(item.HomeTitle_en);
        if (item.HomeDescription != undefined && item.HomeDescription != "") {
          // { $('#HomeDescription').froalaEditor('html.set', item.HomeDescription_en);}
          tinyMCE.get("HomeDescription").setContent(item.HomeDescription_en);
        }

        $("#FacilitiesTitle").val(item.FacilitiesTitle_en);
        if (
          item.FacilitiesDescription != undefined &&
          item.FacilitiesDescription != ""
        ) {
          // { $('#FacilitiesDescription').froalaEditor('html.set', item.FacilitiesDescription_en);}
          tinyMCE
            .get("FacilitiesDescription")
            .setContent(item.FacilitiesDescription_en);
        }

        $("#NewsTitle").val(item.NewsTitle_en);
        if (item.NewsDescription != undefined && item.NewsDescription != "") {
          // { $('#NewsDescription').froalaEditor('html.set', item.NewsDescription_en);}
          tinyMCE.get("NewsDescription").setContent(item.NewsDescription_en);
        }

        $("#GalleryTitle").val(item.GalleryTitle_en);
        if (
          item.GalleryDescription != undefined &&
          item.GalleryDescription != ""
        ) {
          // { $('#GalleryDescription').froalaEditor('html.set', item.GalleryDescription_en);}
          tinyMCE
            .get("GalleryDescription")
            .setContent(item.GalleryDescription_en);
        }

        $("#ContactTitle").val(item.ContactTitle_en);
        if (
          item.ContactDescription != undefined &&
          item.ContactDescription != ""
        ) {
          // { $('#ContactDescription').froalaEditor('html.set', item.ContactDescription_en);}
          tinyMCE
            .get("ContactDescription")
            .setContent(item.ContactDescription_en);
        }

        // Arabic
        $("#AboutTitle_ar").val(item.AboutTitle_ar);
        if (
          item.AboutDescription_ar != undefined &&
          item.AboutDescription_ar != ""
        ) {
          // { $('#AboutDescription_ar').froalaEditor('html.set', item.AboutDescription_ar);}
          tinyMCE
            .get("AboutDescription_ar")
            .setContent(item.AboutDescription_ar);
        }

        $("#HomeTitle_ar").val(item.HomeTitle_ar);
        if (
          item.HomeDescription_ar != undefined &&
          item.HomeDescription_ar != ""
        ) {
          // { $('#HomeDescription_ar').froalaEditor('html.set', item.HomeDescription_ar);}
          tinyMCE.get("HomeDescription_ar").setContent(item.HomeDescription_ar);
        }

        $("#FacilitiesTitle_ar").val(item.FacilitiesTitle_ar);
        if (
          item.FacilitiesDescription_ar != undefined &&
          item.FacilitiesDescription_ar != ""
        ) {
          // { $('#FacilitiesDescription_ar').froalaEditor('html.set', item.FacilitiesDescription_ar);}
          tinyMCE
            .get("FacilitiesDescription_ar")
            .setContent(item.FacilitiesDescription_ar);
        }

        $("#NewsTitle_ar").val(item.NewsTitle_ar);
        if (
          item.NewsDescription_ar != undefined &&
          item.NewsDescription_ar != ""
        ) {
          // { $('#NewsDescription_ar').froalaEditor('html.set', item.NewsDescription_ar);}
          tinyMCE.get("NewsDescription_ar").setContent(item.NewsDescription_ar);
        }

        $("#GalleryTitle_ar").val(item.GalleryTitle_ar);
        if (
          item.GalleryDescription_ar != undefined &&
          item.GalleryDescription_ar != ""
        ) {
          // { $('#GalleryDescription_ar').froalaEditor('html.set', item.GalleryDescription_ar);}
          tinyMCE
            .get("GalleryDescription_ar")
            .setContent(item.GalleryDescription_ar);
        }

        $("#ContactTitle_ar").val(item.ContactTitle_ar);
        if (
          item.ContactDescription_ar != undefined &&
          item.ContactDescription_ar != ""
        ) {
          // { $('#ContactDescription_ar').froalaEditor('html.set', item.ContactDescription_ar);}
          tinyMCE
            .get("ContactDescription_ar")
            .setContent(item.ContactDescription_ar);
        }

        Materialize.updateTextFields();
        $("#loadingContainer").hide();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $("#loadingContainer").hide();
      }
    });
  }
</script>
