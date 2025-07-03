@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
<div class="d-flex justify-content-between align-items-center content-header">
    <h1 class="h2">Daftar Karyawan</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus-circle" class="icon-sm"></i>
        <span>Tambah Karyawan</span>
    </a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success mb-4" role="alert">
        {{ $message }}
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-vcenter">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            {{-- PERUBAHAN DI SINI: Menggunakan !empty() untuk pengecekan yang lebih aman --}}
                            <img src="{{ !empty($employee->photo_upload_path) ? Storage::disk('s3')->url($employee->photo_upload_path) : 'https://placehold.co/40x40/e9ecef/495057?text=' . substr($employee->nama, 0, 1) }}" alt="{{ $employee->nama }}" class="avatar me-3 rounded">
                            <div>
                                <div class="fw-bold">{{ $employee->nama }}</div>
                                <div class="text-muted">{{ $employee->talahir ? $employee->talahir->format('d M Y') : '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $employee->nomor }}</td>
                    <td>{{ $employee->jabatan }}</td>
                    <td>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data karyawan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {!! $employees->links() !!}
    </div>
</div>
@endsection
