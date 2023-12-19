(async function() {
    const tankHistoryMaster = await $.ajax({url: `${baseUrl}/api/tank-history?filters[tank]=${tankParam}&filters[date]=${dateParam}`, async: true});

    let tankData = [];

    if (variableParam == 'level') {
        tankData = tankHistoryMaster.map(item => item.level);
    }

    if (variableParam == 'temprature') {
        tankData = tankHistoryMaster.map(item => item.temprature);
    }

    if (variableParam == 'volume') {
        tankData = tankHistoryMaster.map(item => item.volume);
    }

    if (variableParam == 'mass') {
        tankData = tankHistoryMaster.map(item => item.mass);
    }

    const timeLabels = tankHistoryMaster.map(item => item.time);

    // console.log(tankData, timeLabels);

    const data = {
        labels: timeLabels,
        datasets: [
            {
                label: tankParam,
                data: tankData,
                yAxisID: 'y',
            },
        ]
    };

    let maxScale = tankData.reduce(function(prev, curr) {
        return curr > prev ? curr : prev;
    });
    maxScale = Math.floor(maxScale + maxScale*0.1);

    let minScale = tankData.reduce(function(prev, curr) {
        return curr < prev ? curr : prev;
    });
    minScale = Math.floor(minScale - minScale*0.1);

    // console.log(minScale, maxScale);

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: variableParam,
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    min: minScale,
                    max: maxScale,
                },
            }
        },
    };

    chart = new Chart(canvasTankChartElm, config);
})()