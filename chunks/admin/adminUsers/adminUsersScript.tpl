<script type="text/javascript">
	// Filters
	var userSearch = '';
	var userStatus = '';

	$(document).ready(function() {

		// Search by Name or Email Event Handler
		$('#userSearch').on('keyup', function(event) {
		    if (event.keyCode == 13) {
		        userSearch = $('#userSearch').val();

		        fnGetAll(1, 0);
		    }
		});

		// Filter by Status
		userStatus = $('#statusFilter').is(':checked') ? 1 : 0;

		$('#statusFilter').on('change', function() {
			userStatus = $(this).is(':checked') ? 1 : 0;

			fnGetAll(1, 0);
		});

		// Show/Hide the Add Admin button
        if ($('#addAdminFlag').val() != 1) {
            $('#addAlertBtnCnt').hide();
        } else {
            $('#addAlertBtnCnt').show();
        }
        
        // Show/Hide the Add Roles button
        if ($('#addAdminFlag').val() != 1) {
            $('.services-btns').hide();
        } else {
            $('.services-btns').show();
        }

		// submitAddAdminUserFormBtn Click Event Handler
		$('#submitAddAdminUserFormBtn').on('click', function(event) {
			event.preventDefault();

			isValid = true;

			$('#addAdminUserForm .validate').each(function() {
				if ($.trim($(this).val()) == '') {
					swal({
						title: 'Required Fields',
						text: 'Fields that have * next to it are required',
						type: 'error',
						confirmButtonText: 'Close'
					});
					isValid = false;
					return;
				}
			});

			if (!isValid) return;

			$('#addAdminUserForm').submit();
		});

		// addAdminUserForm Form Submission Event Handler
		$('#addAdminUserForm').on('submit', function(event) {
			event.preventDefault();

			$('#loadingContainer').show();

			var formData = new FormData($(this)[0]);

			$.ajax({
				url: '../handlers/AdminUsersHandler.php',
				type: 'POST',
				data: formData,
				cache: false,
				processData: false,
				contentType: false
			})
			.done(function(data) {
				data = $.parseJSON(data);

				$('#loadingContainer').hide();
				
				if (data.res == 0) {
					Materialize.toast(data.message, 2000);
					return;
				}

				Materialize.toast(data.message, 2000);
				fnGetAll(1, 0);
				$('#addAdminUserForm')[0].reset();
				$('#addAdminModal').closeModal();
			})
			.fail(function() {
				Materialize.toast('Something went wrong. Refresh the page, and try again.', 2000);
				$('#loadingContainer').hide();
			});
		});

		// submitEditAdminUserFormBtn Click Event Handler
		$('#submitEditAdminUserFormBtn').on('click', function(event) {
			event.preventDefault();

			isValid = true;

			$('#editAdminUserForm .validate').each(function() {
				if ($.trim($(this).val()) == '') {
					swal({
						title: 'Required Fields',
						text: 'Fields has * next to it are required',
						type: 'error',
						confirmButtonText: 'Close'
					});
					isValid = false;
					return;
				}
			});

			if (!isValid) return;

			$('#editAdminUserForm').submit();
		});

		// editAdminUserForm Form Submission Event Handler
		$('#editAdminUserForm').on('submit', function(event) {
			event.preventDefault();

			$('#loadingContainer').show();

			var formData = new FormData($(this)[0]);

			$.ajax({
				url: '../handlers/AdminUsersHandler.php',
				type: 'POST',
				data: formData,
				cache: false,
				processData: false,
				contentType: false
			})
			.done(function(data) {
				data = $.parseJSON(data);

				$('#loadingContainer').hide();
				
				if (data.res == 0) {
					Materialize.toast(data.message, 2000);
					return;
				}

				Materialize.toast(data.message, 2000);
				fnGetAll(1, 0);
				$('#editAdminUserForm')[0].reset();
				$('#editAdminModal').closeModal();
			})
			.fail(function() {
				Materialize.toast('Something went wrong. Refresh the page, and try again.', 2000);
				$('#loadingContainer').hide();
			});
		});

		// Load More Button Click Event Handler
		$('#loadMoreBtn').on('click', function(event) {
		    event.preventDefault();

		    var currP = parseInt($('#currPage').val());
		    $('#currPage').val(currP + 1);
		    fnGetAll($('#currPage').val(), 1);
		});

		// Change View Switch Click Evvent Handler
		$('#view-switch').click(function() {
		    if (this.checked == true) {
		        $('.singleUser').removeClass("m4");
		        $('.singleUser').addClass("m12");
		        $('.user-widget').css("height", "90px");
		        $('.user-widget').css("overflow", "hidden");
		        $('.user-widget').css("position", "relative");
		        $('.userText').css('display', 'inline-block');
		        $('.userText').css('margin-right', '10px');
		        $('.white-text').addClass('col s11 right');
		        $('.white-text').css('padding-top', '10px');
		        $('.deleteUsr').css('position', 'absolute');
		        $('.deleteUsr').css('right', '90px');
		    }

		    if (this.checked == false) {
		        $('.singleUser').addClass("m4");
		        $('.singleUser').removeClass("m12");
		        $('.user-widget').css("height", "auto");
		        $('.user-widget').css("overflow", "hidden");
		        $('.user-widget').css("position", "relative");
		        $('.userText').css('display', 'block');
		        $('.userText').css('margin-right', '0px');
		        $('.white-text').removeClass('col s11 right');
		        $('.white-text').css('padding-top', '0px');
		        $('.deleteUsr').css('position', 'relative');
		        $('.deleteUsr').css('right', 'auto');
		    }
		});

		// Call the fnGetAll method
		fnGetAll(1, 0);
		
	});

	$('#loadMoreBtn').hide();
	// fnGetAll: Get All Admin Users
	function fnGetAll(toPage, type) {
		$('#loadingContainer').show();

		$.ajax({
			url: '../handlers/AdminUsersHandler.php',
			type: 'POST',
			data: {
				operation: 'getAll',
				userSearch: userSearch,
				userStatus: userStatus,
				currentpage: toPage
			}
		})
		.done(function(data) {
			if (type == 0) {
			    $('#adminsList').html(data);
			} else if(type == 1) {
			    $('#adminsList').append(data);
			}

			fnResetCardsView();

			if ($('.singleUser').length > 0) {
			    $('#controls').show();
			} else {
			    $('#controls').hide();
			    $('#loadMoreBtn').hide();
			}

			if ($('.totalpages').last().val() == $('#currPage').val()
				|| $('.totalpages').last().val() == 0
				|| $('.totalpages').last().val() == undefined) {
			    $('#loadMoreBtn').hide();
			} else {
			    $('#loadMoreBtn').show();
			}

			if ($('#editAdminFlag').val() != 1)
                    $('.edit-btn').hide();
                else
                    $('.edit-btn').show();

                if ($('#deleteAdminFlag').val() != 1)
                    $('.delete-btn').hide();
                else
                    $('.delete-btn').show();

			$('#loadingContainer').hide();
		})
		.fail(function() {
			Materialize.toast('Something went wrong. Refresh the page, and try again.', 2000);
			$('#loadingContainer').hide();
		});
	}

	// fnEdit: Get Admin Details & Open the Edit Modal
	function fnEdit(userID) {
		$('#loadingContainer').show();

		$.ajax({
			url: '../handlers/AdminUsersHandler.php',
			type: 'POST',
			data: { operation: 'getUser', userID: userID }
		})
		.done(function(data) {
			data = $.parseJSON(data);

			$('#loadingContainer').hide();

			if (data.res == 0) {
				Materialize.toast(data.message, 2000);
				return;
			}

			data = data.message;
			
			$('#editAdminUserForm input[name="userID"]').val(userID);
			$('#editAdminUserForm #edit-admin-firstname').val(data.FirstName);
			$('#editAdminUserForm #edit-admin-lastName').val(data.LastName);
			$('#editAdminUserForm #edit-admin-email').val(data.Email);

			$('#editAdminUserForm #editIsActive').prop('checked', data.IsActive);
			$('#editAdminUserForm #editIsSuperAdmin').prop('checked', data.IsSuperAdmin);
			$('#editAdminUserForm #editCanManageSuperAdmins').prop('checked', data.CanManageSuper);

			Materialize.updateTextFields();
			$('#editAdminModal').openModal();
		})
		.fail(function() {
			Materialize.toast('Something went wrong. Refresh the page, and try again.', 2000);
			$('#loadingContainer').hide();
		});
	}

	// fnResetCardsView: Reset Cards View
	function fnResetCardsView() {
	    var checkbox = document.getElementById('view-switch');

	    if (checkbox.checked == true) {
	        $('.singleUser').removeClass("m4");
	        $('.singleUser').addClass("m12");
	        $('.user-widget').css("height", "90px");
	        $('.user-widget').css("overflow", "hidden");
	        $('.user-widget').css("position", "relative");
	        $('.userText').css('display', 'inline-block');
	        $('.userText').css('margin-right', '10px');
	        $('.white-text').addClass('col s11 right');
	        $('.white-text').css('padding-top', '10px');
	        $('.deleteUsr').css('position', 'absolute');
	        $('.deleteUsr').css('right', '90px');
	    } else {
	        $('.singleUser').addClass("m4");
	        $('.singleUser').removeClass("m12");
	        $('.user-widget').css("height", "auto");
	        $('.user-widget').css("overflow", "hidden");
	        $('.user-widget').css("position", "relative");
	        $('.userText').css('display', 'block');
	        $('.userText').css('margin-right', '0px');
	        $('.white-text').removeClass('col s11 right');
	        $('.white-text').css('padding-top', '0px');
	        $('.deleteUsr').css('position', 'relative');
	        $('.deleteUsr').css('right', 'auto');
	    }
	}

	// fnDelete: Delete Admin User
	function fnDelete(userID) {
	    swal({
	        title: 'Are you sure?',
	        text: 'You are about to delete this user.',
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, I am sure.',
	        cancelButtonText: 'No, cancel.',
	        confirmButtonClass: 'confirm-class',
	        cancelButtonClass: 'cancel-class',
	        closeOnConfirm: true,
	        closeOnCancel: true
	    }, function(isConfirm) {
	        if (isConfirm) {
	        	$('#loadingContainer').show();

	            $.ajax({
	                url: '../handlers/AdminUsersHandler.php',
	                type: 'POST',
	                data: { operation: 'delete', userID : userID }
	            })
	            .done(function(data) {
	                data = $.parseJSON(data);

	                $('#loadingContainer').hide();

	                if (data.res == 0) {
	                	Materialize.toast(data.message, 2000);
	                	return;
	                }

	                Materialize.toast(data.message, 2000);
	                fnGetAll(1, 0);
	            })
	            .fail(function() {
	                Materialize.toast('Something went wrong. Refresh the page, and try again.', 2000);
	                $('#loadingContainer').hide();
	            });
	        }
	    });
	}
</script>