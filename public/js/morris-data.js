$(document).ready(function () {
    if ($('#morris-area-chart').length) { 
        Morris.Area({
            element: 'morris-area-chart',
            data: [
                { period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647 },
                { period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441 }
            ],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    }

    if ($('#morris-donut-chart').length) {
        Morris.Donut({
            element: 'morris-donut-chart',
            data: [
                { label: "Download Sales", value: 12 },
                { label: "In-Store Sales", value: 30 },
                { label: "Mail-Order Sales", value: 20 }
            ],
            resize: true
        });
    }

    if ($('#morris-bar-chart').length) {
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [
                { y: '2006', a: 100, b: 90 },
                { y: '2007', a: 75, b: 65 }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            hideHover: 'auto',
            resize: true
        });
    }
});
