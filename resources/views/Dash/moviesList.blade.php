@include('Dash/mainNav')
<!DOCTYPE html>
<html lang="en">
@php
use App\Models\Movie;
use Illuminate\Support\Facades\Crypt;

@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}- Movies List</title>

</head>

<body>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="m-0 fw-bold" style="color: rgb(221,21,44);">Movies List</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                            class="form-label"></label></div>
                </div>

            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="tab">
                    <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Movie Desc</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Quality</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $movies = Movie::get();
                        @endphp
                        @if (!$movies->isEmpty())
                            @foreach ($movies as $movie)
                                @php
                                    $id = Crypt::encrypt($movie->idMovie);
                                @endphp
                                <tr>
                                    <td><img class="rounded-circle me-2" width="30" height="30"
                                            src="../assets/img/posters/{{ $movie->Poster }}">{{ $movie->Name }} </td>
                                    <td>{{ $movie->Subject }}</td>
                                    <td>{{ $movie->category }}</td>
                                    <td>{{ $movie->Duration }} min</td>
                                    <td>{{ $movie->Quality }}</td>
                                    <td>{{ $movie->views }}</td>
                                    <td class="d-inline-flex" style="padding: 8px;width: 96.766px;"><a
                                            class="btn btn-warning" role="button"
                                            href={{ url('/Dash/MovieEdit/' . $id) }}
                                            style="width: 40.6875px;margin-right: 6px;"><i
                                                class="fas fa-tools"></i></a>
                                        <a class="btn btn-danger" type="button" id="{{ $movie->idMovie }}"><i
                                                class="fas fa-trash"></i></a>
                                        <script>
                                            $(function() {
                                                $("#{{ $movie->idMovie }}").on("click", (e) => {
                                                    alertify.confirm("Confirmation",
                                                        "{{ $movie->Name }} will completely deleted,you want to proceed ? ",
                                                        () => {
                                                            $.ajax({
                                                                type: "delete",
                                                                url: "/DeleteMovie/{{ $movie->idMovie }}",
                                                                data: {
                                                                    _token: "{{ csrf_token() }}"
                                                                },
                                                                success: function(res) {
                                                                    alertify.success(res);
                                                                    setTimeout(() => {
                                                                        window.location.reload();
                                                                    }, 700);

                                                                },
                                                                error: (r) => {
                                                                    alertify.error("Server Error !")
                                                                    console.log(r.responseText);
                                                                }
                                                            });
                                                        }, () => {}).set({
                                                        labels: {
                                                            ok: "Delete"
                                                        }
                                                    })
                                                })
                                            });
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif



                    </tbody>

                </table>
                <script>
                    $('#tab').DataTable({


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
