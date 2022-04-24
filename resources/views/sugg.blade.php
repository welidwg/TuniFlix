@php
use App\Models\Suggestion;
use App\Models\Movie;
$sugg = Suggestion::where('idSuggestion', 1)->first();
$movie = Movie::where('idMovie', $sugg->idMedia)->first();
@endphp

<div class="movie_card" id="sug">


    <div class="info_section">
        <div class="movie_header">
            <span style="color: white">Today's Suggestion</span>
            <img class="locandina" src="assets/img/posters/{{ $movie->Poster }} " />
            <h1>{{ $movie->Name }} </h1>
            <h4>{{ $movie->DateReleased }} , {{ $movie->Director }} </h4>
            <span class="minutes">{{ $movie->Quality }}</span>
            <span class="minutes"> {{ $movie->Duration }} min</span>
            <p class="type"> {{ $movie->category }}</p>
        </div>

        <div class="movie_desc">
            <p class="text">
                {{ $movie->Subject }}
            </p>
        </div>

        <div class="movie_social">
            <ul>
                <li><a href="{{ $movie->TeaserLink }}" target="__blank" class="btn btn-danger  ">Teaser
                        <i class="fab fa-youtube"></i></a>
                </li>


                <li><a data-bss-hover-animate=""
                        @if (Session::has('login')) href="{{ url('/Watch/Movie') }}/{{ $movie->idMovie }}"
                        @else
                        onclick="MustLogin()" @endif
                        target="" class="btn btn-danger ">Watch Now
                        <i class="fas fa-play"></i></a>
                </li>
                @if (Session::get('role') == '1')
                    <li id="shuff">
                        <a class="btn btn-danger  ">Shuffle
                            <i class="fas fa-random"></i> </a>
                    </li>
                @endif

            </ul>
        </div>


    </div>

    <div class="blur_back bright_back"
        style="background: url('assets/img/posters/{{ $movie->Poster }}');background-repeat: no-repeat;background-position: right;background-size: cover">
    </div>

</div>
<script>
    $(function() {});
</script>
<script>
    $(function() {
        $("#shuff").on("click", (e) => {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ url('/GetSuggestion') }}",
                beforeSend: () => {

                },
                success: function(res) {
                    console.log(res);
                    window.location.reload();

                },
                error: (e) => {
                    console.log(e.responseText);
                    alerify.error("Erreur de serveur !");

                }
            });
        })
    });
</script>
