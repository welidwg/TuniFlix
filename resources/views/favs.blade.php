@php

use App\Models\Movie;
use App\Models\Serie;
use App\Models\Fav;
@endphp
@if (Session::has('login'))
    @include('nav')
    @php
        
        $favs = Fav::where('idUser', Session::get('id'))->get();
        
    @endphp
    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }} - My Favorites </title>
        <link rel="stylesheet" href="assets/css/item.css">

    </head>

    <body>

        <div class="col " style="background: #232222;">
            <div style="padding: 32px">



                <h1 style="font-size: 5vh;color: var(--bs-light);padding: 8px">
                    {{ $favs->count() }} Favorite(s)
                </h1>
                <div class="row d-flex mx-auto">
                    @if ($favs->count() != 0)
                        @php
                            $j = 0;
                            $class = 'far fa-heart';
                        @endphp
                        <div class="owl-carousel owl-theme" id="owl">

                            @foreach ($favs as $favv)
                                @php
                                    $movie = Movie::where('idMovie', $favv->idMovie)->first();
                                    $j++;
                                    $class = 'far fa-heart';
                                @endphp
                                <div class="item">
                                    <div class="card1 p-0">
                                        <div class="card-image">

                                            <img src="assets/img/posters/{{ $movie->Poster }}" alt="imgs">
                                        </div>
                                        <div class="card-content d-flex flex-column align-items-center">
                                            <h4 class="pt-2">{{ $movie->Name }}</h4>
                                            <h5>{{ substr($movie->Subject, 0, 100) . '...' }} </h5>
                                            <div style="font-weight: bold;margin:4px">
                                                {{ $movie->Quality }}
                                            </div>
                                            <div style="font-weight: bold;margin:4px;font-size: 12px">
                                                {{ $movie->category }}
                                            </div>
                                            @if (Session::has('login'))
                                                @php
                                                    $checkFav = Fav::where('idUser', Session::get('id'))
                                                        ->where('idMovie', $movie->idMovie)
                                                        ->first();
                                                    
                                                    if ($checkFav) {
                                                        $class = 'fas fa-heart';
                                                    }
                                                @endphp
                                                <form id="fav{{ $j }}">
                                                    <input type="text" id="idMovie{{ $j }}" hidden
                                                        value={{ $movie->idMovie }}>

                                                    <button type="submit" class=""
                                                        style="background-color: transparent;border:none"><i
                                                            id="favIcon{{ $j }}" class="{{ $class }}"
                                                            style="color: rgb(221,21,44)"></i></button>
                                                    @csrf
                                                </form>
                                                <script>
                                                    $(function() {
                                                        $("#fav{{ $j }}").unbind().on("submit", (e) => {
                                                            e.preventDefault();
                                                            $.ajax({
                                                                type: "post",
                                                                url: "{{ url('/AddFavorite') }}",
                                                                data: {
                                                                    idMovie: $("#idMovie{{ $j }}").val(),
                                                                    _token: "{{ csrf_token() }}"
                                                                },
                                                                success: function(res) {
                                                                    let cls = $("#favIcon{{ $j }}").attr('class');
                                                                    $("#favIcon{{ $j }}").removeAttr("class");

                                                                    if (cls == "fas fa-heart") {
                                                                        $("#favIcon{{ $j }}").attr("class", "far fa-heart");
                                                                    } else {
                                                                        $("#favIcon{{ $j }}").attr("class", "fas fa-heart");

                                                                    }


                                                                    console.log(res);
                                                                    alertify.success(res)
                                                                },
                                                                error: (r) => {
                                                                    console.log(r.responseText);
                                                                    alertify.error(r.responseText);

                                                                }
                                                            });
                                                        })
                                                    });
                                                </script>
                                            @endif
                                            <ul class="social-icons d-flex justify-content-center">
                                                <li>

                                                    <a class="btn btn-primary ms-auto" role="button"
                                                        style="font-size: 1.5vh;background: rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-radius: 23px"
                                                        href={{ url("/Watch/Movie/$movie->idMovie") }}>Watch <i
                                                            class="fa fa-play" style=""></i></a>
                                                </li>
                                                <li>

                                                    <a class="btn btn-primary ms-auto" role="button"
                                                        style="font-size: 1.5vh;background: rgb(255, 255, 255);color:rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-radius: 23px"
                                                        href={{ $movie->TeaserLink }} target="_blank">Teaser <i
                                                            class="fa fa-eye" style=""></i></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif





                    <script>
                        $(document).ready(function() {
                            $("#owl").owlCarousel({
                                loop: false,
                                item: 1,
                                center: false,
                                mouseDrag: true,
                                dots: true,

                                responsive: {
                                    0: {
                                        items: 1,
                                    },
                                    600: {
                                        items: 3,
                                    },
                                    1000: {
                                        items: 5,
                                    },
                                },
                            });
                        });
                    </script>


                </div>
            </div>

        </div>
    </body>
    </div>
    @include('footer')
@else
    @include('error')

@endif

</html>
