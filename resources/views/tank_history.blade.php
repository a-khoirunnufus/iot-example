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
    <div class="container my-5">
        {{-- <div class="d-flex flex-column p-3 border-right">
            <h5>Show Tank</h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 2
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 3
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 4
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 5
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 6
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 7
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 8
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 9
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 10
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 11
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tank 12
                </label>
            </div>
        </div> --}}

        <div class="pl-3">
            <h1 class="mb-3">Data Tank</h1>
            <div class="advanced-search">
                <div class="form-group mb-0">
                    <label>Tank</label>
                    <select id="filter-tank" class="form-control">
                        <option value="<ALL>">Semua</option>
                        <option value="Tank 01">Tank 1</option>
                        <option value="Tank 02">Tank 2</option>
                        <option value="Tank 03">Tank 3</option>
                        <option value="Tank 04">Tank 4</option>
                        <option value="Tank 05">Tank 5</option>
                        <option value="Tank 08">Tank 1</option>
                        <option value="Tank 09">Tank 2</option>
                        <option value="Tank 10">Tank 3</option>
                        <option value="Tank 11">Tank 4</option>
                        <option value="Tank 12">Tank 5</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label>Tanggal Mulai</label>
                    <input id="filter-date-start" type="date" class="form-control" />
                </div>
                <div class="form-group mb-0">
                    <label>Tanggal Selesai</label>
                    <input id="filter-date-end" type="date" class="form-control" />
                </div>
                <div class="d-flex align-items-end">
                    <button onclick="datatable.ajax.reload()" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
            <hr>
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        const baseUrl = "{{ url('/') }}";
        const typeParam = `{{ request()->query('type') }}`;

        let datatable = null;

        $(function() {
            datatable = $('#table-tank-history').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: baseUrl + '/api/tank-history-datatable?type=' + typeParam,
                    data: function(d) {
                        d.filters = {
                            tank: $('#filter-tank').val(),
                            date_start: $('#filter-date-start').val(),
                            date_end: $('#filter-date-end').val(),
                        };
                    },
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
