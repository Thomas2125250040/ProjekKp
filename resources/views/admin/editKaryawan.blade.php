@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Ubah Data Karyawan</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('karyawan.update', $karyawan->id_karyawan) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="kode_karyawan" class="form-label">Kode Karyawan</label>
                                <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan" required
                                    value="{{ $karyawan->kode_karyawan }}">
                                @error('kode_karyawan')
                                    <label for="kode" class="text-danger">Kode karyawan sudah terdaftar. Silahkan ganti yang
                                        lain!</label>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required
                                    value="{{ $karyawan->nama_karyawan }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input type="radio" id="laki-laki" name="jenis_kelamin" class="form-check-input"
                                        value="Laki-laki" @if (old('jenis_kelamin', 'Laki-laki') == 'Laki-laki') checked @endif>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="perempuan" name="jenis_kelamin" class="form-check-input"
                                        value="Perempuan" @if (old('jenis_kelamin', 'Perempuan') == 'Perempuan') checked @endif>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class= "form-label" for="agama">Agama</label>
                                <select class="form-select" name="agama">
                                    <option value="Islam" @if (old('agama') == 'Islam') selected @endif>Islam</option>
                                    <option value="Katolik" @if (old('agama') == 'Katolik') selected @endif>Katolik
                                    </option>
                                    <option value="Kristen" @if (old('agama') == 'Kristen') selected @endif>Kristen
                                    </option>
                                    <option value="Hindu" @if (old('agama') == 'Hindu') selected @endif>Hindu</option>
                                    <option value="Buddha" @if (old('agama') == 'Buddha') selected @endif>Buddha</option>
                                    <option value="Konghucu" @if (old('agama') == 'Konghucu') selected @endif>Konghucu
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{ $karyawan->email }}">
                                @error('email')
                                    <label for="kode" class="text-danger">Email sudah terdaftar. Silahkan ganti yang lain
                                        !</label>
                                @enderror
                            </div>

                            <div class="mb-4" id="fieldset">
                                <label for="kode_jabatan" class="form-label">Jabatan</label>
                                <select id="kode_jabatan" name="kode_jabatan" class="form-select">
                                    @forelse ($jabatanOptions as $kodeJabatan => $namaJabatan)
                                        <option value="{{ $kodeJabatan }}"
                                            @if (old('kode_jabatan', $karyawan->kode_jabatan) == $kodeJabatan) selected @endif>
                                            {{ $namaJabatan }}
                                        </option>
                                    @empty
                                        <option>-- Belum ada data jabatan --</option>
                                        <script>
                                            let fieldset = document.getElementById('fieldset');
                                            fieldset.classList.add('disabled');
                                        </script>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    value="{{ $karyawan->password }}">
                            </div>

                            <div class="mb-4">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required
                                    value="{{ $karyawan->tempat_lahir }}">
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required
                                    value="{{ $karyawan->tanggal_lahir }}">
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required
                                    value="{{ $karyawan->alamat }}">
                            </div>

                            <div class="mb-4">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                    required value="{{ $karyawan->nomor_telepon }}">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
