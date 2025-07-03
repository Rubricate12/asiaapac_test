@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Tambah Karyawan Baru</h2>
    </div>
</div>

<form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('employees.partials.form')
</form>
@endsection