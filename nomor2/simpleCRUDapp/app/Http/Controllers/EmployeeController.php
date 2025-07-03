<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // get semua karyawan
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    //pindah ke form agar bisa buat data baru
    public function create()
    {
        return view('employees.create');
    }

    //simpan ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor',
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 's3');
            $url = Storage::disk('s3')->url($path);

            $data['photo_upload_path'] = $path;
            $data['photo_upload_url'] = $url;
        }

        $employee = Employee::create($data);

        Redis::set('emp_' . $employee->nomor, $employee->toJson());

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    //menampilkan 1 karyawan saja
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    //form untuk edit data karyawan
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    //update data karyawan
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor,' . $employee->id,
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('photo');
        $oldNomor = $employee->nomor; 

        if ($request->hasFile('photo')) {
            if ($employee->photo_upload_path) {
                Storage::disk('s3')->delete($employee->photo_upload_path);
            }

            $path = $request->file('photo')->store('photos', 's3');
            $url = Storage::disk('s3')->url($path);
            $data['photo_upload_path'] = $path;
            $data['photo_upload_url'] = $url;
        }

        $employee->update($data);

        
        Redis::del('emp_' . $oldNomor);
        Redis::set('emp_' . $employee->nomor, $employee->toJson());

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    //delete data karyawan
    public function destroy(Employee $employee)
    {
        Redis::del('emp_' . $employee->nomor);

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
