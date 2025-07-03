@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Edit Data Karyawan</h2>
    </div>
</div>

<form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('employees.partials.form', ['employee' => $employee])
</form>
@endsection
