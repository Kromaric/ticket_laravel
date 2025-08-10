// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Formatage des nombres
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = thousands_sep || ' ',
        dec = dec_point || ',',
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

// Initialisation du graphique
const canv = document.getElementById("myBarChart");
canv.width = canv.width; // reset visuel

const ctxz = canv.getContext("2d");
const ticketsCrees = JSON.parse(canv.dataset.crees);
const ticketsResolus = JSON.parse(canv.dataset.resolus);

// Destruction du chart précédent s'il existe
if (window.myBarChart instanceof Chart) {
    window.myBarChart.destroy();
}

// Création du chart
window.myBarChart = new Chart(ctxz, {
    type: "bar",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: "Tickets créés",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: ticketsCrees,
                maxBarThickness: 30
            },
            {
                label: "Tickets résolus",
                backgroundColor: "#1cc88a",
                hoverBackgroundColor: "#17a673",
                borderColor: "#1cc88a",
                data: ticketsResolus,
                maxBarThickness: 30
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: { left: 10, right: 25, top: 25, bottom: 0 }
        },
        scales: {
            xAxes: [{
                gridLines: { display: false, drawBorder: false },
                ticks: {
                    maxTicksLimit: 12,
                    autoSkip: false
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    padding: 10,
                    callback: function(value) {
                        return number_format(value, 0, ',', ' ') + ' tickets';
                    }
                },
                gridLines: {
                    drawBorder: false,
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }]
        },
        legend: {
            display: true
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel, 0, ',', ' ') + ' tickets';
                }
            }
        }
    }
});
