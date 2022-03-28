<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets1/bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets1/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets1/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/style.css">
    <link rel="stylesheet" href="../assets1/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="shortcut icon" href="../assets/img/Chehia.png" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>
@if (Session::has('login') && Session::get('role') == 1)

    <body id="page-top">
        <div id="wrapper">
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
                style="background: var(--bs-white);box-shadow: -8px 0px 11px 1px rgb(0,0,0);">
                <div class="container-fluid d-flex flex-column p-0"><a
                        class="navbar-brand d-flex flex-column justify-content-center align-items-center sidebar-brand m-0"
                        href="#">
                        <div class="sidebar-brand-icon rotate-n-15"></div><img class="d-none d-md-block"
                            src="../assets1/img/logoTX.png" style="width: 19vh;"><img class="d-block d-sm-none"
                            src="../assets1/img/Chehia.png" style="width: 50px;">
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-dark" id="accordionSidebar">
                        <li class="nav-item"><a class="nav-link" href={{ url('/Dash/Main') }}
                                style="color: rgb(0,0,0);"><i class="fas fa-tachometer-alt"
                                    style="color: rgb(7,7,7);"></i><span>Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-divider"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href={{ url('/Dash/MoviesList') }}><i
                                    class="fas fa-film" style="color: #000000;"></i><span
                                    style="color: #000000;">Movies
                                    List</span></a></li>
                        <li class="nav-item"><a class="nav-link" href={{ url('/Dash/MovieAdd') }}><i
                                    class="fas fa-plus-square" style="color: #000000;"></i><span
                                    style="color: #000000;">Movie Add</span></a></li>
                        <div class="dropdown-divider"></div>

                        <li class="nav-item" id="openM">
                            <a class="nav-link">
                                <i class="fas fa-plus-square" style="color: #000000;"></i>
                                <span style="color: #000000;">Category Add</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-list-alt" style="color: #000000;"></i>
                                <span style="color: #000000;">Categories List</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <script>
                            $("#openM").on("click", (e) => {
                                alertify.prompt('Category Add', 'Please Add Category label', '', (evt, val) => {
                                    if (val == "") {
                                        alertify.error("Please don't leave the field empty")
                                        evt.cancel = false;

                                    } else {
                                        $.ajax({
                                            type: "post",
                                            url: "/AddCategory",
                                            data: {
                                                label: val,
                                                _token: "{{ csrf_token() }}"
                                            },
                                            success: function(res) {
                                                alertify.success(res)

                                            },
                                            error: (r) => {
                                                console.log(r.responseText);
                                                alertify.error(r.responseText);

                                            }
                                        });

                                    }
                                }, () => {})
                            })
                        </script>

                        <li class="nav-item"><a class="nav-link" href={{ url('/Dash/Users') }}><i
                                    class="fas fa-user-friends" style="color: #000000;"></i><span
                                    style="color: #000000;">Users List</span></a></li>
                        <div class="dropdown-divider"></div>

                        <li class="nav-item"><a class="nav-link" href="#"><i
                                    class="fab fa-facebook-messenger" style="color: #000000;"></i><span
                                    style="color: #000000;">Messages Center</span></a>
                            <a class="nav-link" href={{ url('/') }}><i class="fas fa-arrow-circle-left"
                                    style="color: #000000;"></i><span style="color: #000000;">Exit</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand sticky-top shadow mb-4 topbar static-top"
                        style="text-shadow: 0px 0px;" id="nav2">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                                id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                            aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                                class="badge bg-danger badge-counter">3+</span><i
                                                class="fas fa-bell fa-fw"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                            <h6 class="dropdown-header">alerts center</h6><a
                                                class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-primary icon-circle"><i
                                                            class="fas fa-file-alt text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 12, 2019</span>
                                                    <p>A new monthly report is ready to download!</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-success icon-circle"><i
                                                            class="fas fa-donate text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 7, 2019</span>
                                                    <p>$290.29 has been deposited into your account!</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-warning icon-circle"><i
                                                            class="fas fa-exclamation-triangle text-white"></i></div>
                                                </div>
                                                <div><span class="small text-gray-500">December 2, 2019</span>
                                                    <p>Spending Alert: We've noticed unusually high spending for your
                                                        account.</p>
                                                </div>
                                            </a><a class="dropdown-item text-center small text-gray-500" href="#">Show
                                                All
                                                Alerts</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                            aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                                class="badge bg-danger badge-counter">7</span><i
                                                class="fas fa-envelope fa-fw"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                            <h6 class="dropdown-header">alerts center</h6><a
                                                class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                        src="../assets1/img/avatars/avatar4.jpeg">
                                                    <div class="bg-success status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate"><span>Hi there! I am wondering if you
                                                            can
                                                            help me with a problem I've been having.</span></div>
                                                    <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                        src="../assets1/img/avatars/avatar4.jpeg">
                                                    <div class="bg-success status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate"><span>Hi there! I am wondering if you
                                                            can
                                                            help me with a problem I've been having.</span></div>
                                                    <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                        src="../assets1/img/avatars/avatar2.jpeg">
                                                    <div class="status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate"><span>I have the photos that you ordered
                                                            last month!</span></div>
                                                    <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                        src="../assets1/img/avatars/avatar3.jpeg">
                                                    <div class="bg-warning status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate"><span>Last month's report looks great, I
                                                            am
                                                            very happy with the progress so far, keep up the good
                                                            work!</span></div>
                                                    <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                                </div>
                                            </a><a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3"><img class="rounded-circle"
                                                        src="../assets1/img/avatars/avatar5.jpeg">
                                                    <div class="bg-success status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate"><span>Am I a good boy? The reason I ask
                                                            is
                                                            because someone told me that people say this to all dogs,
                                                            even
                                                            if they aren't good...</span></div>
                                                    <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                                </div>
                                            </a><a class="dropdown-item text-center small text-gray-500" href="#">Show
                                                All
                                                Alerts</a>
                                        </div>
                                    </div>
                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end"
                                        aria-labelledby="alertsDropdown"></div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                            aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2  small"
                                                id="usernameNav">{{ Session::get('username') }}</span>
                                            @php
                                                if (Session::get('avatar') == '') {
                                                    $img = '../assets/img/avatars/avatar.png';
                                                } else {
                                                    $img = '../assets/img/avatars/' . Session::get('avatar');
                                                }
                                            @endphp
                                            <img class="border rounded-circle img-profile" src={{ $img }}></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                                href={{ url('/Logout') }}><i
                                                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="container-fluid bounce animated">


                        <script src="../assets1/bootstrap/js/bootstrap.min.js"></script>
                        <script src="../assets1/js/bs-init.js"></script>
                        <script src="../assets1/js/theme.js"></script>
                        <script src="../assets1/js/chart.min.js"></script>
                        <script src="../assets1/js/custom.js"></script>

    </body>
@else
    <script>
        window.location.href = "/"
    </script>
@endif

</html>
