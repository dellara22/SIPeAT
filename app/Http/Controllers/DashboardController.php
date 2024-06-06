<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();

        $events = $peminjaman->map(function ($event) {
            return [
                'start' => $event->tanggal, // Sesuaikan dengan nama kolom di tabel Anda
                'end' => $event->tanggal, // Sesuaikan dengan nama kolom di tabel Anda
                'display' => 'background'
            ];
        })->toArray();
        return view('user.dashboard', [
            'events' => json_encode($events),
        ]);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function peminjaman()
    {
        $userId = Auth::id();
        $peminjaman = Peminjaman::where('addedby', $userId)->get();
        $disetujui = Peminjaman::where('status', '3')->where('addedby', $userId)->get();
        $ditolak = Peminjaman::where('status', '2')->where('addedby', $userId)->get();
        $dibatalkan = Peminjaman::where('status', '1')->where('addedby', $userId)->get();
        $user = Auth::user();

        return view('user.peminjaman.peminjaman', compact('disetujui', 'ditolak', 'dibatalkan', 'peminjaman', 'user'));
    }

    public function createPeminjaman(Request $request)
    {
        $ruangans = Ruangan::all();
        $tanggal = null;
        $room = null;
        // Cek apakah parameter date ada dalam request
        if ($request->has('date')) {
            $tanggal = Carbon::createFromFormat('Y-m-d', $request->date)->format('m / d / Y');
        } else {
            // Jika tidak ada, set default value atau kosongkan
            $tanggal = null; // Atau bisa juga menggunakan Carbon::now()->format('m / d / Y') untuk tanggal hari ini
        }

        // Cek apakah parameter ruangan ada dalam request
        if ($request->has('ruangan')) {
            $room = $request->ruangan;
        } else {
            // Jika tidak ada, set default value atau kosongkan
            $room = null; // Atau bisa juga menggunakan Carbon::now()->format('m / d / Y') untuk tanggal hari ini
        }
        return view('user.peminjaman.form-peminjaman', compact('ruangans', 'tanggal', 'room'));
    }

    public function storePeminjaman(Request $request)
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

        $formattedDate = Carbon::createFromFormat('m / d / Y', $request->tanggal)->format('Y-m-d');
        Peminjaman::create([
            'pemohon' => $request->pemohon,
            'kegiatan' => $request->kegiatan,
            'deskripsi' => $request->deskripsi,
            'ruangan' => $request->ruangan,
            'tanggal' => $formattedDate,
            'surat' => $data,
            'addedby' => Auth::user()->id,
        ]);
        Alert::success('Berhasil', 'Peminjaman successfullly created');
        return to_route('peminjaman');
    }

    public function checkPeminjaman(Request $request)
    {
        $tanggal = $request->date;
        $peminjaman = Peminjaman::where('tanggal', Carbon::parse($tanggal))->get();


        if ($peminjaman->isNotEmpty()) {
            return response()->json([
                'exist' => true,
                'peminjaman' => $peminjaman
            ]);
        }

        return response()->json([
            'exist' => false,
        ]);
    }

    // public function keteranganPeminjaman(Request $request)
    // {
    //     $tanggal = $request->date;
    //     $ruangans = Ruangan::all();
    //     $peminjaman = Peminjaman::where('tanggal', Carbon::parse($tanggal))->first();

    //     $formattedDate = Carbon::createFromFormat('Y-m-d', $tanggal)->format('m / d / Y');

    //     return view('user.peminjaman.update', compact('peminjaman', 'ruangans', 'formattedDate'));
    // }

    public function updatePeminjaman(Request $request, Peminjaman $peminjaman)
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

        $formattedDate = Carbon::createFromFormat('m / d / Y', $request->tanggal)->format('Y-m-d');


        $peminjaman->pemohon = isset($request->pemohon) ? $request->pemohon : $peminjaman->pemohon;
        $peminjaman->kegiatan = isset($request->kegiatan) ? $request->kegiatan : $peminjaman->kegiatan;
        $peminjaman->deskripsi = isset($request->deskripsi) ? $request->deskripsi : $peminjaman->deskripsi;
        $peminjaman->ruangan = isset($request->ruangan) ? $request->ruangan : $peminjaman->ruangan;
        $peminjaman->tanggal = isset($request->tanggal) ? $formattedDate : $peminjaman->tanggal;
        $peminjaman->surat = $data == ' ' ? $peminjaman->surat : $data;
        $peminjaman->update();

        Alert::success('Berhasil', 'Peminjaman successfullly created');
        return to_route('peminjaman');
    }

    public function deletePeminjaman($peminjaman)
    {
        $peminjaman->delete();
        Alert::success('Berhasil', 'Peminjaman successfullly deleted');
        return to_route('peminjaman');
    }

    public function ruangan()
    {
        $ruangan = Ruangan::all();

        return view('user.ruangan.ruangan', compact('ruangan'));
    }
}