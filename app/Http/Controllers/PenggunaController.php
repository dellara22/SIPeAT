<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::role('user')->get();
        $totalpengguna = $pengguna->count();
        $totaladmin = User::role('admin')->count();
        $jurusan = jurusan::all()->count();

        return view('admin.userManagement', compact('pengguna', 'totalpengguna', 'totaladmin', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'no_hp' => ['required', 'string', 'max:12'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // User::create($validated)->assignRole('user');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ])->assignRole('user');

        Alert::success('Berhasil', 'Pengguna successfullly created');
        return back();
    }
}
