

<script type="text/javascript">

    //get all items
    function getMedia(toPage) {
        $("#loadingContainer").show();
        var imported = document.createElement('script');
        imported.src = 'scripts/jquery.isotope.min.js';
        document.head.appendChild(imported);
        $.ajax({
            url: 'handlers/VideosHandler.php',
            type: 'POST',
            data: {
                operation: 'getMedia',
                currentpage: toPage,
                lang: $('#lang').val()
            },
            success: function(data) {
                var data = JSON.parse(data);
                $("#contentContainer").html('');
                $("#contentContainer").html(data.media);
                $("#pagination").html('');
                $("#pagination").html(data.pagination);
                $("#loadingContainer").hide();
                    
                var $container = $('.portfolioContainer');
                $container.isotope('destroy');
                $('.portfolioFilter .current').removeClass('current');
                $('#all').addClass('current');
                $container.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                 
                $('.portfolioFilter a').click(function(){
                    $('.portfolioFilter .current').removeClass('current');
                    $(this).addClass('current');
                
                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                        });
                        return false;
                });

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);

                $("#loadingContainer").hide();
            }
        });
    }

    $(document).ready(function() {
        getMedia(1);
    });
</script>