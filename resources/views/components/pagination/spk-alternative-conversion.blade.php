@props(['alternativeSPKConvert' => [], 'minMax' => []])

<div class="col-12">
    <h5>Pembobotan Data Alternatif</h5>
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
            @foreach($alternativeSPKConvert as $key => $value)
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
<div class="col-12">
    <h5>Min/Max Kriteria</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Penghasilan</th>
                <th>Pengeluaran</th>
                <th>Jumlah Tanggungan</th>
                <th>Hutang</th>
                <th>Kondisi Rumah</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($minMax as $key => $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</div>
