var clasification = $("#clasification");
$(function() {
    $(".calification").knob({
        'min':0,
        'max':100,
        'width':150,
        'fgColor':'#28a745',
    });
    showCalificationFeatured();
});



clasification.change(function () {
    showCalificationFeatured();
});

function showCalificationFeatured() {
    if (clasification.val() == "Reseñas"){
        $(".calification-content").removeClass('d-none');
        $(".featured-content").removeClass('d-none');
    }else if(clasification.val() == "Noticias"){
        $(".featured-content").removeClass('d-none');
        $(".calification-content").addClass('d-none');
    }else if(clasification.val() == "Retro") {
        $(".featured-content").removeClass('d-none');
        $(".calification-content").addClass('d-none');
    }else{
        $(".calification-content").addClass('d-none');
        $(".featured-content").addClass('d-none');
    }

}
