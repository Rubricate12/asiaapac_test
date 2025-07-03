<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    //get semua karyawan
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    //form untuk create
    public function create()
    {
        return view('employees.create');
    }

    //simpan daTa karyawan ke db
    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor',
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 's3');
            $data['photo_upload_path'] = $path;
        }

        $employee = Employee::create($data);

        Redis::set('emp_' . $employee->nomor, $employee->toJson());

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    //redirect ke form
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    //edit data karyawan
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor,' . $employee->id,
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('photo');
        $oldNomor = $employee->nomor;

        //update dgn s3
        if ($request->hasFile('photo')) {
            if ($employee->photo_upload_path) {
                Storage::disk('s3')->delete($employee->photo_upload_path);
            }

            $path = $request->file('photo')->store('photos', 's3');
            $data['photo_upload_path'] = $path;
        }

        $employee->update($data);

        Redis::del('emp_' . $oldNomor);
        Redis::set('emp_' . $employee->nomor, $employee->toJson());

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    //delete data karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Redis::del('emp_' . $employee->nomor);
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}