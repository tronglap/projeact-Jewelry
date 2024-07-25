(Chart.defaults.global.defaultFontFamily =
    "Nunito, -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif"),
    (Chart.defaults.global.defaultFontColor = "#858796");

var paymentData = popularPaymentMethods;

var labels = paymentData.map(function (item) {
    return item.payment_method;
});
var data = paymentData.map(function (item) {
    return item.total;
});

var backgroundColors = [
    "#01befe",
    "#adff02",
    "#ff006d",
    "#ffdd00",
    "#ff7d00",
    "#8f00ff",
];
var hoverBackgroundColors = [
    "#118ab2",
    "#b0db43",
    "#ef476f",
    "#ffd166",
    "#f78c6b",
    "#341671",
];

var legendContainer = document.getElementById("payment-methods");
labels.forEach(function (label, index) {
    var span = document.createElement("span");
    span.className = "mr-2";
    span.innerHTML = `<i class="fas fa-circle" style="color: ${backgroundColors[index]};"></i> ${label}`;
    legendContainer.appendChild(span);
});

var ctx = document.getElementById("paymentMethods").getContext("2d");
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
