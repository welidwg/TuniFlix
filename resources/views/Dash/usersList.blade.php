@include('Dash/mainNav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Movies List</title>

</head>

<body>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="m-0 fw-bold" style="color: rgb(221,21,44);">Users List</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                            class="form-label"></label></div>
                </div>

            </div>
            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php
                            use App\Models\User;
                            $users = User::where('idUser', '!=', Session::get('id'))->get();
                        @endphp
                        @forelse ($users as $user)
                            @php
                                $avatar = 'avatar.png';
                                if ($user->avatar == '') {
                                    $avatar = 'avatar.png';
                                } else {
                                    $avatar = $user->avatar;
                                }
                            @endphp
                            <tr>
                                <td style="font-weight: 700">#{{ $user->idUser }}</td>
                                <td><img class="rounded-circle me-2" width="30" height="30"
                                        src="../assets/img/avatars/{{ $avatar }}">{{ $user->username }}
                                </td>
                                <td>{{ $user->email }}</td>

                                <td class="d-inline-flex" style="padding: 8px;width: 96.766px;">
                                    <a id="{{ $user->idUser }}"
                                        class="btn btn-danger bg-transparent border-0 text-danger" type="button"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                                <script>
                                    $("#{{ $user->idUser }}").on("click", function() {
                                        alertify.confirm("Confirmation",
                                            "{{ $user->username }} will completely deleted,you want to proceed ? ",
                                            () => {
                                                $.ajax({
                                                    type: "delete",
                                                    url: "/DeleteUser/{{ $user->idUser }}",
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
                                    });
                                </script>
                            </tr>
                        @empty
                            <td>No users yet</td>
                        @endforelse



                    </tbody>

                </table>
                <script>
                    $(document).ready(function() {
                        $('#tab').DataTable({


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
