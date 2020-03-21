<script type="text/javascript">
console.log("HERE");
    var currPage = parseInt($("#currPage").val());
    $(document).ready(function() {
        fnGetNews(1);

    });

    //get all items
    function fnGetNews(toPage) {
        $("#loadingContainer").show();
        $("#loadMore").hide();
        $.ajax({
            url: 'handlers/NewsHandler.php',
            type: 'POST',
            data: {
                operation: 'getAllNewsFront',
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