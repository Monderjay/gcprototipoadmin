@extends('layouts.app')
@section('title', config('app.name').' | Informacion')
@section('page-title', 'Informacion')
@section('keywords','gamecore misión, gamecore visión, gamecore información')
@section('page-author','GameCore')

@section('content')
<div class="row text-justify mr-auto ml-auto justify-content-center" style="padding-top: 130px; margin-bottom: 40px; font-size: 16px;">

    <div class="col-11 col-xl-3">
        <h4><b>Misión</b></h4>

        <p>
            Nuestro mayor interés es informar acerca de los últimos acontecimientos del mundo de los videojuegos,
            a través de una revista digital confiable, objetiva y que aporte valor y conocimiento a los adeptos de
            estos temas, generando un beneficio a los miembros de GameCore, a sus afiliados, y, sobre todo, a las
            personas de este nicho que buscan información por medio de internet, ofreciendo un resultado de calidad
            como respuesta a su búsqueda.
        </p>
        <br>
        <h4><b>Visión</b></h4>

        <p>
            Llegar a ser una de las páginas más confiables de consulta de información acerca de videojuegos, ser
            considerados por los consumidores y por las compañías como medio de confianza para informar acerca de
            noticias, nuevos lanzamientos, y detalles técnicos de ésta índole, así como para probar, revisar y
            recomendar productos y servicios que tengan que ver con los videojuegos.
        </p>

        <br>
        <b>Todos los derechos reservados &copy; Game-Core 2020</b>
    </div>
</div>


    @include('includes.footer')

@endsection
