<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        $total = $ruangan->count();
        $tersedia = $ruangan->where('status', true)->count();
        $tidaktersedia = $ruangan->where('status', false)->count();
        return view('admin.dataRuangan', compact('ruangan', 'total', 'tersedia', 'tidaktersedia'));
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
        $data = ' ';
        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->move('assets/img/ruangan/', $request->file('thumbnail')->getClientOriginalName());
            $data = $request->file('thumbnail')->getClientOriginalName();
        }
        Ruangan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $data,
        ]);
        Alert::success('Berhasil', 'Ruangan successfullly created');
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Ruangan $ruangan)
    {
        $ruangan->status = !($ruangan->status);
        $ruangan->update();
        Alert::success('Berhasil', 'Ruangan successfullly updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
