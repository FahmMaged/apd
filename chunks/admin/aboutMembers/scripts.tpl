<script type="text/javascript">
var currPage = parseInt($("#currPage").val());
    $(document).ready(function() {
		fnGetPage(1, 0);

        // Load More button
        $('#loadMore').on('click', function(event) {
            currPage = currPage + 1 ;

            fnGetPage(currPage, 1);

        });
		//open the add modal
        $('#addItem').on('click', function(event) {
            event.preventDefault();
            $('#addModal').openModal();
            $('#addTabs').tabs('select_tab', 'TabAR');
        });

		//save button in the add modal
        $("#btnAdd").click(function(event) {
            event.preventDefault();

            isValid = true;

            //form validations
    		$('#addGL .validate').each(function () {
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
            $("#addGL").submit();
        });


		//add form submission
        $("#addGL").submit(function(event) {
            event.preventDefault();

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

    				$('#addGL')[0].reset();
    				$("#loadingContainer").hide();
                    $('#addModal').closeModal();
                    swal({
                        title: "Item Created",
                        text: "Item has been Created.",
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


		//edit Item validations
        $("#btnEdit").click(function(event) {
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
    			url: "../handlers/AboutHandler.php",
    			type: "post",
    			data: values,
    			cache: false,
    			contentType: false,
    			processData: false,
    			success: function(data) {
				
    				$('#editGL')[0].reset();
    				$("#loadingContainer").hide();
                    $('#editModal').closeModal();
                    swal({
                        title: "Item Edited",
                        text: "Item has been Edited.",
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
    function fnOpenEdit(currID) {
        $('#loadingContainer').show();

        $.ajax({
            url: "../handlers/AboutHandler.php",
            type: "POST",
            data: { operation: 'getMember',  itemID: currID },
    		dataType : 'json',
            success: function(item) {

                $('#itemID').val(item.ID);
                $('#edit_title_ar').val(item.Title_ar);
                $('#edit_title_en').val(item.Title_en);

                $('#edit_sort').val(item.Sort);

                Materialize.updateTextFields();
                $('#editModal').openModal();
                $('#addTabsEdit').tabs('select_tab', 'TabAR');
                $("#loadingContainer").hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
    			$("#loadingContainer").hide();
            }
        });
    }

	//get all items
    function fnGetPage(toPage, type) {
        $("#loadingContainer").show();
    	$.ajax({
            url: "../handlers/AboutHandler.php",
            type: "post",
            data: { operation: 'getAllMembers', currentpage: toPage },
            success: function(data) {

                if (type == 0) {
    			    $("#contentContainerc").html('');
                    $("#contentContainerc").html(data);
    			} else if (type == 1) {
    			    $("#contentContainerc").append(data);
    			}
                if ($(".totalpages").last().val() == currPage) {
                    $("#loadMore").hide();
                } else {
                    $("#loadMore").show();
                }

                if (!$('.totalpages').length) {
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

	//delete Item
    function fnDel(currID) {
    	swal({
            title: "Are you sure?",
            text: "This Item will be deleted.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            $("#loadingContainer").show();
            $.ajax({
                url: "../handlers/AboutHandler.php",
                type: "post",
                data: { itemID: currID, operation: 'deleteMember' },
                success: function(data) {
                        // swal("Deleted!", "Story has been deleted.", "success");
                        swal({
                        title: "Deleted",
                        text: "Item has been deleted.",
                        type: "success",
                        confirmButtonText: "Close"
                    },  function(isConfirm2) {
                        if (isConfirm2)
                            location.reload();
                    });

                    $("#loadingContainer").hide();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#loadingContainer").hide();
                }
            });
        });
    }
</script>
