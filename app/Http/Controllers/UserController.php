<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->password === $request->confirm_password) {

            $employee = Employee::where('employee_id', $request->employee_id)->first();

            if (!$employee) {
                return back()->with('error', 'NIK karyawan tidak ditemukan...');
            }
            User::create([
                'name' => $employee->name,
                'employee_id' => $employee->id,
                'email' => $request->email,
                'level_access' => $request->level_access,
                'password' => bcrypt($request->password),
            ]);
            return back()->with('success', 'Pengguna baru berhasil ditambahkan.');
        }
        return back()->with('error', 'Konfirmasi kata sandi tidak sesuai.');
    }

    public function update(Request $request, $id)
    {

        if ($request->filled('password')) {
            if ($request->password === $request->confirm_password) {
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'level_access' => $request->level_access,
                    'password' => bcrypt($request->password),
                ]);
                return back()->with('success', 'Berhasil melakukan perubahan data.');
            }
            return back()->with('error', 'Konfirmasi kata sandi tidak sesuai.');
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Berhasil melakukan perubahan data.');
    }

    public function disableUser($id)
    {
        User::where('id', $id)->update([
            'user_status' => 1
        ]);

        return back()->with('success', 'Pengguna berhasil dinonaktifkan');
    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('user.profile', compact('user'));
    }
}
