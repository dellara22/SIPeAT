<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('ruangan')->get();
        $ruangan = Ruangan::all();
        $total = $peminjaman->count();
        $totalsetuju = $peminjaman->where('status', 3)->count();
        $totaltdksetuju = $peminjaman->where('status', 2)->count();
        $totalbatal = $peminjaman->where('status', 1)->count();

        // dd($peminjaman);

        return view('admin.dataPeminjaman', compact('peminjaman', 'total', 'totalsetuju', 'totaltdksetuju', 'totalbatal', 'ruangan'));
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
        $existingPeminjaman = Peminjaman::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->ruangan)
            ->where('status', '3')
            ->first();

        if ($existingPeminjaman) {
            // Jika sudah ada peminjaman dengan status 'DISETUJUI', kembalikan pesan error
            Alert::error('Gagal', 'Peminjaman pada tanggal tersebut sudah ada yang disetujui');
            return back()->withInput();
        }

        $data = ' ';
        if ($request->hasFile('surat')) {
            // $originalName = $request->file('surat')->getClientOriginalName();
            $pemohon = str_replace(' ', '', $request->pemohon);
            $fileName =  $pemohon . '_' . time() . 'pdf';
            $request->file('surat')->move('pdf/peminjaman/', $fileName);
            // $request->file('surat')->move('pdf/peminjaman/', $request->file('surat')->getClientOriginalName());
            $data = $fileName;
            // $data = $request->file('surat')->getClientOriginalName();
        }
        Peminjaman::create([
            'pemohon' => $request->pemohon,
            'ruangan' => $request->ruangan,
            'tanggal' => $request->tanggal,
            'surat' => $data,
            'addedby' => Auth::user()->id,
        ]);
        Alert::success('Berhasil', 'Peminjaman successfullly created');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $ruangans = Ruangan::all();
        $peminjaman = Peminjaman::find($request->id);

        $formattedDate = Carbon::createFromFormat('Y-m-d', $peminjaman->tanggal)->format('m / d / Y');

        return view('user.peminjaman.update', compact('peminjaman', 'ruangans', 'formattedDate'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $ruangan = Ruangan::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $existingPeminjaman = Peminjaman::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->ruangan)
            ->where('status', '3')
            ->first();

        if ($existingPeminjaman) {
            // Jika sudah ada peminjaman dengan status 'DISETUJUI', kembalikan pesan error
            Alert::error('Gagal', 'Peminjaman pada tanggal tersebut sudah ada yang disetujui');
            return back()->withInput();
        }

        $data = ' ';
        if ($request->hasFile('surat')) {
            // $originalName = $request->file('surat')->getClientOriginalName();
            $pemohon = str_replace(' ', '', $request->pemohon);
            $fileName =  $pemohon . '_' . time() . 'pdf';
            $request->file('surat')->move('pdf/peminjaman/', $fileName);
            // $request->file('surat')->move('pdf/peminjaman/', $request->file('surat')->getClientOriginalName());
            $data = $fileName;
            // $data = $request->file('surat')->getClientOriginalName();
        }

        $peminjaman->pemohon = isset($request->pemohon) ? $request->pemohon : $peminjaman->pemohon;
        $peminjaman->ruangan = isset($request->ruangan) ? $request->ruangan : $peminjaman->ruangan;
        $peminjaman->tanggal = isset($request->tanggal) ? $request->tanggal : $peminjaman->tanggal;
        $peminjaman->surat = $data == ' ' ? $peminjaman->surat : $data;

        if ($request->status == '3') {
            $peminjamans = Peminjaman::where('tanggal', $request->tanggal)
                ->where('ruangan', $request->ruangan)
                ->where('id', '!=', $peminjaman->id)
                ->get();

            foreach ($peminjamans as $item) {
                $item->status = '2';
                $item->update();
            }
        }

        $peminjaman->status = isset($request->status) ? $request->status : $peminjaman->status;
        $peminjaman->update();

        Alert::success('Berhasil', 'Peminjaman successfullly updated');
        return to_route('admin.peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        Alert::success('Berhasil', 'Peminjaman successfullly deleted');
        return back();
    }
}
