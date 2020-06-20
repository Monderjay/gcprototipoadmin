@extends('layouts.app')
@section('title',config('app.name').' | Contacto')
@section('page-title', ' | Contacto')
@section('content')
    <div class="row text-justify mr-auto ml-auto justify-content-center" style="padding-top: 130px; margin-bottom: 40px; font-size: 16px;">

        <div class="col-11 col-xl-3">
            <h4><b>
                Si quieres anunciarte en GameCore, puedes ponerte en contacto con nosotros por alguno de estos medios:
                </b>
            </h4>

            <br>

            <h5><b>Contacto</b></h5>
            <p>
                Nezahualcóyotl Estado de México
                <br>game.core2020@gmail.com
            </p>

            <br>

            <p>
                Todo nuestro contenido es proveniente de páginas oficiales y redactado con un enfoque acorde a nuestro público con el propósito de brindar noticias y contenido acerca del mundo de los videojuegos.
                Las imágenes e iconos utilizados para representar consolas, videojuegos, redes sociales o hacer cualquier otra referencia son usados de manera responsable sin afectar a las compañías y tomados directamente desde fontawesome. Cualquier inconformidad relacionada con el uso de algún icono, imagen o referencia es recomendable ponerse en contacto con Game-Core explicando dicha inconformidad e inmediatamente será retirada si se determina que esta incumpliendo con las normas de copyright.
            </p>

            <br>
            <b>Todos los derechos reservados &copy; Game-Core 2020</b>
        </div>
    </div>


        @include('includes.footer')


@endsection

