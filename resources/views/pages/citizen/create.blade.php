@extends('layouts.app')
@section('content')
    .
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Menambah Penduduk</h1>
            <div class="btn-group p-1">
                <a href="{{ route('penduduk.index') }}">
                    <button class="btn btn-danger mr-2">
                        Batal
                    </button>
                </a>
                <button class="btn btn-primary ml-2">Simpan</button>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pilih Data No. KK</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kk">No. KK</label>
                                            <select class="form-control"
                                                    name="kk"
                                                    id="kk"
                                                    required>
                                                    <option disabled hidden selected>Pilih No. KK</option>
                                                    @if(isset($no_kk) && $no_kk->isNotEmpty())
                                                        @foreach ($no_kk as $item)
                                                            <option value="{{ $item->no_kk }}">{{ $item->no_kk }}</option>
                                                        @endforeach
                                                    @else
                                                        <option disabled>Tidak ada data KK</option>
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Kepala Keluarga</label>
                                            <input type="text"
                                                   class="form-control"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-citizens.family-member-form
                            id="familyMember"
                            status="familyMember"
                            iteration=0
                    />
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    document.getElementById('kk').addEventListener('change', function() {
        console.log('No. KK selected:', this.value);
    });
</script>