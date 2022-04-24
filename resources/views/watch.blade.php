@php
use App\Models\Movie;
use App\Models\Serie;

use Illuminate\Support\Str;

switch ($type) {
    case 'Movie':
        $media = Movie::where('idMovie', $id)->first();
        # code...
        break;
    case 'Serie':
        $media = Serie::where('idSerie', $id)->first();
        # code...
        break;

    default:
        # code...
        break;
}
if (Session::has('login')) {
    $media->increment('views');
    $media->save();
}

@endphp
<!DOCTYPE html>
<html lang="en">
@if ($media)
    @include('nav')

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }} - {{ $media->Name }} </title>
        <link rel="stylesheet" href="assets/css/item.css">

        <style>


        </style>
    </head>

    <body>



        <div class="movie_card" id="bright">

            <div class="info_section">

                <div class="movie_header">
                    <img class="locandina" src="assets/img/posters/{{ $media->Poster }}" />
                    <h1>{{ $media->Name }} @if (Session::has('role') && Session::get('role') == 1)
                            <a target="_blank" href={{ url('/Dash/MovieEdit/' . Crypt::encrypt($media->idMovie)) }}
                                style="font-size: 18px;text-decoration: none;color:antiquewhite">
                                <i class="fas fa-pen"></i></a>
                        @endif
                    </h1>
                    <h4>{{ $media->DateReleased }}, {{ $media->Director }}</h4>
                    <span class="minutes">{{ $media->Quality }} </span>
                    <span class="minutes">{{ $media->Duration }} min</span>
                    <p class="type">{{ $media->category }}</p>
                </div>
                <div class="movie_desc">
                    <p class="text">
                        {{ $media->Subject }}
                    </p>
                </div>

                <div class="movie_social">
                    <ul>
                        <li><a href="{{ $media->TeaserLink }}" target="__blank" class="btn btn-danger border">Teaser
                                <i class="fab fa-youtube"></i></a>
                        </li>
                        @php
                            $idSession = Str::random(10) . '.' . $media->idMovie;
                            
                        @endphp
                        @if (Session::has('login'))
                            <li><a href="/Session/{{ $idSession }}" target="__blank"
                                    class="btn btn-danger border">Watch
                                    with friends
                                    <i class="fas fa-users"></i></a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>

            <div class="blur_back bright_back"
                style="background: url('assets/img/posters/{{ $media->Poster }}');background-repeat: no-repeat;background-position: right;background-size: cover">

            </div>

        </div>
        <div class="row bg-dark " style="padding: 20px;">
            <!-- <embed type="video/webm" src="{{ $media->Links }}" width="400" height="500">-->
            @if (Session::has('login'))
                <style>


                </style>

                <ul class="nav nav-pills " id="myTab" style="padding: 6px;flex-direction: row;display: inline-flex">
                    <li class="nav-item ">

                        @php
                            $test = explode(',', $media->Links);
                        @endphp
                        @if (count($test) != 0)

                            @for ($i = 0; $i < count($test); $i++)
                                <a class="nav-link @if ($i == 0) active @endif" data-bs-toggle="tab"
                                    href="#Server{{ $i }}">
                                    Server {{ $i + 1 }}
                                </a>
                            @endfor

                        @endif
                    </li>


                </ul>
                <div class="tab-content">
                    @if (count($test) != 0)
                        @for ($j = 0; $j < count($test); $j++)
                            <div class="tab-pane fade @if ($j == 0) show active @else '' @endif "
                                id="Server{{ $j }}">
                                @if (str_contains($test[$j], '.mp4'))
                                    <video disableremoteplayback webkit-playsinline playsinline width="100%"
                                        height="500px" controls>
                                        <source src={{ $test[$j] }} type="video/mp4">
                                    </video>
                                @else
                                    <iframe src={{ $test[$j] }} allowfullscreen width="100%" height="500px"
                                        sandbox="allow-scripts allow-popups"></iframe>
                                @endif

                                <div class="d-flex justify-content-center  mx-auto text-light p-4">
                                    <a href={{ url("/Contact?idMovie=$media->idMovie") }}
                                        class="btn btn-danger text-light "> <i class="fa fa-exclamation-triangle"></i>
                                        Report an
                                        issue</a>
                                </div>
                            </div>
                        @endfor
                    @endif




                </div>
            @else
                <div class="ms-auto text-light " style="font-size: 3vh"> <i class="fa fa-lock"></i> You are not
                    logged In , <a href={{ url('/Login') }}>Please Log in to
                        watch
                        {{ $media->Name }}</a></div>
            @endif



            <div class="col " style="background: #232222;">
                <div style="padding: 10px">
                    <h1 style="font-size: 5vh;color: var(--bs-light);font-family: Staatliches, serif;padding: 8px">
                        You might like also
                        @php
                            $exp = explode(',', $media->category);
                            foreach ($exp as $key => $value) {
                                $similar = Movie::where('category', 'like', '%' . $exp[$key] . '%')
                                    ->where('idMovie', '!=', $media->idMovie)
                                    ->get();
                            }
                            
                        @endphp


                        <div class="row d-flex mx-auto">
                            <div class="owl-carousel owl-theme" id="owl">
                                @if (!$similar->isEmpty())
                                    @foreach ($similar as $sim)
                                        <div class="item">
                                            <div class="card1 p-0">
                                                <div class="card-image">

                                                    <img src="assets/img/posters/{{ $sim->Poster }}" alt="imgs">
                                                </div>
                                                <div class="card-content d-flex flex-column align-items-center">
                                                    <h4 class="pt-2">{{ $sim->Name }}</h4>
                                                    <h5>{{ substr($sim->Subject, 0, 150) . '...' }} </h5>
                                                    <div style="font-weight: thin;margin:4px;font-size: 26px">
                                                        {{ $sim->Quality }}
                                                    </div>
                                                    <ul class="social-icons d-flex justify-content-center">
                                                        <li>

                                                            <a class="btn btn-primary ms-auto" role="button"
                                                                style="font-size: 1.5vh;background: rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-radius: 23px"
                                                                href={{ url('/Watch/Movie/' . $sim->idMovie . '') }}>Watch
                                                                <i class="fa fa-play" style="margin: 5px;"></i></a>
                                                        </li>
                                                        <li>

                                                            <a class="btn btn-primary ms-auto" role="button"
                                                                style="font-size: 1.5vh;background: rgb(255, 255, 255);color:rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-radius: 23px"
                                                                href="#">Teaser <i class="fa fa-eye"
                                                                    style="margin: 5px;"></i></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="">No Similar movies</div>
                                @endif


                                <script>
                                    $(function() {
                                        $("#owl").owlCarousel({
                                            loop: false,
                                            item: 1,
                                            center: false,
                                            mouseDrag: true,
                                            dots: true,
                                            // autoplay:true,
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

            </div>


        </div>
        </div>
        @include('footer')
    @else
        @include('error')

@endif

</html>
