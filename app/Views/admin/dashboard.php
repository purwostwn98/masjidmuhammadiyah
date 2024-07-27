<?= $this->extend("/template/admin_template.php"); ?>
<?= $this->section("konten"); ?>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Total Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Total Masjid</h5>

                            <div class="d-flex align-items-center">
                                
                                <div class="ps-3">
                                    <h6><?=$ttl?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Total Card -->

                <!-- PMW Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Masjid PWM</h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h6><?=$pwm?></h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End PMW Card -->

                <!-- AUM Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Masjid AUM</h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h6><?=$aum?></h6>

                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End AUM Card -->

                <!-- PDM Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Masjid PDM</h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h6><?=$pdm?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End PDM Card -->

                <!-- PCM Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Masjid PCM</h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h6><?=$pcm?></h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End PCM Card -->

                <!-- PRM Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Masjid PRM</h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <h6><?=$prm?></h6>

                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End PRM Card -->


                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Jumalah Masjid di masing-masing PWM</h5>

                            <!-- Line Chart -->
                         <canvas id="barChart" style="max-height: 400px;"></canvas>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#barChart'), {
                                    type: 'bar',
                                    data: {
                                    labels: <?php echo $npwm;?>,
                                    datasets: [{
                                        label: 'Masjid',
                                        data: <?php echo $dpwm; ?>,
                                        backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
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
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>

                    </div>
                </div><!-- End Reports -->


            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

            <!-- Kreteria Masjid -->
            <div class="card">


                <div class="card-body pb-0">
                    <h5 class="card-title">Kreteria Masjid</h5>

                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center'
                                },
                                series: [{
                                    name: 'Kategori',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center'
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                    labelLine: {
                                        show: false
                                    },
                                    data: [{
                                            value: 1048,
                                            name: 'Abu-Abu'
                                        },
                                        {
                                            value: 735,
                                            name: 'Hijau'
                                        },
                                        {
                                            value: 580,
                                            name: 'Kuning'
                                        },
                                        {
                                            value: 484,
                                            name: 'Merah'
                                        }
                                    ]
                                }]
                            });
                        });
                    </script>

                </div>
            </div><!-- End Kreteria Masjid -->

            <!-- Jamaah Masjid -->
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Rata-rata Jama'ah Masjid</h5>

                    <div id="jamaah" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#jamaah"), {
                            series: <?=$mj?>,
                            chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                                show: true
                            }
                            },
                            labels: <?=$kmj?>
                        }).render();
                        });
                    </script>

                </div>
            </div><!-- End Jamaah Masjid -->

        </div><!-- End Right side columns -->

    </div>
</section>

<?= $this->endSection(); ?>