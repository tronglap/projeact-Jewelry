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
    "#4e73df",
    "#1cc88a",
    "#36b9cc",
    "#f6c23e",
    "#e74a3b",
    "#858796",
];
var hoverBackgroundColors = [
    "#2e59d9",
    "#17a673",
    "#2c9faf",
    "#f4b619",
    "#e02d1b",
    "#6e707e",
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
