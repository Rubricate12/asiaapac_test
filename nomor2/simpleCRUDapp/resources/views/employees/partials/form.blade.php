@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <h4 class="alert-heading">Terjadi Kesalahan!</h4>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label for="nomor" class="form-label">Nomor Induk</label>
        <input type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor', $employee->nomor ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $employee->nama ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label for="jabatan" class="form-label">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $employee->jabatan ?? '') }}">
    </div>
    <div class="col-md-6">
        <label for="talahir" class="form-label">Tanggal Lahir</label>
        <input type="date" name="talahir" id="talahir" class="form-control" value="{{ old('talahir', isset($employee->talahir) ? $employee->talahir->format('Y-m-d') : '') }}">
    </div>
    <div class="col-12">
        <label for="photo" class="form-label">Foto Profil</label>
        <input class="form-control" type="file" name="photo" id="photo">
        @if(isset($employee) && !empty($employee->photo_upload_path))
            <div class="mt-3">
                <p class="mb-1">Foto saat ini:</p>
                <img src="{{ Storage::disk('s3')->url($employee->photo_upload_path) }}" width="150px" class="img-thumbnail">
            </div>
        @endif
    </div>
    <div class="col-12 mt-4 text-end">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
</div>
