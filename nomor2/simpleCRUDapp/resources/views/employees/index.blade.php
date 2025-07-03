@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Karyawan</h2>
            <a class="btn btn-success" href="{{ route('employees.create') }}"> Tambah Karyawan Baru</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th width="280px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    @if($employee->photo_upload_url)
                        <img src="{{ $employee->photo_upload_url }}" alt="{{ $employee->nama }}" width="100" class="img-thumbnail">
                    @else
                        <span>No Photo</span>
                    @endif
                </td>
                <td>{{ $employee->nomor }}</td>
                <td>{{ $employee->nama }}</td>
                <td>{{ $employee->jabatan }}</td>
                <td>
                    <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('employees.show',$employee->id) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $employees->links() !!}

@endsection