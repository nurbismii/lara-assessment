<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Imports\EmployeeUpdateImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        Employee::create([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'departement' => $request->departement,
            'divisi' => $request->divisi
        ]);

        return back()->with('success', 'Karyawan baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();

        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        Employee::where('id', $id)->update([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'departement' => $request->departement,
            'divisi' => $request->divisi
        ]);

        return back()->with('success', 'Karyawan telah berhasil diperbarui');
    }

    public function destroy($id)
    {
        Employee::where('id', $id)->delete();

        return back()->with('success', 'Karyawan telah berhasil dihapus');
    }

    public function importStore(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new EmployeeImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
            return back()->withStatus('File Excel Berhasil Di Upload');
        }
        return back()->with('error', 'Silahkan pilih file terlebih dahulu');
    }

    public function importUpdate(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new EmployeeUpdateImport();
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
            return back()->with('success', 'File excel berhasil diupload');
        }
        return back()->with('error', 'Silahkan pilih file terlebih dahulu');
    }
}
