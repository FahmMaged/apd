[[+head]]
[[+header]]

    <!-- HEADER -->
    <section class="headerInner" style="background-image: url('[[+mainImage]]')">
        <div class="overlay">
            <div class="titles">
                <h3>[[+headerTitle]]
                </h3>
            </div>
        </div>
    </section>
    <!-- HEADER-END -->
    <section class="eventsInner">
        <div class="container">
            <div class="row">
                <div class="eventsFilter">
                    <div class="s12 m3 l3 col flex1 right main-direction">
                        <div class="input-field col s12">
                            <!-- <input type="text" class="datepicker" id="eventDate" style="direction:rtl;"> -->
                            <select id="eventMonth">
                                <option value="0" selected disabled>[[+filter]]</option>
                                [[+options]]
                            </select>
                        </div>
                        <h5> [[+dateText]] </h5>
                    </div>

<!--                     <div class="s12 m3 l3 col flex1 right" style=" direction: ltr;">
                        <div class="input-field col s12">
                            <select>
                                <option value="" disabled selected> [[+timeText]] </option>
                                <option value="1"> 10 - 12 am </option>
                                <option value="2"> 12 - 12 pm </option>
                                <option value="3"> 10 - 12 pm </option>
                            </select>
                        </div>
                        <h5> [[+timeText]] </h5>
                    </div>

                    <div class="s12 m3 l3 col flex1 right" style="    direction: ltr;">
                        <div class="input-field col s12">
                            <select>
                                <option value="" disabled selected> [[+locationText]] </option>
                                <option value="1"> المعادي </option>
                                <option value="2"> الاسكندرية </option>
                                <option value="3"> بورسعيد </option>
                            </select>
                        </div>
                        <h5> [[+locationText]] </h5>
                    </div> -->
                </div>


            </div>
            <div id="contentContainer">
                
            </div>
            
        </div>
    </section>

[[+footer]]
[[+scripts]]
<script src="scripts/materialize.min2.js "></script>
<script src='https://isotope.metafizzy.co/v1/jquery.isotope.min.js'></script>
<script src="scripts/filter.js"></script>
<script src="scripts/lity.js"></script>
<script>
    $(document).ready(function () {

        $('.timepicker').timepicker();

    });
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'yyyy/mm/dd',
        closeOnSelect: true,
    });
</script>
<script>
    var eventImg = $('.calImg').height();
    $(".dateTime").css('height', eventImg);
    var eventImgWidth = $('.calImg').width();
    $(".dateTime").css('width', eventImgWidth);
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
    });
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, options);
    });
    // Or with jQuery

    $(document).ready(function () {
        $('.datepicker').datepicker({
            autoClose: true,
            defaultDate: true,
        });
    });

    // Or with jQuery
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>