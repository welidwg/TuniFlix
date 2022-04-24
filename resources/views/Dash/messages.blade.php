@include('Dash/mainNav')
@php
use App\Models\Message;
use App\Models\Movie;
$titles = Message::select('Title')
    ->distinct()
    ->get();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Messages Center </title>
    <style>
        #card {
            position: relative;
            border: solid 1px #212121;
            padding: 10px 11px 10px 11px;
            margin-top: 30px;
            background-color: #212121;
            border-radius: 10px;
            color: #fff;
        }

        .post-txt {
            font-size: 16px;
            margin-bottom: 0
        }

        .quote-img {
            position: absolute;
            top: 32px;
            left: 25px;
            width: 30px;
            height: 30px
        }

        .nice-img {
            width: 20px;
            height: 25px;
            margin-bottom: 7px
        }

        .arrow-down {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-top: 20px solid #212121;
            margin-left: 85px
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }

        .profile-pic {
            position: absolute;
            width: 75px;
            height: auto;
            border-radius: 100%;
            margin-top: 15px
        }

        .profile-name {
            position: absolute;
            font-size: 16px;
            margin-top: 40px;
            color: #616161;
            margin-left: 85px
        }

        .date {

            float: right;
        }

    </style>
</head>

<body>
    @php
        $i = 0;
    @endphp
    <div class="container">
        <div class="row ">
            <div class="col-md-10 mx-auto">
                <ul class="nav nav-pills" id="myTab">
                    @if ($titles)


                        @foreach ($titles as $title)
                            @php
                                $i++;
                            @endphp

                            <li class="nav-item ">
                                @php
                                    $m = Message::where('Title', $title->Title)->get();
                                @endphp
                                <a href="#{{ $title->Title }}"
                                    class="nav-link @if ($i == 1) active @else '' @endif "
                                    data-bs-toggle="tab">{{ $title->Title }} <span
                                        class="badge bg-warning badge-counter">{{ count($m) }}</span></a>

                            </li>
                        @endforeach
                    @endif

                </ul>
                <div class="tab-content">
                    @if ($titles)
                        @php
                            $j = 0;
                        @endphp

                        @foreach ($titles as $title)
                            @php
                                $j++;
                                $msgs = Message::where('Title', $title->Title)->get();
                            @endphp
                            <div class="tab-pane fade @if ($j == 1) show active @else '' @endif "
                                id="{{ $title->Title }}">
                                @if ($msgs)
                                    @foreach ($msgs as $msg)
                                        <div class="row justify-content-center">
                                            <div class=" col-sm-11 col-md-9 col-lg-8 col-xl-7">
                                                <div class="card" id="card">
                                                    <p class="post"> <span></span> <span
                                                            class="post-txt">{{ $msg->Subject }}</span> <br>
                                                        @if ($msg->idMedia)
                                                            @php
                                                                $media = Movie::where('idMovie', $msg->idMedia)->first();
                                                            @endphp
                                                            <span class="media">

                                                                {{ $media->Name }}
                                                            </span>
                                                        @endif
                                                        <span class="date">{{ $msg->DateSent }}</span>
                                                    </p>
                                                </div>
                                                <div class="arrow-down"></div>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="" style="margin-bottom: 80px"> <img
                                                            class="profile-pic fit-image"
                                                            src="../assets/img/avatars/avatar.png">
                                                        <p class="profile-name">
                                                            {{ $msg->Email }}

                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    There is no Messages yet
                                @endif
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</body>


</html>
