@include('nav')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - SignUp </title>
</head>

<body>
    <section class="login-clean"
        style="height: 100vh;padding-top: 53px;padding-bottom: 17px;background: rgba(241,247,252,0);">
        <form id="signup" method="post" style="background: rgba(0,0,0,0.44);padding-top: 5px;margin-top: 0px;">
            @csrf
            <h2 class="visually-hidden">Login Form</h2>
            <div class="d-flex flex-column illustration"><img class="mx-auto" src="assets/img/Chehia.png"
                    style="width: 15vw;"><span
                    style="font-size: 5vh;font-family: Bangers, serif;color: rgb(221,21,44);">Sign UP</span></div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="mb-3"><input class="form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="mb-3"><input class="form-control" type="password" name="password"
                    placeholder="Password"></div>
            <div class="mb-3"><input class="form-control" type="password" name="confirm"
                    placeholder="Repeat your password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                    style="background: rgb(221,21,44);">Sign Up <div class="spinner-border text-light" id="spinn"
                        style="float: right;display: none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div></button></div><a class="forgot" href={{ url('/Login') }} style="color: white;">You
                have an account ? Login now&nbsp;</a>
        </form>
    </section>
    <script>
        $("#signup").on("submit", function(e) {
            e.preventDefault()
            $.ajax({
                type: "post",
                url: "{{ url('/CreatingAccount') }}",
                data: $("#signup").serialize(),
                beforeSend: function() {
                    $("#spinn").css("display", "block");
                },
                success: function(res) {
                    $("#spinn").fadeOut();
                    alertify.success(res);
                    setTimeout(() => {
                        window.location.href = "{{ url('/Login') }}"

                    }, 700);


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
