@php
use App\Models\Movie;
use App\Models\Serie;

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
        <title>{{ env('APP_NAME') }} - {{ $media->Name }} </title>
        <link rel="stylesheet" href="assets/css/item.css">

        <style>


        </style>
    </head>

    <body>



        <div class="movie_card" id="bright">

            <div class="info_section">

                <div class="movie_header">
                    <img class="locandina" src="assets/img/posters/{{ $media->Poster }}" />
                    <h1>{{ $media->Name }}</h1>
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
                <iframe src={{ $media->Links }} allowfullscreen width="100%" height="500px" sandbox="allow-scripts"
                    frameborder="0"></iframe>
                <div class="d-flex justify-content-center  mx-auto text-light p-4">
                    <a href={{ url("/Contact?idMovie=$media->idMovie") }} class="btn btn-danger text-light "> <i
                            class="fa fa-exclamation-triangle"></i> Report an
                        issue</a>
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
                            if (!empty($exp)) {
                                foreach ($exp as $key => $value) {
                                    $similar = Movie::where('category', 'like', "%$exp[$key]%")
                                        ->where('idMovie', '!=', $media->idMovie)
                                        ->get();
                                }
                            } else {
                                $similar = Movie::where('idMovie', '!=', $media->idMovie)
                                    ->whereIn('category', $media->category)
                                    ->get();
                            }
                            
                        @endphp


                        <div class="row d-flex mx-auto">
                            <div class="owl-carousel owl-theme" id="owl">
                                @if (!$similar->isEmpty())
                                    @foreach ($similar as $sim)
                                        <div class="item">
                                            <div class="card p-0">
                                                <div class="card-image">

                                                    <img src="assets/img/posters/{{ $sim->Poster }}" alt="imgs">
                                                </div>
                                                <div class="card-content d-flex flex-column align-items-center">
                                                    <h4 class="pt-2">{{ $sim->Name }}</h4>
                                                    <h5>{{ substr($sim->Subject, 0, 150) . '...' }} </h5>
                                                    <div style="font-weight: bold;margin:4px">
                                                        {{ $sim->Quality }}
                                                    </div>
                                                    <ul class="social-icons d-flex justify-content-center">
                                                        <li>

                                                            <a class="btn btn-primary ms-auto" role="button"
                                                                style="font-size: 1.5vh;background: rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-radius: 23px"
                                                                href="#">Watch <i class="fa fa-play"
                                                                    style="margin: 5px;"></i></a>
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
