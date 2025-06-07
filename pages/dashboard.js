let predict_bordercolor ='rgb(255, 209, 60)';
let history_bordercolor ='rgb(32, 77, 173)';
let bgcolor = 'rgba(223, 197, 50, 0.1)';
const stockLevels = window.inventoryData.stockLevels;

document.addEventListener('DOMContentLoaded', function () {
    const demandCtx = document.getElementById('demandChart').getContext('2d');
    new Chart(demandCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                {
                    label: 'Predicted Demand',
                    data: [120, 150, 170, 190, 230, 280, 260],
                    borderColor: predict_bordercolor,
                    backgroundColor: bgcolor,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Historical Average',
                    data: [100, 120, 140, 160, 180, 200, 190],
                    borderColor: history_bordercolor,
                    borderDash: [5, 5],
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
    const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
    new Chart(inventoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['In Stock', 'Low Stock', 'Out of Stock'],
            datasets: [{
                data: stockLevels,
                backgroundColor: ['#22c55e', '#f97316', '#ef4444'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
