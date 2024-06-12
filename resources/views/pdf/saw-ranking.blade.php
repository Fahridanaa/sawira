<!DOCTYPE html>
<html>
<head>
    <title>SAW Ranking PDF</title>
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
    <h1>SAW Ranking</h1>
    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>No. KK</th>
                <th>Kepala Keluarga</th>
                <th>Nilai SAW</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sawRanks as $rank)
            <tr>
                <td>{{ $rank->id_saw_rank }}</td>
                <td>{{ $rank->kondisiKeluarga->kk->no_kk }}</td>
                <td>{{ $rank->kondisiKeluarga->kk->citizens->where('id_hubungan', 1)->first()->nama_lengkap }}</td>
                <td>{{ round($rank->nilai_saw, 3) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
