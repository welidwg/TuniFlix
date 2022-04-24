<!DOCTYPE html>
<html lang="en">
@php
use App\Models\Category;

@endphp


<head>
    <base href="{{ url('/public') }}">

    <meta charset="utf-8">
    <link rel="shortcut icon" href="assets/img/Chehia.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Serif+JP&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Staatliches&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


</head>
<style>
    a {
        text-decoration: none
    }

    body {
        overflow-x: hidden
    }

    .search-box {
        width: fit-content;
        height: fit-content;
        position: relative;
    }

    .input-search {
        height: 50px;
        width: 50px;
        border-style: none;
        padding: 10px;
        font-size: 13px;
        letter-spacing: 0px;
        outline: none;
        border-radius: 25px;
        transition: all .5s ease-in-out;
        background-color: transparent;
        padding-right: 40px;
        color: #fff;
    }

    .input-search::placeholder {
        color: rgba(255, 255, 255, .5);
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: 100;
    }

    .btn-search {
        width: 50px;
        height: 50px;
        border-style: none;
        font-size: 15px;
        font-weight: bold;
        outline: none;
        cursor: pointer;
        border-radius: 50%;
        position: absolute;
        right: 0px;
        color: #ffffff;
        background-color: transparent;
        pointer-events: painted;
    }

    .btn-search:hover~.input-search {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    .input-search:hover {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    #loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: #232222;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* footer  */

</style>

<body oncontextmenu="return true" style="background: url(&quot;assets/img/rel1.jpg&quot;) center / cover no-repeat;">
    <div id="loader">
        @php
            
        @endphp
        <div class="mx-auto "
            style="display: flex;flex-direction: column;padding: 20px;color:white;align-items: center;margin: 11px">
            <img src="assets/img/logoTX.png" alt="TuniFlix" style="width: 250px">

            <p>
            <div class="spinner-border text-danger " style="" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            </p>


        </div>


    </div>
    <nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button"
        style="padding-top: 4px;padding-bottom: 4px;background: rgba(255,255,255,0);" id="nav">
        <div class="container"><img src="assets/img/logoTX.png" style="width: 25vh;">
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"
                style="background-color: rgb(221,21,44);"><span class="visually-hidden">Toggle navigation</span><span
                    class="navbar-toggler-icon"
                    style="color: var(--bs-red);border-color: var(--bs-red);"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href={{ url('/') }}
                            style="font-size: 2.6vh;">Home</a>
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false"
                            data-bs-toggle="dropdown" href="#" style="color: white;font-size: 2.6vh;">Movies</a>
                        <div class="dropdown-menu">
                            <h6 class="dropdown-header">Categories</h6>
                            @php
                                $cts = Category::get();
                                
                            @endphp
                            @foreach ($cts as $cat)
                                <a class="dropdown-item"
                                    href={{ url("/Category/$cat->label ") }}>{{ $cat->label }}</a>
                            @endforeach


                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false"
                            data-bs-toggle="dropdown" href="#" style="color: white;font-size: 2.6vh;">Series</a>
                        <div class="dropdown-menu"><a class="dropdown-item"><i class="far fa-clock"
                                    style="margin: 0px;margin-right: 6px;"></i>This feature is
                                coming soon</a>

                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href={{ url('/Contact') }}
                            style="font-size: 2.6vh;">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <div class="search-box">
                            <form action={{ url('/Search') }} method="get">
                                <button class="btn-search"><i class="fas fa-search"></i></button>

                                <input required name="q" type="text" class="input-search"
                                    placeholder="Search for something...">

                            </form>
                        </div>
                    </li>
                </ul>
                @if (!Session::has('login'))
                    <span class="navbar-text actions">
                        <a class="login" href={{ url('/Login') }} style="color: rgb(255,255,255);">Log
                            In</a><a class="btn btn-light action-button" role="button" href={{ url('/SignUp') }}
                            style="background: rgb(221,21,44);">Sign Up</a></span>
                @else
                    <div class="dropdown "><a class="dropdown-toggle" aria-expanded="true"
                            data-bs-toggle="dropdown" href="#" style="color: var(--bs-white);font-weight: bold;">
                            @php
                                if (Session::get('avatar') == '') {
                                    $img = 'assets/img/avatars/avatar.png';
                                } else {
                                    $img = 'assets/img/avatars/' . Session::get('avatar');
                                }
                            @endphp
                            <img class="rounded-circle " src='{{ $img }}' style="width: 8vh;"></a>
                        <div class="dropdown-menu  ">
                            <h6 class="dropdown-header">{{ Session::get('username') }}</h6>
                            @if (Session::get('role') == 1)
                                <a class="dropdown-item" href={{ url('/Dash/Main') }}> <i
                                        class="fas fa-cog"></i>
                                    Dashboard</a>
                            @endif
                            <h6 class="dropdown-divider"></h6>
                            <a class="dropdown-item" href={{ url('/Favs') }}><i class="fa fa-heart"></i> My
                                Favorites</a>

                            <a class="dropdown-item" href={{ url('/Profile') }}>
                                <i class="fa fa-user"></i> My Profile

                            </a>
                            <a class="dropdown-item" id="joinSession">
                                <i class="fas fa-plus"></i> Join a Session

                            </a>
                            <script>
                                $('#joinSession').on("click", () => {

                                    alertify.prompt("Join a session", "Please insert below the session ID : ", "", (e, val) => {
                                        if (val !== "") {
                                            $.ajax({
                                                type: "get",
                                                url: "{{ url('/CheckSession') }}",
                                                data: {
                                                    _token: "{{ csrf_token() }}",
                                                    id: val
                                                },
                                                success: function(res) {
                                                    alertify.success(res);
                                                    window.location.href = `{{ url('/Session/${val}') }}`

                                                },
                                                error: (r) => {
                                                    alertify.error(r.responseText)
                                                }
                                            });

                                        } else {
                                            e.cancel = true
                                        }
                                    }, () => {

                                    })
                                })
                            </script>
                            <a class="dropdown-item" href={{ url('/Logout') }}><i class="fas fa-sign-out-alt"></i>
                                Logout</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="container d-flex flex-column pulse animated"
        style="width: 100%;margin: 0px;padding: 0px;min-width: 100%;height: 100%;min-height: 100vh">



        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="assets/owlcarousel/owl.carousel.min.js"></script>
        <script>
            function MustLogin() {
                alertify.confirm("Warning",
                    "Thank you for choosing our website. But , unfortuantly , you should create an account and log In to watch any movie.<br>Thank you for your understanding. ",
                    (e) => {
                        window.location.href = "{{ url('/SignUp') }}"
                    }, () => {}
                )
            }
        </script>


</body>

<script>

</script>

</html>
