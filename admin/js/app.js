$(".search-icon").click(function() {
  $("#search-box-element").toggle("fast");
});

$(".new-close-icon").click(function() {
    $("#search-box-element").hide();
});

if ($('#sidebar').width() == 70) {
    $('.menu-links').addClass('hideClass');
	$('.profile-container').addClass('hideClass');
    $('.img-logo').addClass('hideClass');
}

$('.new-menu-icon').click(function() {
    var clicks         = $(this).data('clicks');
    var smallWidth     = 70;
    var largeWidth     = 240;
    var mainWidthLarge = 95;
    var mainWidthSmall = 80;

    if (clicks) {
        $('#sidebar').width(smallWidth);
        $('.menu-links').addClass('hideClass');
        $('.profile-container').addClass('hideClass');
        $('.menu-links').removeClass('showClass');
        $('.profile-container').removeClass('showClass');
        $('#main-content').width('95%');
        $('.img-logo').addClass('hideClass');
        $('.img-logo').removeClass('showClass');
    } else {
        $('#sidebar').width(largeWidth);
        $('.menu-links').addClass('showClass');
        $('.profile-container').addClass('showClass');
        $('.menu-links').removeClass('hideClass');
        $('.profile-container').removeClass('hideClass');
        $('#main-content').width('82.2%');
        $('.img-logo').addClass('showClass');
        $('.img-logo').removeClass('hideClass');
    }
    $(this).data("clicks", !clicks);
});

$('.card-panel').hover(function() {
    $(this).toggleClass('z-depth-2');
});

$(document).ready(function() {
    $('.loader-container').hide();
    $('.tooltipped').tooltip({delay: 50});

    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('#addAlert').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#editAlert').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addUser').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#user-modal').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addAdminBtn').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addAdminRoleBtn').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#editEvent').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addPhone').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addprivilege').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
        ready: function() {
            var map = document.getElementById("map");
            google.maps.event.trigger(map, 'resize');
        }
    });

    $('#addPrivCat').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#addPhoneCat').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
    });

    $('#editPrivilegeOpenModal').leanModal({
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        starting_top: '14%', // Starting top style attribute
        ready: function() {
           var map = document.getElementById("view-map");
           google.maps.event.trigger(map, 'resize');
       }
    });

    $('select').material_select();
    $('.timepicker').pickatime({
        Default: 'now', // Set default time: 'now', '1:30AM', '16:30'
       fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
       twelvehour: true, // Use AM/PM or 24-hour format
       donetext: 'OK', // text for done-button
       cleartext: 'Clear', // text for clear-button
       canceltext: 'Cancel', // Text for cancel-button
       autoclose: false, // automatic close timepicker
       ampmclickable: true, // make AM PM clickable
    });
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        container: 'body',
        format: 'yyyy/mm/dd',
        closeOnSelect: true,
        onSet: function () {
        	this.close();
    	}
    });
});