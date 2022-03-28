@include('nav')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Home </title>
</head>

<body>
    <div class="row d-flex flex-row">
        <div class="col-md-6 d-inline-flex" style="height: 100%;min-height: 100vh;">
            <div class="d-flex flex-column justify-content-center align-self-center mx-auto"
                style="padding: 41px;width: 70vw;">
                <h1 class="fw-bolder"
                    style="color: #dd152c;font-size: 7.5vh;font-family: Staatliches, serif;font-weight: bold;text-shadow: 0px 4px 5px #000000;">
                    Welcome To TUNIFLIX
                    <h1 style="color: red">
                        <?php echo Route::currentRouteName(); ?>


                    </h1>
                </h1><span
                    style="color: rgb(255,255,255);font-size: 4vh;font-family: 'Fjalla One', sans-serif;text-shadow: 0px 2px 0px rgb(0,0,0);">TuniFlix
                    is your best choice to watch an unlimited number of movies and series with no ads or
                    anything
                    that will make you unconfortable.</span><a class="btn btn-primary text-nowrap mx-auto" role="button"
                    style="background: rgb(221,21,44);margin: 0px;border-color: rgba(255,255,255,0);border-top-color: rgb(255,;border-right-color: 255,;border-bottom-color: 255);border-left-color: 255,;border-radius: 23px;margin-top: 17px;"
                    href="/Discover/All">Start Discovering<i class="fa fa-search" style="margin: 11px;"></i></a>
            </div>
        </div>
        <div class="col-md-6 d-flex  align-items-center align-content-center"><img class="img-fluid mx-auto"
                src="assets/img/logoTX.png" style="height: auto;"></div>
    </div>
</body>
</div>
@include('footer')

</html>
