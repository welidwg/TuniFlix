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
    <title>{{ env('APP_NAME') }} - Dashboard</title>

</head>

<body>
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Movies in Total</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>{{ Movie::get()->count() }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-film fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Series In Total</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>(Coming Soon)</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-camera-retro fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Most watched Movie</span>
                            </div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3">
                                        <span>{{ Movie::orderBy('views', 'desc')->first()->Name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-tape fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-warning py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Most Watched
                                    Serie</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>(Coming Soon)</span></div>
                        </div>
                        <div class="col-auto"><i class="far fa-eye fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold m-0" style="color: rgb(221,21,44);">TOP 3 WATCHED MOVIES</h6>
                </div>
                <div class="card-body">
                    @php
                        
                    @endphp

                    <canvas class="chart-area" id="top3Movie"> </canvas>
                    <script>
                        const ctx = document.getElementById('top3Movie');
                        let arr = [''];
                        let data1 = [0];
                        $.ajax({
                            type: "get",
                            url: "{{ url('/TOP3/Movies') }}",
                            success: function(res) {
                                res.forEach(e => {
                                    arr.push(e.Name)
                                    data1.push(e.views)



                                });
                                console.log(arr);

                                const myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: arr,
                                        datasets: [{
                                            label: 'Total Views',
                                            data: data1,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            },
                            error: (r) => {
                                console.log(r.responseText);

                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold m-0" style="color: rgb(221,22,45);">TOP 3 WATCHED SERIES (Coming Soon)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas
                            data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas>
                    </div>
                    <div class="text-center small mt-4"><span class="me-2"><i
                                class="fas fa-circle text-primary"></i>&nbsp;Direct</span><span
                            class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;Social</span><span
                            class="me-2"><i class="fas fa-circle text-info"></i>&nbsp;Refferal</span></div>
                </div>
            </div>
        </div>
    </div>

</body>
</div>
</div>

@include('Dash/footer')

</html>
