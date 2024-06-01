@props(['alternativeSPK' => []])

<div class="col-12">
    <h5>Data Alternatif</h5>
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
            @foreach($alternativeSPK as $key => $value)
                <tr>
                    <td>{{ $value["kk"]["no_kk"] }}</td>
                    <td>{{ $value["kk"]["citizens"][0]["nama_lengkap"] }}</td>
                    <td>{{ $value["jumlah_penghasilan"] }}</td>
                    <td>{{ $value["jumlah_pengeluaran"] }}</td>
                    <td>{{ $value["jumlah_tanggungan"] }}</td>
                    <td>{{ $value["jumlah_hutang"] }}</td>
                    <td>{{ $value["kondisi_tempat_tinggal"] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
