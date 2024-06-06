<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Http\Requests\StorejurusanRequest;
use App\Http\Requests\UpdatejurusanRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = jurusan::all();
        $jurusan_count = jurusan::all()->count();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.dataJurusan', compact('jurusans', 'jurusan_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nama_ketua' => ['required', 'string', 'max:255'],
        ]);
        jurusan::create($validated);
        Alert::success('Berhasil', 'Jurusan successfullly created');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jurusan $jurusan)
    {
        $jurusan->name = isset($request->name) ? $request->name : $jurusan->name;
        $jurusan->nama_ketua = isset($request->nama_ketua) ? $request->nama_ketua : $jurusan->nama_ketua;
        $jurusan->update();

        Alert::success('Berhasil', 'Jurusan successfullly updated');
        return to_route('admin.jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jurusan = jurusan::find($id);
        $jurusan->delete();
        Alert::success('Berhasil', 'Jurusan successfullly deleted');
        return back();
    }
}
