// Contoh data transaksi
const transactionData = [
    { month: 'Jan', total: 10000 },
    { month: 'Feb', total: 15000 },
    { month: 'Mar', total: 12000 },
    { month: 'Apr', total: 18000 },
    { month: 'May', total: 20000 },
    { month: 'Jun', total: 17000 },
    { month: 'Jul', total: 22000 },
    { month: 'Aug', total: 25000 },
    { month: 'Sep', total: 18000 },
    { month: 'Oct', total: 20000 },
    { month: 'Nov', total: 23000 },
    { month: 'Dec', total: 28000 },
];

// Membuat grafik dengan Chart.js
const ctx = document.getElementById('transactionChart').getContext('2d');
const transactionChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: transactionData.map(data => data.month),
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

// Animasi pada elemen
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.05)';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
    });
});