<script src="js/lightgallery/lightgallery.min.js"></script>
<script src="js/lightgallery/lg-thumbnail.min.js"></script>
<script src="js/lightgallery/lg-fullscreen.min.js"></script>
<script src="js/lightgallery/lg-share.min.js"></script>
<script src="js/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.min.js"></script>
<script type="text/javascript">
    var currPage = parseInt($("#currPage").val());
    $(document).ready(function () {
        fnGetPage(1, 0);

        // Load More button
        $('#loadMore').on('click', function (event) {
            currPage = currPage + 1;

            fnGetPage(currPage, 1);

        });

        $('#closeFileModal').on('click', function (event) {
            $('#viewModal').closeModal();
        });

        $('#btnCloseUploads').on('click', function (event) {
            $('#uploadModal').closeModal();
        });

        //open the add modal
        $('#addItem').on('click', function (event) {
            event.preventDefault();
            $('#addModal').openModal();
            $('#addTabs').tabs('select_tab', 'TabAR');
        });

        //save button in the add modal
        $("#btnAdd").click(function (event) {
            event.preventDefault();

            isValid = true;
            //form validations
            $('#addGL .validate').each(function () {
                if ($.trim($(this).val()) == "" || $('#pageID').val() == null) {
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
        $("#addGL").submit(function (event) {
            event.preventDefault();
            tinyMCE.triggerSave();
            $("#loadingContainer").show();

            var values = new FormData($(this)[0]);

            $.ajax({
                url: "../handlers/AwarenessHandler.php",
                type: "post",
                data: values,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                        $('#addGL')[0].reset();
                        $("#loadingContainer").hide();
                        $('#addModal').closeModal();
                        swal({
                            title: "Item Created",
                            text: "Item has been Created.",
                            type: "success",
                            confirmButtonText: "Close"
                        }, function (isConfirm2) {
                            if (isConfirm2)
                                location.reload();
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: "Please try again",
                            type: "error",
                            confirmButtonText: "Close"
                        });
                        $("#loadingContainer").hide();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);

                    $("#loadingContainer").hide();
                }
            });
        });


        //edit Item validations
        $("#btnEdit").click(function (event) {
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
        $("#editGL").submit(function (event) {
            event.preventDefault();
            tinyMCE.triggerSave();
            $("#loadingContainer").show();

            var values = new FormData($(this)[0]);

            $.ajax({
                url: "../handlers/AwarenessHandler.php",
                type: "post",
                data: values,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data == 1) {
                        $('#editGL')[0].reset();
                        $("#loadingContainer").hide();
                        $('#editModal').closeModal();
                        swal({
                            title: "Item Edited",
                            text: "Item has been Edited.",
                            type: "success",
                            confirmButtonText: "Close"
                        }, function (isConfirm2) {
                            if (isConfirm2)
                                location.reload();
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: "Please try again",
                            type: "error",
                            confirmButtonText: "Close"
                        });
                        $("#loadingContainer").hide();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
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
            url: "../handlers/AwarenessHandler.php",
            type: "POST",
            data: {
                operation: 'get',
                itemID: currID
            },
            dataType: 'json',
            success: function (item) {
                $('#editGL')[0].reset();
                $('#itemID').val(item.ID);
                $('#edit_title_en').val(item.Title_en);
                $('#edit_title_ar').val(item.Title_ar);
                tinyMCE.get('edit_description_en').setContent(item.Description_en);
                tinyMCE.get('edit_description_ar').setContent(item.Description_ar);
                $('#editSort').val(item.Sort);

                $("#edit_pageID option[value=" + item.PageID + "]").attr("selected", "selected");
                $('#edit_pageID').material_select();

                Materialize.updateTextFields();
                $('#editModal').openModal();
                $('#addTabsEdit').tabs('select_tab', 'TabAREdit');
                $("#loadingContainer").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
                $("#loadingContainer").hide();
            }
        });
    }

    //get all items
    function fnGetPage(toPage, type) {
        $("#loadingContainer").show();
        $.ajax({
            url: "../handlers/AwarenessHandler.php",
            type: "post",
            data: {
                operation: 'getAll',
                currentpage: toPage
            },
            success: function (data) {

                if (type == 0) {
                    $("#contentContainer").html('');
                    $("#contentContainer").html(data);
                } else if (type == 1) {
                    $("#contentContainer").append(data);
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
            error: function (xhr, ajaxOptions, thrownError) {
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
        }, function () {
            $("#loadingContainer").show();
            $.ajax({
                url: "../handlers/AwarenessHandler.php",
                type: "post",
                data: {
                    itemID: currID,
                    operation: 'delete'
                },
                success: function (data) {
                    // swal("Deleted!", "Story has been deleted.", "success");
                    swal({
                        title: "Deleted",
                        text: "Item has been deleted.",
                        type: "success",
                        confirmButtonText: "Close"
                    }, function (isConfirm2) {
                        if (isConfirm2)
                            location.reload();
                    });

                    $("#loadingContainer").hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingContainer").hide();
                }
            });
        });
    }

    function fnUploadFilesModal(itemID) {
        $('#fine-uploader-manual-trigger').fineUploader({
                template: 'qq-template-manual-trigger',
                request: {
                    // Online endpoint goes here
                    // endpoint: 'http://smashclub.thep7analytics.com/handlers/AlbumsHandler.php'
                    endpoint: '../handlers/AwarenessHandler.php'
                },
                thumbnails: {
                    placeholders: {
                        waitingPath: 'js/fine-uploader/fine-uploader/placeholders/waiting-generic.png',
                        notAvailablePath: 'js/fine-uploader/fine-uploader/placeholders/not_available-generic.png'
                    }
                },
                autoUpload: false,
                debug: true
            })
            .on('submitted', function (event, id, name) {
                fileItemContainer = $(this).fineUploader('getItemByFileId', id);
                var extraInputsHTML = '';

                extraInputsHTML += '<div class="row singlePhotoDetails-' + id + '">';
                extraInputsHTML += '<div class="input-field col s6">';
                extraInputsHTML += '<input type="text" name="title">';
                extraInputsHTML += '<label>Title</label>';
                extraInputsHTML += '</div>';
                extraInputsHTML += '</div>';


                $('.singlePhotoDetails-' + id).remove();
                $(fileItemContainer).prepend(extraInputsHTML);
            })
            .on('upload', function (event, id, name) {
                var fileItemContainer = $(this).fineUploader('getItemByFileId', id);
                var title = $(fileItemContainer).find('input[name="title"]').val();

                $(this).fineUploader('setParams', {
                    title: title,
                    itemID: itemID,
                    operation: 'uploadFiles',
                }, id);
            })
            .on('allComplete', function (event, succeeded, failed) {
                Materialize.toast('Files have been uploaded successfully', 2000);
                currPage = 1;
                fnGetPage(currPage, 0);
                $('#uploadModal').closeModal();
            });

        $('#trigger-upload').click(function () {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });

        $('#uploadModal').openModal();
    }


    function fnViewFilesModal(currID) {
        $('#loadingContainer').show();

        $.ajax({
            url: "../handlers/AwarenessHandler.php",
            type: "POST",
            data: { operation: 'getItemPhotos', currID: currID },
            success: function (files) {
                files = JSON.parse(files).message;
                $(".bottom-sheet .modal-content .files").html("");
                $(".bottom-sheet .modal-content .files").html(files);

                $("#viewModal").openModal({
                    //complete: onModalHide
                });

                $('#loadingContainer').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
                $('#loadingContainer').hide();
            }
        });
    }

    //delete file
    function fnDeleteFile(currID) {
        swal({
            title: "Are you sure?",
            text: "This file will be deleted.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $("#loadingContainer").show();
            $.ajax({
                url: "../handlers/AwarenessHandler.php",
                type: "post",
                data: {
                    itemID: currID,
                    operation: 'deleteFile'
                },
                success: function (data) {
                    // swal("Deleted!", "Story has been deleted.", "success");
                    swal({
                        title: "Deleted",
                        text: "file has been deleted.",
                        type: "success",
                        confirmButtonText: "Close"
                    }, function (isConfirm2) {
                        if (isConfirm2)
                            location.reload();
                    });

                    $("#loadingContainer").hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loadingContainer").hide();
                }
            });
        });
    }

</script>
<!-- Fine Uploader Template Start -->
<script type="text/template" id="qq-template-manual-trigger">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="buttons">
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Select files</div>
            </div>
            <button type="button" id="trigger-upload" class="btn btn-primary">
                <i class="icon-upload icon-white"></i> Upload
            </button>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
        <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>
<!-- Fine Uploader Template End -->