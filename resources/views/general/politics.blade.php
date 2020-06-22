@extends('layouts.app')
@section('title',config('app.name').' | Politicas')
@section('page-title', 'Politicas')
@section('keywords','gamecore politicas')
@section('page-author','GameCore')

@section('content')
    <div class="row text-justify mr-auto ml-auto justify-content-center" style="padding-top: 130px; margin-bottom: 40px; font-size: 16px;">

        <div class="col-11 col-xl-6 pb-4">
            <h4><b>Políticas de Privacidad</b></h4>


            <p>
                Game-Core hace uso de cookies para la recolección de datos estadísticos con la finalidad de mejorar su experiencia dentro del sitio.
                Dichas cookies son utilizadas para poder compartir y destacar contenido en diferentes redes sociales, verificación de identidad, datos estadísticos como la medición del tráfico de visitantes, contadores para conocer las noticias y autores más leídos, así como recaudar información acerca de las preferencias de búsqueda con el fin de poder activar Google AdSense de manera segura.
                Las Cookies solo serán utilizadas para mejorar constantemente nuestro contenido con el uso de plugins y nunca afectar a terceros o compartir datos personales sin el consentimiento del usuario.
            </p>

            <p>
                Todo nuestro contenido es proveniente de páginas oficiales y redactado con un enfoque acorde a nuestro público con el propósito de brindar noticias y contenido acerca del mundo de los videojuegos.
                Las imágenes e iconos utilizados para representar consolas, videojuegos, redes sociales o hacer cualquier otra referencia son usados de manera responsable sin afectar a las compañías y tomados directamente desde fontawesome. Cualquier inconformidad relacionada con el uso de algún icono, imagen o referencia es recomendable ponerse en contacto con Game-Core explicando dicha inconformidad e inmediatamente será retirada si se determina que esta incumpliendo con las normas de copyright.
            </p>
            <br>

            <small>
                Gamecore no se responsabiliza por las opiniones de nuestros redactores en cuanto al tópico de los videojuegos, ya que cada artículo puede contener en mayor o menor medida una crítica personal hacia determinado producto de software o hardware, sin embargo emitir una opinión por parte de los redactores que pueda herir la sensibilidad del público, por tocar un tema que esté fuera de contexto o no aluda al mundo de los videojuegos, puede ser informado para corresponder con las medidas o sanciones necesarias.
            </small>
            <br><br>

            <b>Todos los derechos reservados &copy; Game-Core 2020</b>
        </div>
    </div>


    @include('includes.footer')

@endsection
