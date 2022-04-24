@php
use App\Models\Movie;
use App\Models\Serie;
use App\Models\SessionWatch;

$media = Movie::where('idMovie', $id)->first();

if (Session::has('login') && Session::get('role') != 0) {
    $media->increment('views');
    $media->save();
}
$check = SessionWatch::where('SessionId', $Session)->first();
if (!$check) {
    $session = new SessionWatch();
    $session->SessionID = $Session;
    $session->save();
}

@endphp
<!DOCTYPE html>
@if (Session::has('login'))
    <html lang="en">
    @if ($media)
        @include('nav')

        <head>
            <script src="https://cdn.socket.io/4.4.1/socket.io.min.js"
                        integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous">
            </script>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>{{ config('app.name') }} - {{ $media->Name }} </title>
            <link rel="stylesheet" href="assets/css/item.css">

            <style>


            </style>
            <script>
                $(function() {
                    let check = {{ $check }};


                });
            </script>
        </head>

        <body>
          

            @if ($check)
                <script>
                    alertify.success("Session joined")
                </script>
            @else
                <script>
                    alertify.alert("Session Created",
                        "You have successfully created a session.<br>Share the session id with your friends to join you ! <br> <span style='color:limegreen'>Session id : <span id='copySession' style='cursor:pointer;'><i class='far fa-copy'></i></span></span>  <input id='input' disabled class='form-control' value='{{ $Session }}'/>"
                    )

                    function Copyy() {
                        /* Get the text field */
                        var copyText = document.getElementById("input");

                        /* Select the text field */
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); /* For mobile devices */

                        /* Copy the text inside the text field */
                        navigator.clipboard.writeText(copyText.value);

                        /* Alert the copied text */
                        alertify.success("Copied to clipboard");
                    }
                    var butn = document.getElementById("copySession");
                    butn.onclick = () => {
                        Copyy()
                        console.log("clicked");
                    }
                </script>
            @endif



            <div class="movie_card" id="bright">

                <div class="info_section">

                    <div class="movie_header">
                        <img class="locandina" src="assets/img/posters/{{ $media->Poster }}" />
                        <h1>{{ $media->Name }}
                            @if (Session::has('role') && Session::get('role') == 1)
                                <a target="_blank"
                                    href={{ url('/Dash/MovieEdit/' . Crypt::encrypt($media->idMovie)) }}
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
                            <li><a href="{{ $media->TeaserLink }}" target="__blank"
                                    class="btn btn-danger border">Teaser
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
                    <style>


                    </style>
                    <script>
                        let ip_address = "127.0.0.1";
                        let socket_port = "3000";
                        let socket = io(ip_address + ':' + socket_port);
                        socket.emit('join', {
                            room: "{{ $Session }}",


                        });
                    </script>
                    <ul class="nav nav-pills " id="myTab" style="padding: 6px;flex-direction: row;display: inline-flex">
                        <li class="nav-item ">

                            @php
                                $test = explode(',', $media->Links);
                            @endphp
                            @if (count($test) != 0)

                                @for ($i = 0; $i < count($test); $i++)
                                    <a class="nav-link @if ($i == 0) active @endif"
                                        data-bs-toggle="tab" href="#Server{{ $i }}">
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
                                        <video id="vid{{ $j }}" class=" mx-auto" width="1000"
                                            preload="auto" height="500px" data-setup="{}">
                                            <source src={{ $test[$j] }} type="video/mp4">
                                        </video>
                                        <button class="btn btn-success " id="play{{ $j }}"
                                            style="color:white">Play</button>
                                        <button class="btn btn-warning " id="pause{{ $j }}"
                                            style="color:white">Pause</button>
                                        <button class="btn btn-light " id="up{{ $j }}"
                                            style="color:rgb(221,21,44)">-10s</button>
                                        <button class="btn btn-light " id="down{{ $j }}"
                                            style="color:rgb(221,21,44)">+10s</button>
                                    @else
                                        <iframe id="vid{{ $j }}" src={{ $test[$j] }} allowfullscreen
                                            width="100%" height="500px" sandbox="allow-scripts allow-same-origin "
                                            referrerpolicy="origin" allowtrancparency="yes"></iframe>
                                        <button class="btn btn-success " id="play{{ $j }}"
                                            style="color:white">Play</button>
                                        <button class="btn btn-warning " id="pause{{ $j }}"
                                            style="color:white">Pause</button>
                                    @endif
                                    @if ($check)
                                        <script>
                                            $(`#vid{{ $j }}`).get(0).currentTime = "{{ $check->Progress }}";
                                        </script>
                                    @endif
                                    <script>
                                        socket.on("play", (data) => {
                                            console.log(data);
                                            $(`#${data}`).trigger("play")
                                            setInterval(() => {
                                                if (!$(`#${data}`).get(0).paused) {
                                                    socket.emit("progress", ({
                                                        time: $(`#${data}`).get(0).currentTime,
                                                        room: "{{ $Session }}"
                                                    }))
                                                }
                                            }, 100);


                                        });
                                        socket.on("pause", (data) => {
                                            console.log("pause");
                                            $(`#${data}`).trigger("pause")

                                        });

                                        socket.on("forward", (data) => {
                                            const video = document.getElementById(data);


                                            video.currentTime = video.currentTime + 10;

                                        })
                                        socket.on("backward", (data) => {
                                            const video = document.getElementById(data);


                                            video.currentTime = video.currentTime - 10;

                                        })
                                        $("body").on("load", () => {
                                            socket.emit("refreshing", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"
                                            }))
                                        })
                                        socket.on("refresh", (data) => {
                                            socket.emit("pausing", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"


                                            }));
                                        })
                                        $("#pause{{ $j }}").on("click", (e) => {
                                            socket.emit("pausing", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"


                                            }));

                                        })
                                        $("#play{{ $j }}").on("click", (e) => {
                                            //video.play()
                                            socket.emit("playing", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"


                                            }));

                                        })
                                        $("#up{{ $j }}").on("click", (e) => {
                                            //video.play()
                                            socket.emit("forwarding", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"


                                            }));

                                        })
                                        $("#down{{ $j }}").on("click", (e) => {
                                            //video.play()
                                            socket.emit("backwarding", ({
                                                room: "{{ $Session }}",
                                                id: "vid{{ $j }}"


                                            }));

                                        })
                                    </script>

                                    <div class="d-flex justify-content-center  mx-auto text-light p-4">
                                        <a href={{ url("/Contact?idMovie=$media->idMovie") }}
                                            class="btn btn-danger text-light "> <i
                                                class="fa fa-exclamation-triangle"></i>
                                            Report an
                                            issue</a>
                                    </div>
                                    <div class="status text-light"></div>
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
                                                                    <i class="fa fa-play"
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
            <style>
                .ct {
                    position: fixed;
                    right: 20px;
                    bottom: 2px;
                    max-height: 600px;
                    overflow: auto;
                    width: 50vh;
                    display: none
                }

                .bt {
                    position: fixed;
                    right: 20px;
                    bottom: 20px;
                    border-radius: 50%;
                    width: 80px;
                    height: 80px;
                    font-size: 3vh
                }

            </style>

            <button id="open" class="btn btn-success bt "><i class="fas fa-comment"></i></button>

            <div class="card ct" id="chat1" style="border-radius: 15px;">
                <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <p class="mb-0 fw-bold">Live chat</p>
                    <i id="close" class="fas fa-times"></i>
                </div>
                <div class="card-body" style="max-height: 400px;overflow: auto;">

                    <div class="d-flex flex-row justify-content-start mb-4">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div class="p-3 ms-3"
                            style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                            <p class="small mb-0">Hello and thank you for visiting MDBootstrap. Please click the
                                video
                                below.</p>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-end mb-4">
                        <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                            <p class="small mb-0">Thank you, I really like your product.</p>
                        </div>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                    </div>

                    <div class="d-flex flex-row justify-content-start mb-4">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div class="ms-3" style="border-radius: 15px;">
                            <div class="bg-image">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/screenshot1.webp"
                                    style="border-radius: 15px;" alt="video">
                                <a href="#!">
                                    <div class="mask"></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-start mb-4">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 100%;">
                        <div class="p-3 ms-3"
                            style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                            <p class="small mb-0">...</p>
                        </div>
                    </div>



                </div>
                <div class="form-outline d-flex">
                    <textarea placeholder="Say something" class="form-control" id="textAreaExample" rows="2"></textarea>
                    <button class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>


            <script>
                $(document).on("click", () => {
                    $("#chat1").fadeOut();

                })
                $('#open').on("click", (e) => {
                    $("#chat1").fadeIn();

                    return false;

                    console.log("clicked");
                })
                $("#chat1").click((e) => {
                    e.stopPropagation();

                })

                $('#close').on("click", (e) => {

                    $("#chat1").fadeOut();
                    console.log("clicked");
                })
            </script>


            @include('footer')
        @else
            @include('error')

    @endif

    </html>
@else
    <script>
        window.location.href = '/'
    </script>
@endif
