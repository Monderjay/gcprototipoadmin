$(function () {
    menuResize();
});

$(window).resize(function () {
    menuResize();
});

function menuResize(){
    var width = $(window).width();
    if (width >= 1200) {
        //scrollXl();
        $("#menu").css('background','rgba(0, 0, 0, 0.7)');

    } else if(width < 1200){

        $("#menu").css('background','#000000');
        //scrollSm();
    }
}

$(window).scroll(function() {
    var width = $(window).width();
    if (width >= 1200){
        if ($("#menu").offset().top > 70) {
            $("#menu").css('background','rgba(0, 0, 0, 0.9)');
            $("#menu").animate({
                paddingTop: "5px",
                paddingBottom: "5px",
            },{
                queue: false,
            });
        } else {
            $("#menu").css('background','rgba(0, 0, 0, 0.7)');
            $("#menu").animate({
                paddingTop: "12px",
                paddingBottom: "12px",
            },{
                queue: false,
            });

        }
    }else if (width < 1200){
        if ($("#menu").offset().top > 70) {


            $("#menu").animate({
                paddingTop: "5px",
                paddingBottom: "5px",

            },{
                queue: false,
            });

        }else {


            $("#menu").animate({
                paddingTop: "12px",
                paddingBottom: "12px",
            },{
                queue: false,
            });

            $("#carousel1").animate({
                marginTop: "74px",
                float:"none"

            },{
                queue: false,
            });

            $(".cover-author-content").animate({
                marginTop: "74px",
                float:"none"
            }, {
                queue: false,
            });
        }
    }

});

$(document).ready(function() {
    $('.fb-share').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
});

