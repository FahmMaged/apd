<script type="text/javascript">
  $(document).ready(function() {
    fnGetTestimonialSection();
  });

  //get testimonials section
  function fnGetTestimonialSection() {
    $.ajax({
      url: "handlers/HomeHandler.php",
      type: "POST",
      data: {
        operation: "getTestimonialSection",
        lang: $("#lang").val()
      },
      success: function(data) {
        var data = JSON.parse(data);
        $("#testimonialSection").html("");
        $("#testimonialSection").html(data.output);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    });
  }
</script>
