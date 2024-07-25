(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
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

var ctx = document.getElementById("topProductByQuantityChart").getContext("2d");
var topProductLabels = topProductsByQuantity.map(function (item) {
    return item.name;
});
var topProductValues = topProductsByQuantity.map(function (item) {
    return item.quantity;
});
// var barColors = [
//     "#fbf8cc",
//     "#fde4cf",
//     "#ffcfd2",
//     "#f1c0e8",
//     "#cfbaf0",
//     "#a3c4f3",
//     "#90dbf4",
//     "#8eecf5",
//     "#98f5e1",
//     "#b9fbc0",
// ];
var barColors = [
    "#ff0000",
    "#ff8700",
    "#ffd300",
    "#deff0a",
    "#a1ff0a",
    "#0aff99",
    "#0aefff",
    "#147df5",
    "#580aff",
    "#be0aff",
];

var barHover = [
    "#ffcfd2",
    "#fde4cf",
    "#fbf8cc",
    "#fdffb6",
    "#b9fbc0",
    "#98f5e1",
    "#90dbf4",
    "#a3c4f3",
    "#cfbaf0",
    "#f1c0e8",
];

var myBarChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: topProductLabels,
        datasets: [
            {
                label: "Quantity",
                backgroundColor: barColors,
                hoverBackgroundColor: barHover,
                borderColor: barColors,
                data: topProductValues,
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
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        maxTicksLimit: 10,
                    },
                    maxBarThickness: 25,
                },
            ],
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        max: Math.max(...topProductValues),
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function (value) {
                            return number_format(value);
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
            display: false,
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
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function (tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return (
                        datasetLabel + ": " + number_format(tooltipItem.yLabel)
                    );
                },
            },
        },
    },
});
