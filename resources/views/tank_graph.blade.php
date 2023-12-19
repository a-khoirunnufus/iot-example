<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOT Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <style>
        body {
            width: 100vw;
        }
        .template {
            display: grid;
            grid-template-columns: 20vw 70vw;
        }
        .advanced-search {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 1rem;
        }
    </style>
</head>
<body>
    <div>
        <canvas id="tankChart" style="width: 100vw; height: 50vh"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const baseUrl = `{{ url('/') }}`;

        const typeParam = `{{ request()->query('type') }}`;
        const tankParam = `{{ request()->query('tank') }}`;
        const variableParam = `{{ request()->query('variable') }}`;
        let dateParam = `{{ request()->query('date') }}`;

        const todayDate = new Date();
        const todayDateString = `${todayDate.getFullYear}-${todayDate.getMonth()+1}-${todayDate.getDate()}`;
        if (!dateParam) {
            dateParam = todayDateString;
        }

        const canvasTankChartElm = document.getElementById('tankChart');

        let chart = null;
        let updateChart = null;
    </script>

    @if(request()->get('type') == 'per-day')
        <script src="{{ url('/') }}/js/tank-graph/per-day.js"></script>
    @endif

    @if(request()->get('type') == 'per-hour')
        <script src="{{ url('/') }}/js/tank-graph/per-hour.js"></script>
    @endif

    @if(request()->get('type') == 'realtime')
        <script src="{{ url('/') }}/js/tank-graph/realtime.js"></script>
    @endif
</body>
</html>
