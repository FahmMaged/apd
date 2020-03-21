<script type="text/javascript">
    $(document).ready(function() {

        fnOpenEdit();
        $('#editTabs').tabs('select_tab', 'EditTabAr');
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
    			url: "../handlers/HomeHandler.php",
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
            url: "../handlers/HomeHandler.php",
            type: "POST",
            data: { operation: 'get',  currID: 1 },
    		dataType : 'json',
            success: function(Home) {
                
                $('#itemID').val(Home.ID);
                $('#edit_title_en').val(Home.Title_en);
                $('#edit_title_ar').val(Home.Title_ar);
                //tinyMCE.get('edit_description_en').setContent(Home.Description_en);
                //tinyMCE.get('edit_description_ar').setContent(Home.Description_ar);
                setTimeout(function(){ tinyMCE.get('edit_description_en').setContent(Home.Description_en); }, 3000);
                setTimeout(function(){ tinyMCE.get('edit_description_ar').setContent(Home.Description_ar); }, 3000);
                $('#edit_link').val(Home.Link);
                $('#edit_views').val(Home.NumberOfViews);
                $('#addTabsEdit').tabs('select_tab', 'TabAREdit');
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
