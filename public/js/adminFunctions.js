
function validateDelete(form){
    var res = confirm("¿Desea eliminar este elemento?");
    if (res != true){
        return false;
    }
}

function validateNews(form) {
    var title = $('#title').val();
    var description = CKEDITOR.instances['description'].getData();
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
            title: 'No hay Descripción' + description,
            text: 'Debe Proporcionar una Descripción a la Noticia',
        });
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
        var file, img;

        if ((file = featured_image[0].files[0])) {
            img = new Image();

            var fileName = file.name;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            var size = file.size;
            console.log(ext);
            console.log(size);
            if( ext != 'jpeg' && ext != 'png' && ext != 'jpg' && ext != 'JPG'){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no valido',
                    text: 'La Imagen Destacada debe de tener un formato (jpg, jpeg, png)',
                });
                return false;
            }

            if( size > 2097152){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Imagen demasiado Grande',
                    text: 'La Imagen Destacada debe de tener un meso maximo de 2MB',
                });
                return false;
            }
            img.src = _URL.createObjectURL(file);
        }
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

function validateNewsEdit(form) {
    var title = $('#title').val();
    var description = CKEDITOR.instances['description'].getData();
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
            title: 'No hay Descripción' + description,
            text: 'Debe Proporcionar una Descripción a la Noticia',
        });
        return false;
    }

    if (featured_image.val() != ""){

        var _URL = window.URL || window.webkitURL;
        var file, img;

        if ((file = featured_image[0].files[0])) {
            img = new Image();
            var fileName = file.name;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            var size = file.size;
            console.log(ext);
            console.log(size);
            if( ext != 'jpeg' && ext != 'png' && ext != 'jpg' && ext != 'JPG'){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no valido',
                    text: 'La Imagen Destacada debe de tener un formato (jpg, jpeg, png)',
                });
                return false;
            }

            if( size > 2097152){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Imagen demasiado Grande',
                    text: 'La Imagen Destacada debe de tener un meso maximo de 2MB',
                });
                return false;
            }
            img.src = _URL.createObjectURL(file);
        }
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

function validateImageFeatured(form){
    var featured_image = $('#featured_image');
    if (featured_image.val() == ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay Imagen',
            text: 'Debe Proporcionar una Imagen Destacada a la Noticia',
        });
        return false;
    }else{
        var _URL = window.URL || window.webkitURL;
        var file, img;

        if ((file = featured_image[0].files[0])) {
            img = new Image();

            var fileName = file.name;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            var size = file.size;
            console.log(ext);
            console.log(size);
            if( ext != 'jpeg' && ext != 'png' && ext != 'jpg' && ext != 'JPG'){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no valido',
                    text: 'La Imagen Destacada debe de tener un formato (jpg, jpeg, png)',
                });
                return false;
            }

            if( size > 2097152){
                console.log(file.type);
                Swal.fire({
                    icon: 'error',
                    title: 'Imagen demasiado Grande',
                    text: 'La Imagen Destacada debe de tener un meso maximo de 2MB',
                });
                return false;
            }
            img.src = _URL.createObjectURL(file);
        }
    }
}

function validatePorfile(form){

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
