<!DOCTYPE html>
<html>

<head>
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: blue;
        }

        p {
            color: green;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Penerimaan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>RT/RW</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testing as $test)
                <tr>
                    <td>{{ $test->id_testing }}</td>
                    <td>{{ $test->penduduk->rt_rw }}</td>
                    <td>{{ $test->penduduk->nik }}</td>
                    <td>{{ $test->penduduk->nama }}</td>
                    <td>{{ $test->keputusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
