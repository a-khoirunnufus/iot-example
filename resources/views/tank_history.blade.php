<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOT Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
</head>
<body>

    <div class="container my-5">
        <h1 class="mb-3">Data Tank</h1>
        <table id="table-tank-history">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Tank</th>
                    <th>Level(m)</th>
                    <th>Temprature(Deg C)</th>
                    <th>Volume(L)</th>
                    <th>Mass(Kg)</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        const baseUrl = "{{ url('/') }}";

        $(function() {
            $('#table-tank-history').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: baseUrl + '/api/tank-history-datatable'
                },
                order: [],
                columns: [
                    {data: 'date'},
                    {data: 'time'},
                    {data: 'tank'},
                    {data: 'level'},
                    {data: 'temprature'},
                    {data: 'volume'},
                    {data: 'mass'},
                ],
            });
        })
    </script>
</body>
</html>
