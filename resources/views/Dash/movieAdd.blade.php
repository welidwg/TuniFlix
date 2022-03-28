@include('Dash/mainNav')
@php
use App\Models\Category;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Movies List</title>

</head>

<body>
    <div class="card shadow" style="margin: 49px;padding: 0px;">
        <div class="card-header py-3">
            <p class="m-0 fw-bold" style="color: rgb(221,22,45);">Movie Add</p>
        </div>
        <div class="card-body">
            <div class="p-5">
                <div class="text-center">
                    <h4 class="text-dark mb-4">Please fill the form carefully !&nbsp;</h4>
                </div>
                <form class="user" id="addMovie" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text"
                                id="exampleFirstName-1" placeholder="Movie Name" name="name" required></div>
                        <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                id="exampleFirstName-2" placeholder="Other name ( optional )" name="otherName"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="number"
                                id="exampleFirstName-3" min="30" max="200" placeholder="Duration in minutes (exp:128)"
                                name="duration">
                        </div>
                        <div class="col-sm-6"><input class="form-control form-control-user" min="1900 "
                                type="number" max="2022" step="1" title="Release Year" placeholder="Release Year"
                                name="Year">
                        </div>
                    </div>
                    <div class="mb-3"></div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text"
                                id="examplePasswordInput" placeholder="Director" name="director"></div>
                        <div class="col-sm-6">
                            <input type="file" accept="image/*" title="poster" id="poster"
                                class="form-control form-control-user" placeholder="poster" name="poster" required>


                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text"
                                id="examplePasswordInput-1" placeholder="Language" name="lang"></div>
                        <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                id="exampleRepeatPasswordInput-1" placeholder="Quality" name="quality"></div>
                    </div>
                    <div class="row mb-3" id="LinkContainer"><input class="form-control form-control-user"
                            type="url" aria-describedby="" placeholder="Link" name="link[]" required>
                    </div>
                    <div class="row mb-3">
                        <label for="cat">Please select the movie category/categories</label>

                        <select class="form-control " name="category[]" id="cat" multiple required>
                            @php
                                $cats = Category::all();
                            @endphp
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->label }}">{{ $cat->label }}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class="row mb-3 " id="">
                        <div style="display: inline-flex;flex-direction: row;padding: 9px">
                            <label for="" style="margin-right: 8px">Add more links </label>
                            <select name="" id="numberLink" class="form-control w-50">
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                @endfor
                            </select>
                            <button class="btn btn-danger rounded text-light "
                                style="margin-left: 8px;background: #dd152c;" type="button" role="link"
                                id="addLink">+</button>

                        </div>

                    </div>


                    <div class="row mb-3"><input class="form-control form-control-user" type="url"
                            id="exampleInputEmail-1" aria-describedby="emailHelp" placeholder="Teaser Link"
                            name="teaser" required>
                    </div>
                    <div class="row mb-3">
                        <textarea class="form-control" placeholder="Subject" name="subject" required></textarea>
                    </div>
                    <button class="btn d-block btn-user w-100" type="submit"
                        style="background: #dd152c;color: rgb(255,255,255);">Add Movie</button>
                    <hr>
                    <hr>
                    @csrf
                </form>
                <script>
                    $(function() {
                        $("#addMovie").on("submit", (e) => {
                            e.preventDefault();
                            let form = $("#addMovie")[0]
                            let formdata = new FormData(form)
                            $.ajax({
                                type: "POST",
                                url: "/AddMovie",
                                data: formdata,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    alertify.success(res);
                                    $("#addMovie").trigger("reset")
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
                            for (let i = 0; i < num; i++) {
                                $("#LinkContainer").append(`
                                    <input class="form-control form-control-user"
                            type="url" aria-describedby="" style='margin:9px' placeholder="Link ${i+1}" name="link[]" required>
                                    `);


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
