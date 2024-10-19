<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('email', 'LIKE', '%' . $request->search . '%')->simplePaginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( 
            [
                'name' => 'required',
                'email' => 'required|email:dns',
                'role' => 'required',
                'password' => 'required|min: 6',
            ],
            [
                'name.required' => 'Nama Wajib Diisi!',
                'email.required' => 'Email Wajib Diisi!',
                'role.required' => 'Role Pengguna Wajib Diisi!',
                'password.required' => 'Password Wajib Diisi!',
                'min.required' => 'Password Minimal 6 Karakter!',
            ]
        );

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($proses) {
            return redirect()->route('accounts')->with('success', 'Berhasil Menambah Akun!');
        } else {
            return redirect()->route('accounts.add')->with('failed', 'Gagal Menambah Akun!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { {
            $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'password' => 'nullable',
                ],
                [
                    'name.required' => 'Nama Wajib Diisi!',
                    'email.required' => 'Email Wajib Diisi!',
                    'role.required' => 'Role Pengguna Wajib Diisi!',
                    'min.required' => 'Password Minimal 6 Karakter!',
                ]
            );

            $proses = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            if ($proses) {
                return redirect()->route('accounts')->with('success', 'Berhasil Mengubah Data Akun!');
            } else {
                return redirect()->route('accounts.edit')->with('failed', 'Gagal Mengubah Data Akun!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = User::where('id', $id)->delete();

        if ($proses) {
            return redirect()->back()->with('delete', 'Akun Berhasil Dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Akun Gagal Dihapus!');
        }
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],
    );

        $proses = $request->only(['name', 'email', 'password']); 
        if (Auth::attempt($proses)) {
            return redirect()->route('landing-page');
        } else {
            return redirect()->back()->with('failed', 'Login gagal, silahkan coba lagi');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah Logout!');
    }

}
