@props(['sawRank' => []])

<div class="col-12">
    <h5>Normalisasi</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Rank</th>
                <th>No KK</th>
                <th>Kepala Keluarga</th>
                <th>Hasil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sawRank as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value["no_kk"] }}</td>
                    <td>{{ $value["nama_lengkap"] }}</td>
                    <td>{{ $value["sum"] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
