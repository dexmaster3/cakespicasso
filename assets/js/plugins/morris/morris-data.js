// Morris.js Charts data for SB Admin template
var usageDonutChart;
function createCharts(data) {
    // Donut Chart
    usageDonutChart = Morris.Donut({
        element: 'morris-donut-chart',
        data: [
            {
                label: "Content Pages",
                value: data.pages,
                color: "#499475",
                redirect: "/pages/page"
            },
            {
                label: "Forms",
                value: data.forms,
                color: "#4E9E66",
                redirect: "/forms/form"
            },
            {
                label: "Layouts",
                value: data.layouts,
                color: "#49874A",
                redirect: "/layouts/layout"
            },
            {
                label: "Renderings",
                value: data.renderings,
                color: "#689E4E",
                redirect: "/renderings/rendering"
            },
            {
                label: "Form Entries",
                value: data.formdata,
                color: "#7B9449",
                redirect: "/display/formdata"
            }
        ],
        resize: true
    }).on('click', function(i, row){
        window.location.href = row.redirect;
    });
}

function goToFocusedDonutItem() {
    $.each(usageDonutChart.segments, function(key, value) {
        if (value.selected) {
            window.location.href = usageDonutChart.data[key].redirect;
        }
    });
}