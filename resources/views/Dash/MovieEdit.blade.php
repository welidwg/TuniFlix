@include('Dash/mainNav')
@php
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Support\Facades\Crypt;

$id = Crypt::decrypt($idMovie);
$movie = Movie::where('idMovie', $id)->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Movies Edit </title>
    <style>
        .form-control-user,
        .form-control {
            border: 2px solid #ccc;
            color: black
        }

        label {
            color: black;
            font-weight: bolder
        }

    </style>

</head>

<body>
    <div class="card shadow" style="margin: 0px;padding: 0px;width: 100%">
        <div class="card-header py-3">
            <p class="m-0 fw-bold" style="color: rgb(221,22,45);">"{{ $movie->Name }}" </p>
        </div>
        <div class="card-body">
            <div class="p-5">

                <form class="user" id="editMovie" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="" class="form-label mx-4 ">Movie Name</label>

                            <input class="form-control form-control-user" type="text" id="exampleFirstName-1"
                                placeholder="Movie Name" value="{{ $movie->Name }}" name="name" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Other Names</label>

                            <input value="{{ $movie->OtherName }}" class="form-control form-control-user" type="text"
                                id="exampleFirstName-2" placeholder="Other name ( optional )" name="otherName">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="" class="form-label mx-4 ">Duration</label>

                            <input class="form-control form-control-user" type="number" id="exampleFirstName-3" min="30"
                                max="200" placeholder="Duration in minutes (exp:128)" name="duration"
                                value="{{ $movie->Duration }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Release Year</label>

                            <input class="form-control form-control-user" min="1900 " type="number" max="2022" step="1"
                                value={{ $movie->DateReleased }} title="Release Year" placeholder="Release Year"
                                name="Year">
                        </div>
                    </div>
                    <div class="mb-3"></div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="" class="form-label mx-4 ">Director</label>

                            <input class="form-control form-control-user" type="text" id="examplePasswordInput"
                                value="{{ $movie->Director }}" placeholder="Director" name="director">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Change movie poster</label>

                            <input type="file" accept="image/*" title="poster" id="poster"
                                class="form-control form-control-user" placeholder="poster" name="poster">


                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="" class="form-label mx-4 ">Language</label>

                            <input class="form-control form-control-user" type="text" id="examplePasswordInput-1"
                                value="{{ $movie->Lang }}" placeholder="Language" name="lang">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Quality</label>

                            <input class="form-control form-control-user" type="text" id="exampleRepeatPasswordInput-1"
                                value="{{ $movie->Quality }}" placeholder="Quality" name="quality">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Movie links</label>

                            @php
                                $i = 0;
                                $links = explode(',', $movie->Links);
                            @endphp
                            @foreach ($links as $link)
                                @php
                                    $i++;
                                @endphp
                                <input class="form-control form-control-user" type="url" aria-describedby=""
                                    placeholder="Link" style='margin:9px' name="link[]" value="{{ $link }}">
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Add more links</label>

                            <div style="display: flex;flex-direction: row;padding: 9px">
                                <select name="" id="numberLink" class="form-control w-100">
                                    @for ($i = 0; $i < 6; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button class="btn btn-danger rounded text-light "
                                    style="margin-left: 8px;background: #dd152c;" type="button" role="link"
                                    id="addLink">+</button>

                            </div>

                        </div>


                    </div>
                    <div class="row mb-3 " id="LinkContainer"></div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Categories</label>
                            @php
                                $categs = explode(',', $movie->category);
                                $j = 0;
                            @endphp
                            @foreach ($categs as $categ)
                                @php
                                    $j++;
                                @endphp
                                <div class="form-check mx-4">
                                    <input class="form-check-input" name="remCat[]" type="checkbox"
                                        value=" {{ $categ }}" id="{{ $j }}">
                                    <label class="form-check-label" for="{{ $j }}">
                                        {{ $categ }}
                                    </label>
                                </div>
                            @endforeach
                            <small style="color:#dd152c">*check a category if you want to remove it from the
                                list</small>

                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label mx-4 ">Add category/categories to the
                                movie</label>

                            <?php
                            
                            $k = 0;
                            $tt = [];
                            ?>
                            <select class="form-control " name="category[]" id="cat" multiple>

                                @php
                                    $categs = Category::whereNotIn('label', $categs)->get();
                                @endphp
                                @foreach ($categs as $cat)
                                    <option value="{{ $cat->label }}">{{ $cat->label }}</option>
                                @endforeach



                            </select>
                        </div>



                    </div>




                    <div class="row mb-3">
                        <label for="" class="form-label mx-4 ">Teaser Link</label>

                        <input class="form-control form-control-user" type="url" id="exampleInputEmail-1"
                            aria-describedby="emailHelp" value="{{ $movie->TeaserLink }}" placeholder="Teaser Link"
                            name="teaser" required>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="form-label mx-4 ">Subject</label>

                        <textarea class="form-control" placeholder="Subject" name="subject" required>{{ $movie->Subject }}</textarea>
                    </div>
                    <input type="hidden" name="idMovie" value={{ $id }}>
                    <button class="btn d-block btn-user w-50 mx-auto" type="submit"
                        style="background: #dd152c;color: rgb(255,255,255);">Save</button>
                    <hr>
                    <hr>
                    @csrf
                </form>
                <script>
                    $(function() {
                        $("#editMovie").on("submit", (e) => {
                            e.preventDefault();
                            let form = $("#editMovie")[0]
                            let formdata = new FormData(form)
                            $.ajax({
                                type: "POST",
                                url: "/EditMovie",
                                data: formdata,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    alertify.success(res);
                                    console.log(res.toString());
                                },
                                error: (r) => {
                                    console.log(r.responseText);
                                    alertify.error(r.responseText);

                                }
                            });
                        });
                        $("#addLink").on("click", function(e) {
                            $("#LinkContainer").html("");

                            let num = $('#numberLink').val();
                            if (num != 0) {
                                for (let i = 0; i < num; i++) {
                                    $("#LinkContainer").append(`
                                    <input class="form-control form-control-user"
                            type="url" aria-describedby="" style='margin:9px' placeholder="Link ${i+1}" name="newLink[]" required >
                                    `);


                                }
                            }



                        });
                    });
                </script>
            </div>
        </div>
    </div>

</body>
</div>
</div>

@include('Dash/footer')

</html>
