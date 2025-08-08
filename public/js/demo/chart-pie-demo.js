// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
const labels = JSON.parse(ctx.dataset.labels);
const values = JSON.parse(ctx.dataset.values);

var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: values,
            backgroundColor: ['#36b9cc', '#f6c23e', '#1cc88a'], // En cours, En attente, Résolus
            hoverBackgroundColor: ['#2c9faf', '#dda20a', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, data) {
                    let label = data.labels[tooltipItem.index] || '';
                    let value = data.datasets[0].data[tooltipItem.index] || 0;
                    return label + ': ' + value.toLocaleString('fr-FR') + ' €';
                }
            }
        },
        legend: {
            display: true,
            position: 'bottom'
        },
        cutoutPercentage: 60,
    },
});
