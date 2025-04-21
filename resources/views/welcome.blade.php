<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <!-- Chart.js for rendering charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-card {
            transition: all 0.3s ease;
            min-height: 300px;
        }
        .chart-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            height: 250px; /* Fixed height for consistency */
        }
    </style>
</head>
<body class="bg-light">
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-8 col-lg-6">
                <div class="main-card bg-white p-5 rounded-4 shadow-lg">
                    <h1 class="headder text-center mb-4 display-5 fw-bold text-primary">
                        Student Management System
                    </h1>

                    <!-- Charts Section -->
                    <div class="row mt-5">
                        <!-- Indian vs Non-Indian Students -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-card bg-white p-3 rounded-3 shadow">
                                <h5 class="text-center mb-3">Indian vs Non-Indian Students</h5>
                                <div class="chart-container">
                                    <canvas id="nationalityChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Male vs Female Students -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-card bg-white p-3 rounded-3 shadow">
                                <h5 class="text-center mb-3">Male vs Female Students</h5>
                                <div class="chart-container">
                                    <canvas id="genderChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Chart Implementation -->
    <script>
        const nationalityCtx = document.getElementById('nationalityChart').getContext('2d');
        new Chart(nationalityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Indian Students', 'Non-Indian Students'],
                datasets: [{
                    label: 'Students',
                    data: [{{ $indianCount }}, {{ $nonIndianCount }}],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Gender Chart (Pie)
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Students',
                    data: [{{ $maleCount }}, {{ $femaleCount }}],
                    backgroundColor: [
                        '#36b9cc', // Cyan for Male
                        '#f6c23e'  // Yellow for Female
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>