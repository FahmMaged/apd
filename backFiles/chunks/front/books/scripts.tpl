<script type="text/javascript">
    var currPage = parseInt($("#currPage").val());
    $(document).ready(function() {
        fnGetBooks(1);

        // Load More button
        $('#loadMore').on('click', function(event) {
            currPage = currPage + 1;

            fnGetBooks(currPage, 1);

        });

        // Send Form
        $("#btnSend").click(function(event) {
            event.preventDefault();

            isValid = true;

            //form validations
            $('#addGLI .validate').each(function () {
                if ($.trim($(this).val()) == "") {
                    if ($('#lang').val() === 'ar') {
                        swal({
                            title: "الحقول المطلوبة",
                            text: "الحقول التي تحتوي على علامة * بجانبها مطلوبة",
                            type: "error",
                            confirmButtonText: "غلق"
                        });
                    } else{
                        swal({
                            title: "Required Fields",
                            text: "Fields has * next to it are required",
                            type: "error",
                            confirmButtonText: "Close"
                        });
                    }
                    
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

            $("#loadingContainer").show();

            var values = new FormData($(this)[0]);

            $.ajax({
                url: 'handlers/ContactHandler.php',
                type: 'POST',
                data: values,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    $('#addGLI')[0].reset();
                    $("#loadingContainer").hide();
                    if ($('#lang').val() === 'ar') {
                        swal({
                            title: "تم ارسال طلبك",
                            text: "نشكرك للتواصل معنا",
                            type: "success",
                            confirmButtonText: "تم"
                        },  function(isConfirm2) {
                            if (isConfirm2)
                                location.reload();
                        });
                    } else{
                        swal({
                            title: "Submitted",
                            text: "Thanks for contact us.",
                            type: "success",
                            confirmButtonText: "Close"
                        },  function(isConfirm2) {
                            if (isConfirm2)
                                location.reload();
                        });
                    }
                    
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);

                    $("#loadingContainer").hide();
                }
            });
        });

    });

    //get all items
    function fnGetBooks(toPage) {
        $("#loadingContainer").show();
        $("#loadMore").hide();
        $.ajax({
            url: 'handlers/BooksHandler.php',
            type: 'POST',
            data: {
                operation: 'getAllBooksFront',
                currentpage: toPage,
                lang: $('#lang').val()
            },
            success: function(data) {
                var data = JSON.parse(data);

                $("#contentContainer").html('');
                $("#contentContainer").html(data.output);
                $("#pagination").html('');
                $("#pagination").html(data.pagination);

                if ($(".totalpages").last().val() == currPage) {
                    $("#loadMore").hide();
                } else {
                    $("#loadMore").show();
                }

                if (!$('.totalpages').length) {
                    $("#loadMore").hide();
                }


                // $('.newsCard p').ellipsis({
                //     row: 4
                // });

                $("#loadingContainer").hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);

                $("#loadingContainer").hide();
            }
        });
    }

</script>