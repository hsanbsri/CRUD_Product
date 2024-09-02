<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'nama_produk' => 'required|max:45',
                'deskripsi' => 'required|max:45',
                'harga' => 'required|numeric',
                'jumlah_stok' => 'required|numeric',
            ],
            [
                'nama_produk.required' => 'Nama produk wajib diisi',
                'nama_produk.max' => 'Nama produk maksimal 45 karakter',
                'deskripsi.required' => 'deskripsi wajib diisi',
                'deskripsi.max' => 'deskripsi maksimal 45 karakter',
                'harga.required' => 'harga wajib diisi',
                'jumlah_stok.required' => 'jumlah stok wajib diisi',
            ]
        );

        //tambah data produk
        DB::table('produks')->insert([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        return redirect()->route('index.index');
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
    public function edit(produk $id)
    {
        //
        return view('produk.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                'nama_produk' => 'required|max:45',
                'deskripsi' => 'required|max:45',
                'harga' => 'required|numeric',
                'jumlah_stok' => 'required|numeric',
            ],
            [
                'nama_produk.required' => 'Nama produk wajib diisi',
                'nama_produk.max' => 'Nama produk maksimal 45 karakter',
                'deskripsi.required' => 'deskripsi wajib diisi',
                'deskripsi.max' => 'deskripsi maksimal 45 karakter',
                'harga.required' => 'harga wajib diisi',
                'jumlah_stok.required' => 'jumlah stok wajib diisi',
            ]
        );

        //update data produk
        DB::table('produks')->where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        return redirect()->route('index.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk $id)
    {
        //
        $id->delete();

        return redirect()->route('index.index')
            ->with('success', 'Data berhasil di hapus');
    }
}
