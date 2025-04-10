// Set default font and color - SB Admin 2 style
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "." : thousands_sep,
        dec = typeof dec_point === "undefined" ? "," : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}

// Ambil elemen canvas
var ctx = document.getElementById("myBarChart");

// Buat chart
var myBarChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: typeof chartLabels !== "undefined" ? chartLabels : [],
        datasets: [
            {
                label: "SPP",
                backgroundColor: "#1cc88a",
                hoverBackgroundColor: "#17a673",
                borderColor: "#1cc88a",
                data: typeof dataSPP !== "undefined" ? dataSPP : [],
            },
            {
                label: "NON-SPP",
                backgroundColor: "#36b9cc",
                hoverBackgroundColor: "#2c9faf",
                borderColor: "#36b9cc",
                data: typeof dataNonSPP !== "undefined" ? dataNonSPP : [],
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0,
            },
        },
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "month",
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        maxTicksLimit: 12,
                    },
                    maxBarThickness: 25,
                },
            ],
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        maxTicksLimit: 6,
                        padding: 10,
                        callback: function (value) {
                            return "Rp" + number_format(value, 0, ",", ".");
                        },
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2],
                    },
                },
            ],
        },
        legend: {
            display: true,
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
            callbacks: {
                label: function (tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return (
                        datasetLabel +
                        ": Rp" +
                        number_format(tooltipItem.yLabel, 0, ",", ".")
                    );
                },
            },
        },
    },
});
