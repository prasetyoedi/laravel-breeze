<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Intervention\Image\Facades\Image;
use App\Models\Gallery;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 4;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'asc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalharga = Buku::sum('harga');
        // return view('buku', compact('data_buku', 'totalharga'));
        return view('dashboard', compact('data_buku', 'no', 'jumlah_buku', 'totalharga'));
    }

    public function search(Request $request)
    {
        $batas = 7;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
            ->orWhere('penulis', 'like', "%" . $cari . "%")
            ->orWhere('harga', 'like', "%" . $cari . "%")
            ->orWhere('tgl_terbit', 'like', "%" . $cari . "%")
            ->paginate($batas);

        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalharga = Buku::sum('harga');
        // return view('buku', compact('data_buku', 'totalharga'));
        return view('/dashboard', compact('jumlah_buku', 'data_buku', 'no', 'cari', 'totalharga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
            'judul.required' => 'Judul harus diisi',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer',
            'tgl_terbit' => 'required|date',
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/dashboard')->with('pesan', 'Data Buku Berhasil Disimpan!');
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
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        Image::make(storage_path() . '/app/public/uploads/' . $fileName)
            ->fit(240, 320)
            ->save();

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $fileName,
            'filepath' => '/storage/' . $filePath
        ]);

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }
        return redirect('/dashboard')->with('pesan', 'Perubahan Data Buku Berhasil disimpan!');


        // $this->validate($request, [
        //     'judul' => 'required|string|max:255',
        //     'penulis' => 'required|string|max:255',
        //     'harga' => 'required|integer',
        //     'tgl_terbit' => 'required|date',
        // ]);

        // $buku = Buku::find($id);
        // $buku->judul = $request->judul;
        // $buku->penulis = $request->penulis;
        // $buku->harga = $request->harga;
        // $buku->tgl_terbit = $request->tgl_terbit;
        // $buku->save();
        // return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/dashboard');
    }
}