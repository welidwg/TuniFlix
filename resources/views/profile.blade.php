@include('nav')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Profile </title>
</head>

<body>
    <div class="container mx-auto"
        style="border-radius: 9px;padding: 48px;margin: 26px;background: rgba(255,255,255,0.54);">

        <div class="container">
            <div class="main-body">
                <nav class="main-breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item text-danger" style="font-weight: bolder">Profile</li>
                    </ol>
                </nav>
                @php
                    if (Session::get('avatar') == '') {
                        $img = 'assets/img/avatars/avatar.png';
                    } else {
                        $img = 'assets/img/avatars/' . Session::get('avatar');
                    }
                @endphp
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card" style="border-radius: 15px">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center"><img
                                        class="rounded-circle" src="{{ $img }}" alt="Admin" width="150" />
                                    <div class="mt-3">
                                        <h4> {{ Session::get('username') }} </h4>

                                        <form action="" id="changeAvatar" class="d-flex"
                                            enctype="multipart/form-data" style="flex-direction: column">
                                            <label for="avatar" class="text-secondary mb-3">Change your avatar <i
                                                    class="fas fa-pen"></i>
                                            </label>
                                            <input accept="image/*" id="avatar" name="avatar" type="file"
                                                class="form-control" hidden>
                                            <input type="hidden" name="email" value={{ Session::get('email') }}>
                                            <button class="btn btn-primary">Save</button>
                                            @csrf

                                        </form>
                                        <script>
                                            $(function() {
                                                $("#changeAvatar").on("submit", function(e) {
                                                    let form = $("#changeAvatar")[0]
                                                    let formdata = new FormData(form)
                                                    e.preventDefault()
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{ url('/ChangeAvatar') }}",
                                                        data: formdata,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function(res) {
                                                            alertify.success(res);
                                                            window.location.reload()

                                                        },
                                                        error: (r) => {
                                                            console.log(r.responseText);
                                                            alertify.error(r.responseText);

                                                        }
                                                    });
                                                });
                                                $("#edit").on("submit", function(e) {
                                                    e.preventDefault()
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{ url('/EditProfile') }}",
                                                        data: $('#edit').serialize(),
                                                        success: function(res) {
                                                            alertify.success(res);
                                                            setTimeout(() => {
                                                                window.location.reload()

                                                            }, 700);

                                                        },
                                                        error: (r) => {
                                                            console.log(r.responseText);
                                                            alertify.error(r.responseText);

                                                        }
                                                    });
                                                });


                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3" style="border-radius: 15px">
                            <div class="card-body">
                                <form id="edit" style="padding: 16px">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="text"
                                                value={{ Session::get('username') }} placeholder="empty" id="username"
                                                name="username" required>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="email"
                                                value={{ Session::get('email') }} placeholder="empty" id="email"
                                                name="email" required>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">New Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="password"
                                                placeholder="your new password" id="password" name="password">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Repeat password </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="password"
                                                placeholder="repeat your new password" id="conform" name="confirm">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Your current password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="password" placeholder="current password"
                                                id="oldpass" name="old" required>
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-12"><button type="submit" class="btn btn-primary "
                                                style="float: right" target="__blank">Edit</button>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</div>
@include('footer')

</html>
