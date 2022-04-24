@include('nav')
@php
use App\Models\Movie;
@endphp
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Contact Us </title>
</head>

<body>
    <section class="login-clean"
        style="height: 100%;padding-top: 20px;padding-bottom: 17px;background: rgba(241,247,252,0);">
        <form id="send" method="post" style="background: rgba(0,0,0,0.44);padding-top: 21px;margin-top: 32px">
            <div class=" d-flex flex-column illustration"><img class="mx-auto" src="assets/img/Chehia.png"
                    style="width: 15vw;"><span
                    style="font-size: 5vh;font-family: Bangers, serif;color: rgb(221,21,44);">Contact Us</span></div>
            <div class="mb-3">
                <label for="" class="text-light" style="font-size: 2.5vh">
                    Your Email
                </label>
                <input @if (Session::has('login')) value="{{ Session::get('email') }}" @endif
                    class="form-control" type="text" name="email" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
                <label for="" class="text-light" style="font-size: 2.5vh">
                    Subject
                </label>
                <select class="form-control" name="title">
                    @if (Request::has('idMovie'))
                        <option value="MediaIssues">Media Issues</option>
                    @else
                        <option value="Complains">Complains</option>
                        <option value="MediaIssues">Media Issues</option>
                        <option value="MovieSuggestions">Movie Suggestions</option>
                    @endif

                </select>
            </div>
            @if (Request::has('idMovie'))
                @php
                    $iss = Movie::where('idMovie', Request::get('idMovie'))->first();
                @endphp
                <div class="mb-3">
                    <label for="" class="text-light" style="font-size: 2.5vh">
                        Media Name
                    </label>
                    <input class="form-control" value="{{ $iss->Name }}" type="text" disabled>
                    <input type="hidden" name="idMovie" value="{{ $iss->idMovie }}">
                </div>
            @endif


            <div class="mb-3">
                <label for="" class="text-light" style="font-size: 2.5vh">
                    Your Message
                </label>
                <textarea class="form-control" type="text" name="message" placeholder="Your Message" required></textarea>
            </div>

            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                    style="background: rgb(221,21,44);">Send</button></div>
            @csrf
        </form>
    </section>
    <script>
        $("#send").on("submit", function(e) {
            e.preventDefault()
            $.ajax({
                type: "post",
                url: "{{ url('/ContactSend') }}",
                data: $("#send").serialize(),
                success: function(res) {
                    alertify.success(res);
                    setTimeout(() => {
                        $("#send").trigger("reset")
                    }, 500);
                },
                error: (r) => {
                    console.log(r.responseText);
                    alertify.error(r.responseText);
                }
            });

        });
    </script>
</body>
</div>
@include('footer')

</html>
