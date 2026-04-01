<?php

namespace App\Http\Controllers;

use App\Models\PolygonModel;
use Illuminate\Http\Request;

class PolygonController extends Controller
{
    protected $polygon;

    public function __construct()
    {
        $this->polygon = new PolygonModel();
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
            'geometri_polygon' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
        ], [
            'geometri_polygon.required' => 'Geometri polygon harus diisi.',
            'nama.required' => 'Nama Polygon harus diisi.',
            'deskripsi.required' => 'Deskripsi Polygon harus diisi.',
        ]);
        $data = [
            'geom' => $request->geometri_polygon,
            'name' => $request->nama,
            'description' => $request->deskripsi,
        ];

        // simpan data ke database
        $this->polygon->create($data);

        // kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Polygon berhasil disimpan!');
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
