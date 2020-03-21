$(document).ready(function(){   
        $('.slider').slider({full_width: true}); 
       $(".search_btn").click(function(){  
         $(".search_box").toggleClass('view_search'); 
        }); 
    
//            var grid = $('#headline_slider').height() ;
//			$('.sp-content h2').css("left", grid);
    
    $('.modal').modal(); 
}); 

$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 4000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }
  });
});     


$(document).ready(function(){   
    
    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).scroll(function () {
        $('.sections').each(function () {
            if (isScrolledIntoView(this) === true) {
                $(this).addClass('in-view');
                
                setTimeout(function(){ 
                    $(".statMain >div:nth-child(1)").addClass('fadeInRight');
                },0);
                
                setTimeout(function(){ 
                    $(".statMain >div:nth-child(2)").addClass('fadeInRight');
                },400);
                
                setTimeout(function(){ 
                    $(".statMain >div:nth-child(3)").addClass('fadeInRight');
                },800);
                setTimeout(function(){ 
                    $(".statMain >div:nth-child(4)").addClass('fadeInRight');
                },1200); 
                
                    var services = $('.services_img').width(); 
                $('.services_img').css('height', services);  
  
            } 
        });
    });
});