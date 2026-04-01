<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    protected $points;

    public function __construct()
    {
        $this->points = new PointsModel();
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
            'geometri_point' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
        ], [
            'geometri_point.required' => 'Geometri point harus diisi.',
            'nama.required' => 'Nama Titik harus diisi.',
            'deskripsi.required' => 'Deskripsi Titik harus diisi.',
        ]);
        $data = [
            'geom' => $request->geometri_point,
            'name' => $request->nama,
            'description' => $request->deskripsi,
        ];

        // simpan data ke database
        if ($this->points->create($data)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Titik berhasil disimpan!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal menyimpan titik!');
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
