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
            tinyMCE.triggerSave();
            $("#loadingContainer").show();

    		var values = new FormData($(this)[0]); 

    		$.ajax({
    			url: "../handlers/AboutHandler.php",
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
            url: "../handlers/AboutHandler.php",
            type: "POST",
            data: { operation: 'get',  currID: 1 },
    		dataType : 'json',
            success: function(Home) {
                
                $('#itemID').val(Home.ID);
                $('#first_edit_title_en').val(Home.FirstTitle_en);
                $('#first_edit_title_ar').val(Home.FirstTitle_ar);

                setTimeout(function(){ tinyMCE.get('first_edit_description_en').setContent(Home.FirstDescription_en); }, 3000);
                setTimeout(function(){ tinyMCE.get('first_edit_description_ar').setContent(Home.FirstDescription_ar); }, 3000);
                setTimeout(function(){ tinyMCE.get('second_edit_description_en').setContent(Home.SecondDescription_en); }, 3000);
                setTimeout(function(){ tinyMCE.get('second_edit_description_ar').setContent(Home.SecondDescription_ar); }, 3000);
                setTimeout(function(){ tinyMCE.get('third_edit_description_en').setContent(Home.ThirdDescription_en); }, 3000);
                setTimeout(function(){ tinyMCE.get('third_edit_description_ar').setContent(Home.ThirdDescription_ar); }, 3000);
                setTimeout(function(){ tinyMCE.get('fourth_edit_description_en').setContent(Home.FourthDescription_en); }, 3000);
                setTimeout(function(){ tinyMCE.get('fourth_edit_description_ar').setContent(Home.FourthDescription_ar); }, 3000);
                
                $('#second_edit_title_en').val(Home.SecondTitle_en);
                $('#second_edit_title_ar').val(Home.SecondTitle_ar);

                $('#third_edit_title_en').val(Home.ThirdTitle_en);
                $('#third_edit_title_ar').val(Home.ThirdTitle_ar);
                

                $('#fourth_edit_title_en').val(Home.FourthTitle_en);
                $('#fourth_edit_title_ar').val(Home.FourthTitle_ar);

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
