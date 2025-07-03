@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group mb-3">
            <strong>Nomor:</strong>
            <input type="text" name="nomor" value="{{ old('nomor', $employee->nomor ?? '') }}" class="form-control" placeholder="Nomor">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group mb-3">
            <strong>Nama:</strong>
            <input type="text" name="nama" value="{{ old('nama', $employee->nama ?? '') }}" class="form-control" placeholder="Nama">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group mb-3">
            <strong>Jabatan:</strong>
            <input type="text" name="jabatan" value="{{ old('jabatan', $employee->jabatan ?? '') }}" class="form-control" placeholder="Jabatan">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group mb-3">
            <strong>Tanggal Lahir:</strong>
            <input type="date" name="talahir" value="{{ old('talahir', isset($employee->talahir) ? $employee->talahir->format('Y-m-d') : '') }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>Foto:</strong>
            <input type="file" name="photo" class="form-control">
            @if(isset($employee) && $employee->photo_upload_url)
                <div class="mt-2">
                    <img src="{{ $employee->photo_upload_url }}" width="150px" class="img-thumbnail">
                </div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-secondary" href="{{ route('employees.index') }}"> Kembali</a>
    </div>
</div>
