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

            $employee_id = Employee::select('employee_id')->where('employee_id', $request->employee_id)->first();

            if (!$employee_id) {
                return back()->with('error', 'NIK yang kamu gunakan tidak dapat ditemukan');
            }

            User::create([
                'employee_id' => $employee_id,
                'name' => $request->name,
                'email' => $request->email,
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
