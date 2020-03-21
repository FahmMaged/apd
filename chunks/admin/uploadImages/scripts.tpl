<script type="text/javascript">
    $(document).ready(function() {

        fnOpenEdit();
    //edit validations
        $("#btnSave").click(function(event) {
            event.preventDefault();

            isValid = true;
        $('#editGL .validate').each(function () {
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
            $("#editGL").submit();
        });

    //edit form submission
        $("#editGL").submit(function(event) {
         event.preventDefault();

            $("#loadingContainer").show();

        var values = new FormData($(this)[0]); 

        $.ajax({
          url: "../handlers/MainImagesHandler.php",
          type: "post",
          data: values,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
        
            $('#editGL')[0].reset();
            $("#loadingContainer").hide();
                    // $('#editModal').closeModal();
                    swal({
                        title: "Form Edited",
                        // text: "Item has been Edited.",
                        type: "success",
                        confirmButtonText: "Close"
                    },  function(isConfirm2) {
                        if (isConfirm2)
                            location.reload();
                    });
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
        $('#loadingContainer').show();

        $.ajax({
            url: "../handlers/MainImagesHandler.php",
            type: "POST",
            data: { operation: 'get',  currID: 1 },
        dataType : 'json',
            success: function(Home) {
                
                // $('#itemID').val(Home.ID);
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
