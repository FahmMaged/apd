<script>
  $(document).ready(function() {
    $(".slider").slider();
    $(".aboutVideo").slider("pause");
    $(".indicator-item").on("click", function() {
      $(".aboutVideo").slider("pause");
    });
    var video_height = $(".aboutVideo img").height();
    var video_width = $(".aboutVideo img").width();
    $(".aboutVideo , .aboutVideo .slides").css("max-height", video_height);
    $(".aboutVideo , .aboutVideo .slides").css("max-width", video_width);
  });
</script>
<section class="homeVideo" id="section02">
  <div class="container">
    <div class="row ">
      <div class="aboutVideo slider">
        <img src="images/video.png" />
        <ul class="slides">
          [[+sliderVideosTpl]]
        </ul>
      </div>
    </div>
  </div>
</section>
