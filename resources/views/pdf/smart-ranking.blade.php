<!DOCTYPE html>
<html>
<head>
    <title>SMART Ranking PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>SMART Ranking</h1>
    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>No. KK</th>
                <th>Kepala Keluarga</th>
                <th>Nilai SMART</th>
            </tr>
        </thead>
        <tbody>
            @foreach($smartRanks as $rank)
            <tr>
                <td>{{ $rank->id_smart_rank }}</td>
                <td>{{ $rank->kondisiKeluarga->kk->no_kk }}</td>
                <td>{{ $rank->kondisiKeluarga->kk->citizens->where('id_hubungan', 1)->first()->nama_lengkap }}</td>
                <td>{{ round($rank->nilai_smart, 3) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
