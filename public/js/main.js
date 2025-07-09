
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [
                {
                    label: 'Won Revenue',
                    data: [276000],
                    backgroundColor: '#28c76f',
                    barThickness: 30,
                },
                {
                    label: 'Lost Revenue',
                    data: [70000],
                    backgroundColor: '#ff3e3e',
                    barThickness: 30,
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value / 1000 + 'k';
                        }
                    }
                },
                y: {
                    display: false
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });



    