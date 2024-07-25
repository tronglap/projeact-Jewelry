(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

var orderData = orderStatusData;

var labels = orderData
    .map(function (item) {
        return item[0];
    })
    .slice(1);
var data = orderData
    .map(function (item) {
        return item[1];
    })
    .slice(1);

var backgroundColors = [
    "#ef476f",
    "#f78c6b",
    "#ffd166",
    "#06d6a0",
    "#118ab2",
    "#073b4c",
];
var hoverBackgroundColors = [
    "#ff595e",
    "#ff924c",
    "#ffca3a",
    "#2a9d8f",
    "#1982c4",
    "#00132d",
];

var legendContainer = document.getElementById("order-status-legend");
labels.forEach(function (label, index) {
    var span = document.createElement("span");
    span.className = "mr-2";
    span.innerHTML = `<i class="fas fa-circle" style="color: ${backgroundColors[index]};"></i> ${label}`;
    legendContainer.appendChild(span);
});

var ctx = document.getElementById("orderStatusChart").getContext("2d");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: labels,
        datasets: [
            {
                data: data,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: hoverBackgroundColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false,
        },
        cutoutPercentage: 80,
    },
});
