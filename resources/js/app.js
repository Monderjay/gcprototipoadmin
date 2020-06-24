/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/


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




