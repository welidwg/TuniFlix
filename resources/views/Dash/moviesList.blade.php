@include('Dash/mainNav')
<!DOCTYPE html>
<html lang="en">
@php
use App\Models\Movie;

@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Movies List</title>

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
                <div class="col"><input type="search" class="form-control form-control-sm"
                        aria-controls="dataTable" placeholder="Search"></div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
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
                                <tr>
                                    <td><img class="rounded-circle me-2" width="30" height="30"
                                            src="../assets/img/posters/{{ $movie->Poster }}">{{ $movie->Name }}</td>
                                    <td>{{ $movie->Subject }}</td>
                                    <td>{{ $movie->category }}</td>
                                    <td>{{ $movie->Duration }} min</td>
                                    <td>{{ $movie->Quality }}</td>
                                    <td>{{ $movie->views }}</td>
                                    <td class="d-inline-flex" style="padding: 8px;width: 96.766px;"><a
                                            class="btn btn-warning" role="button"
                                            style="width: 40.6875px;margin-right: 6px;"><i
                                                class="fas fa-tools"></i></a><button class="btn btn-danger"
                                            type="button"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        @else
                        @endif



                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Movie Name</th>
                            <th>Movie Desc</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Quality</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#"
                                    aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active" style="background: var(--bs-red);"><a class="page-link"
                                    href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                        aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</body>
</div>
</div>

@include('Dash/footer')

</html>
