[[+head]]    
[[+header]]    

<section class="headerInner" style="background-image: url('[[+mainImage]]')">
    <div class="overlay">
        <div class="titles">
            <h3>[[+headerTitle]]
            </h3>
        </div>
    </div>
</section>
<!-- HEADER-END -->
<section class="questions">
    <div class="container">
        <ul class="collapsible" data-aos="fade-up">
            [[+questionsTPL]]
            
        </ul>
    </div>
</section>
    <section class="sendQuestions">
    <form id="addGLI">
        <div class="container">
            <div class="row">
                    <h2>[[+forMore]]</h2>
                    <input type="hidden" name="operation" value="sendQuestionMail">
                    <div class="col s12 m6 l6">
                            <input placeholder="[[+firstName]]*" name="first_name" type="text" class="validate">
                    </div>
                  
                    <div class="col s12 m6 l6">
                            <input placeholder="[[+lastName]]*" name="family_name" type="text" class="validate">
                    </div>
                   
            </div>
            <div class="row">
                    <div class="col s12 m6 l6">
                            <input placeholder="[[+phoneNumber]]*" name="phone" type="text" class="validate">
                    </div>
                
                <div class="col s12 m6 l6">
                            <input placeholder="[[+email]]" name="email" type="text" class="validate">
                    </div>
                
            </div>
            <div class="row">
                    <div class="col s12 m6 l12">
                            <textarea name="message" name="subject" placeholder="[[+message]]"></textarea>
                    </div>
                    <a href="#" id="btnSend">[[+send]]</a>

            </div>
        </div>
    </form>
    </section>

[[+footer]]

<script type="text/javascript">
        //get all items
            //save button in the add News modal
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

            // var inHome = 0;
            // if ($('#inHome').is(':checked')) { inHome = 1; }
            // values.append('inHome', inHome);

            $.ajax({
                url: 'handlers/QuestionsHandler.php',
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
</script>