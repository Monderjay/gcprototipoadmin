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
        $("#carousel1").css('margin-top','0px');
        $("#carousel1").css('float','none');

        $(".cover-author-content").css('margin-top','0px');
        $(".cover-author-content").css('float','none');

    } else if(width < 1200){
        $("#carousel1").css('margin-top','74px');
        $("#carousel1").css('float','left');

        $(".cover-author-content").css('margin-top','74px');
        $(".cover-author-content").css('float','left');

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

            $("#carousel1").css('margin-top','60px');
            $("#carousel1").css('float','left');
            $(".cover-author-content").css('float','left');
            $(".cover-author-content").css('margin-top','60px');
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





