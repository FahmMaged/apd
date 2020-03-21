<script type="text/javascript">
    var currPage  = parseInt($("#currPage").val());
    var eventMonth;
    $(document).ready(function() {
        fnGetEvents(eventMonth);

        // GetAll When Change Time
        $("#eventMonth").change(function(){
            eventMonth = parseInt($("#eventMonth").val());
            fnGetEvents(eventMonth);
        });

    });

    //get all items
    function fnGetEvents(date) {
        $("#loadingContainer").show();
        $("#loadMore").hide();
        $.ajax({
            url: 'handlers/EventsHandler.php',
            type: 'POST',
            data: {
                operation: 'getAllEventsFront',
                eventMonth: date,
                lang: $('#lang').val()
            },
            success: function(data) {
                var data = JSON.parse(data);

                $("#contentContainer").html('');
                $("#contentContainer").html(data.output);

                $("#loadingContainer").hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);

                $("#loadingContainer").hide();
            }
        });
    }

</script>