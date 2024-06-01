@props(['normalized' => []])

<div class="col-12">
    <h5>Normalisasi</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>No KK</th>
                <th>Kepala Keluarga</th>
                <th>Penghasilan</th>
                <th>Pengeluaran</th>
                <th>Jumlah Tanggungan</th>
                <th>Hutang</th>
                <th>Kondisi Rumah</th>
            </tr>
            </thead>
            <tbody>
            @foreach($normalized as $key => $value)
                <tr>
                    <td>{{ $value["no_kk"] }}</td>
                    <td>{{ $value["nama_lengkap"] }}</td>
                    <td>{{ $value[0] }}</td>
                    <td>{{ $value[1] }}</td>
                    <td>{{ $value[2] }}</td>
                    <td>{{ $value[3] }}</td>
                    <td>{{ $value[4] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
