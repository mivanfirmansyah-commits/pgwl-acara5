<?php

namespace App\Http\Controllers;
use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    protected $polylines; // ← tambahkan ini

    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // validasi input
        $request->validate([
            'geometri_polyline' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
        ], [
            'geometri_polyline.required' => 'Geometri polyline harus diisi.',
            'nama.required' => 'Nama Polyline harus diisi.',
            'deskripsi.required' => 'Deskripsi Polyline harus diisi.',
        ]);
        $data = [
            'geom' => $request->geometri_polyline,
            'name' => $request->nama,
            'description' => $request->deskripsi,
        ];

        // simpan data ke database
        $this->polylines->create($data);

        // kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'polyline berhasil disimpan!');
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
}
