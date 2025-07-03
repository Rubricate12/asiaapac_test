<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
    return redirect()->route('employees.index');
});

// Resourceful route untuk Employee CRUD
Route::resource('employees', EmployeeController::class);

//testing utk S3
Route::get('/test-s3', function () {
    try {
        Storage::disk('s3')->put('test.txt', 'Halo dari Laravel!');
        return "File 'test.txt' berhasil diunggah ke S3!";
    } catch (\Exception $e) {
        return "Gagal ke S3: " . $e->getMessage();
    }
});

// testing utk redis
Route::get('/test-redis', function () {
    try {
        Redis::set('nama', 'bryan');
        $nama = Redis::get('nama');
        return "Berhasil. Nama: " . $nama;
    } catch (\Exception $e) {
        return "Gagal:" . $e->getMessage();
    }
});
