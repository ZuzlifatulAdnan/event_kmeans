<?php

namespace App\Http\Controllers;

use App\Exports\UmkmExport;
use App\Imports\UmkmImport;
use App\Models\umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     * */
    public function index(Request $request)
    {
        $type_menu = 'umkm';
        $keyword = trim($request->input('nama'));

        $umkms = Umkm::when($keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_umkm', 'like', "%{$keyword}%")
                    ->orWhere('nama_pemilik', 'like', "%{$keyword}%");
            });
        })->latest()->paginate(10);

        $umkms->appends(['nama' => $keyword]);

        return view('pages.umkm.index', compact('type_menu', 'umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'umkm';

        return view('pages.umkm.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'tahun_bergabung' => 'required|digits:4',
            'jenis_umkm' => 'required|string|max:100',
            'nama_event' => 'nullable|string|max:255',
            'username_instagram' => 'nullable|string|max:255',
        ]);

        $umkm = umkm::create([
            'nama_umkm' => $request->nama_umkm,
            'nama_pemilik' => $request->nama_pemilik,
            'tahun_bergabung' => $request->tahun_bergabung,
            'jenis_umkm' => $request->jenis_umkm,
            'nama_event' => $request->nama_event,
            'username_instagram' => $request->username_instagram,
        ]);

        //jika proses berhsil arahkan kembali ke halaman umkm dengan status success
        return Redirect::route('umkm.index')->with('success', 'Umkm ' . $umkm->nama_umkm . ' berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(umkm $umkm)
    {
        $type_menu = 'umkm';

        return view('pages.umkm.edit', compact('umkm', 'type_menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, umkm $umkm)
    {
        // Validate the form data
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'tahun_bergabung' => 'required|digits:4',
            'jenis_umkm' => 'required|string|max:100',
            'nama_event' => 'nullable|string|max:255',
            'username_instagram' => 'nullable|string|max:255',
        ]);

        $umkm->update([
            'nama_umkm' => $request->nama_umkm,
            'nama_pemilik' => $request->nama_pemilik,
            'tahun_bergabung' => $request->tahun_bergabung,
            'jenis_umkm' => $request->jenis_umkm,
            'nama_event' => $request->nama_event,
            'username_instagram' => $request->username_instagram,
        ]);

        return Redirect::route('umkm.index')->with('success', 'Umkm ' . $umkm->nama_umkm . ' berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(umkm $umkm)
    {
        $umkm->delete();
        return Redirect::route('umkm.index')->with('success', 'Umkm ' . $umkm->nama_umkm . ' berhasil di hapus.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new UmkmImport, $request->file('file'));
        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diimport!');
    }

    public function export()
    {
        return Excel::download(new UmkmExport, 'data-umkm.xlsx');
    }
}
