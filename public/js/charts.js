
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    const ctx = document.getElementById('ordersPieChart').getContext('2d');

    const ordersPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
            datasets: [{
                label: 'Order Status',
                data: [{{ $pending }}, {{ $processing }}, {{ $completed }}, {{ $cancelled }}],
                backgroundColor: [
                    '#fbbf24',  // yellow
                    '#3b82f6',  // blue
                    '#10b981',  // green
                    '#ef4444'   // red
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Order Status Breakdown'
                }
            }
        }
    });

