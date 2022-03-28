@include('nav')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Login </title>
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
                </button></div><a class="forgot" href="#" style="color: white;">Forgot your email or
                password?</a>
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
    </script>
</body>
</div>
@include('footer')

</html>
