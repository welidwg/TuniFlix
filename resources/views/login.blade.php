@include('nav')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Login </title>
</head>

<body>
    <section class="login-clean"
        style="height: 100vh;padding-top: 53px;padding-bottom: 17px;background: rgba(241,247,252,0);">
        <form id="login" method="post" style="background: rgba(0,0,0,0.44);padding-top: 21px;margin-top: 32px;">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="d-flex flex-column illustration"><img class="mx-auto" src="assets/img/Chehia.png"
                    style="width: 15vw;"><span
                    style="font-size: 5vh;font-family: Bangers, serif;color: rgb(221,21,44);">Login</span></div>
            <div class="mb-3"><input class="form-control" type="text" name="login"
                    placeholder="Email/Username"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password"
                    placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                    style="background: rgb(221,21,44);">
                    Log In
                    <div class="spinner-border text-light" id="spinn" style="float: right;display: none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button></div><a class="forgot" id="forgot" style="color: white;cursor: pointer;">Forgot your
                username or
                password?</a>
            <br>
            <div class="spinner-border text-light mx-auto" id="spinn1" style="display: none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            @csrf
        </form>
    </section>
    <script>
        $("#login").on("submit", function(e) {
            e.preventDefault()
            $.ajax({
                type: "post",
                url: "{{ url('/Logging') }}",
                data: $("#login").serialize(),
                beforeSend: function() {
                    $("#spinn").css("display", "block");
                },
                success: function(res) {
                    window.location.href = "{{ url('/') }}"
                    $("#spinn").fadeOut();

                },
                error: (r) => {
                    alertify.error(r.responseText);
                    $("#spinn").fadeOut();

                }
            });

        });
        $("#forgot").on("click", () => {
            alertify.prompt("Password Recovery", "Please insert your email",
                "", (e, val) => {
                    if (val == "") {
                        e.cancel = true
                        alertify.error("Please insert a valid email")
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/SendCode",
                            data: JSON.stringify({
                                email: val,
                                _token: "{{ csrf_token() }}"
                            }),
                            dataType: "Json",
                            contentType: "application/json",
                            beforeSend: () => {
                                $("#spinn1").css("display", "block");

                            },
                            success: function(res) {
                                $("#spinn1").fadeOut();
                                if (res.code) {
                                    let cd = CryptoJS.AES.encrypt(res.code, "Secret Passphrase");
                                    localStorage.setItem("code", cd.toString());
                                    alertify.prompt("Confirmation",
                                        "We have sent you an email with a verification code, please insert that code below ",
                                        "", (ev, value) => {
                                            ev.cancel = true;
                                            if (value == "") {
                                                alertify.error("Please insert the code !");
                                            } else {

                                                let decrypted = CryptoJS.AES.decrypt(
                                                    localStorage.getItem("code"),
                                                    "Secret Passphrase");
                                                var plaintext = decrypted.toString(CryptoJS.enc
                                                    .Utf8);

                                                if (value == plaintext) {
                                                    alertify.prompt("New Password",
                                                        "Please insert your new password carefully",
                                                        "", (evv, val1) => {
                                                            if (val1 == "") {
                                                                evv.cancel = true;
                                                                alertify.error(
                                                                    "Please don't left the field empty !"
                                                                );

                                                            } else {
                                                                $.ajax({
                                                                    type: "post",
                                                                    url: "/ChangePass",
                                                                    data: {
                                                                        password: val1,
                                                                        email: val,
                                                                        _token: "{{ csrf_token() }}"
                                                                    },
                                                                    beforeSend: () => {
                                                                        alertify
                                                                        $("#spinn1")
                                                                            .css(
                                                                                "display",
                                                                                "block"
                                                                            )

                                                                    },
                                                                    success: function(
                                                                        res) {
                                                                        alertify
                                                                            .success(
                                                                                res
                                                                            );
                                                                        localStorage
                                                                            .removeItem(
                                                                                "code"
                                                                            );
                                                                        $("#spinn1")
                                                                            .fadeOut()

                                                                    },
                                                                    error: (e) => {
                                                                        alertify
                                                                            .error(
                                                                                "Server error , please try again"
                                                                            )
                                                                        console
                                                                            .log(
                                                                                e
                                                                                .responseText
                                                                            );
                                                                        $("#spinn1")
                                                                            .fadeOut()


                                                                    }
                                                                });
                                                            }

                                                        }, (e) => {}).set({
                                                        type: "password",
                                                        labels: {
                                                            ok: "confirm",
                                                        }
                                                    })
                                                } else {
                                                    alertify.error("Invalid Code");

                                                }
                                            }
                                        }, (c) => {})

                                }

                            },
                            error: (r) => {
                                $("#spinn1").fadeOut();

                                console.log(r.responseText);
                                alertify.error(r.responseText);

                            }
                        });
                    }
                }, () => {}).set({
                type: "email",
                labels: {
                    ok: "verify"
                }
            })
        })
    </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>

</div>
@include('footer')

</html>
