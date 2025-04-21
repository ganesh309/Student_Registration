<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: url('/images/background1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .chart-card {
            background-color: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            min-height: 300px;
            position: relative;
            border-radius: 10px;
        }

        @supports (backdrop-filter: blur(10px)) {
            .chart-card {
                backdrop-filter: blur(10px);
            }
        }

        .chart-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            height: 250px;
            position: relative;
        }

        #backBtn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .chart-title {
            color: #212529;
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    @include('layouts.navbar')

    <!-- Header -->
    <main class="container text-center mt-4">
        <h1 class="headder display-5 fw-bold text-light">Student Management System</h1>
    </main>

    <!-- Charts Section at Bottom -->
    <div class="container mt-auto mb-5 pt-4">
        <div class="row justify-content-center">
            <!-- Gender Chart -->
            <div class="col-md-4 mb-5">
                <div class="chart-card p-3 rounded-3 shadow">
                    <h5 class="text-center mb-3 chart-title">Male vs Female Students</h5>
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Nationality Chart with Drill-down -->
            <div class="col-md-8 mb-5">
                <div class="chart-card p-3 rounded-3 shadow">
                    <h5 class="text-center mb-3 chart-title">Indian vs Non-Indian Students</h5>
                    <button id="backBtn" class="btn btn-sm btn-outline-secondary" onclick="resetToCountryChart()" style="display: none;">
                        ← Back to Country View
                    </button>
                    <div class="chart-container">
                        <canvas id="nationalityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Chart.js Script -->
    <script>
        const stateWiseData = {
            "West Bengal": {{ $westbengalCount }},
            "Bihar": {{ $biharCount }},
            "Karnataka": {{ $karnatakaCount }},
            "Maharashtra": {{ $maharashtraCount }},
            "Tamil Nadu": {{ $tamilnaduCount }}
        };

        const ctx = document.getElementById('nationalityChart').getContext('2d');

        // Initial Country Data
        const initialLabels = ['Indian Students', 'Non-Indian Students'];
        const initialData = [{{ $indianCount }}, {{ $nonIndianCount }}];

        const nationalityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: initialLabels,
                datasets: [{
                    label: 'Number of Students',
                    data: initialData,
                    backgroundColor: ['#4e73df', '#1cc88a'],
                    borderRadius: 5,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onClick: (e, elements) => {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const label = nationalityChart.data.labels[index];

                        if (label === 'Indian Students') {
                            nationalityChart.data.labels = Object.keys(stateWiseData);
                            nationalityChart.data.datasets[0].data = Object.values(stateWiseData);
                            nationalityChart.data.datasets[0].label = 'Indian Students by State';
                            nationalityChart.update();
                            document.getElementById('backBtn').style.display = 'inline-block';
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#212529'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#212529'
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        function resetToCountryChart() {
            nationalityChart.data.labels = initialLabels;
            nationalityChart.data.datasets[0].data = initialData;
            nationalityChart.data.datasets[0].label = 'Number of Students';
            nationalityChart.update();
            document.getElementById('backBtn').style.display = 'none';
        }

        // Gender Pie Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Students',
                    data: [{{ $maleCount }}, {{ $femaleCount }}],
                    backgroundColor: ['#36b9cc', '#f6c23e'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#212529'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
