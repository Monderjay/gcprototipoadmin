



function validateDelete(form){
    var res = confirm("¿Desea Eliminar a este Fundador?");
    if (res != true){
        return false;
    }
}

function deleteImage(form){
    var res = confirm("¿Desea Eliminar esta Imagen?");
    if (res != true){
        return false;
    }
}


/*var _URL = window.URL || window.webkitURL;
var featured_image = $('#featured_image');

featured_image.change(function(e) {
    var file, img;
    //console.log(this.files[0]);
    //console.log(featured_image[0].files[0])

    if ((file = featured_image[0].files[0])) {
        img = new Image();
        img.onload = function() {
            console.log(this);
            console.log(img.width);
            console.log(img.height);
            //alert(this.width + " " + this.height);
        };
        img.onerror = function() {
            alert( "not a valid file: " + file.type);
        };
        img.src = _URL.createObjectURL(file);


    }

});*/



function validateNews(form) {
    var title = $('#title').val();
    var description = $('#description').val();
    var introduction = $('#introduction').val();
    var category = $('#category').val();
    var clasification = $('#clasification').val();

    var featured_image = $('#featured_image');

    if (title == ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay Título',
            text: 'Debe Proporcionar un Título a la Noticia',
        });
        //console.log(featured_image.data([0]));
        return false;
    }

    if (featured_image.val() == ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay Imagen',
            text: 'Debe Proporcionar una Imagen Destacada a la Noticia',
        });
        return false;
    }else{
        var _URL = window.URL || window.webkitURL;
        var featured_image = $('#featured_image');

            var file, img;

            //console.log(this.files[0]);
            //console.log(featured_image[0].files[0])

            if ((file = featured_image[0].files[0])) {
                img = new Image();
                img.onload = function() {
                    if (img.width > 1920 && img.height > 1080){
                        Swal.fire({
                            icon: 'error',
                            title: 'Imagen demasiado Grande',
                            text: 'La Imagen Destacada no debe de ser mayor a  1920 x 1080px',
                        });
                        return false;
                    }
                    var fileName = file.name;
                    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
                    console.log(ext);
                    if( ext != 'jpeg' && ext != 'png' && ext != 'jpg' && ext != 'gif'){
                        console.log(file.type);
                        Swal.fire({
                            icon: 'error',
                            title: 'Formato no valido',
                            text: 'La Imagen Destacada debe de tener un formato (jpg, jpeg, gif)',
                        });
                        return false;
                    }
                };
                img.onerror = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Formato no valido',
                        text: 'Solo se admiten Imagenes (jpg, jpeg, gif)',
                    });
                    return false;
                };
                img.src = _URL.createObjectURL(file);

            }
    }

    if (introduction == ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay Introducción',
            text: 'Debe Proporcionar una Introducción a la Noticia',
        });
        return false;
    }

    if (description == ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay Descripción',
            text: 'Debe Proporcionar una Descripción a la Noticia',
        });
        return false;
    }

    if (category == "" || category == "Seleccione una Categoría"){

        Swal.fire({
            icon: 'error',
            title: 'No hay una Categoría Seleccionada',
            text: 'Debe Seleccionar una Categoría para la Noticia',
        });
        return false;
    }

    if (clasification == "" || clasification == "Seleccione una Clasificación"){

        Swal.fire({
            icon: 'error',
            title: 'No hay una Clasificación Seleccionada',
            text: 'Debe Seleccionar una Clasificación para la Noticia',
        });
        return false;
    }

}

(function($) {

    "use strict";

    var fullHeight = function() {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function(){
            $('.js-fullheight').css('height', $(window).height());
        });


    };


    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('#sidebar-content').removeClass('active');
        $('.overlay').removeClass('active');
    });

    fullHeight();


    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#sidebar-content').toggleClass('active');
        $('.overlay').addClass('active');
    });

})(jQuery);





