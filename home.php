<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .card-row {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
            width: 300px;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header i {
            font-size: 24px;
            margin-right: 10px;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .count {
            font-size: 36px;
            font-weight: 600;
            color: #333;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .card-header::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-color: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg);
            transition: all 0.5s ease;
            opacity: 0;
        }

        .card:hover .card-header::after {
            opacity: 1;
            top: 150%;
            left: -30%;
        }

        .chart-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="card-row">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i>
                    <h3>Member</h3>
                </div>
                <div class="card-body">
                    <span class="count"></span>
                    <a href="?page=pelanggan" class="btn">More Info</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-shopping-basket"></i>
                    <h3>Transaksi</h3>
                </div>
                <div class="card-body">
                    <span class="count"></span>
                    <a href="?page=laundry" class="btn">More Info</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Layanan</h3>
                </div>
                <div class="card-body">
                    <span class="count"></span>
                    <a href="?page=pengeluaran" class="btn">More Info</a>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <h2>Transaksi Laundry</h2>
            <canvas id="transactionChart"></canvas>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fungsi untuk mengambil data dari server
        function fetchTransactionData() {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'get-transaction-data.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        resolve(JSON.parse(xhr.responseText));
                    } else {
                        reject(xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    reject(xhr.statusText);
                };
                xhr.send();
            });
        }

        // Membuat grafik dengan Chart.js
        async function createChart() {
            try {
                const transactionData = await fetchTransactionData();
                const ctx = document.getElementById('transactionChart').getContext('2d');
                const transactionChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: transactionData.map(data => data.tanggal),
                        datasets: [{
                            label: 'Total Transaksi',
                            data: transactionData.map(data => data.total),
                            backgroundColor: 'rgba(0, 123, 255, 0.5)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                            pointBorderColor: '#fff',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error(error);
            }
        }

        // Panggil fungsi untuk membuat grafik saat halaman dimuat
        createChart();
    </script>
</body>
</html>