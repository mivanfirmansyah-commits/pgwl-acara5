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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'geometri_polygon.required' => 'Geometri polygon harus diisi.',
            'nama.required' => 'Nama Polygon harus diisi.',
            'deskripsi.required' => 'Deskripsi Polygon harus diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        // buat folder untuk menyimpan gambar jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get the uploaded image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometri_polygon,
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'image' => $name_image,
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
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,
        ];
        return view('map-edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi input
        $request->validate([
            'geometri' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'geometri_polygon.required' => 'Geometri polygon harus diisi.',
            'nama.required' => 'Nama Polygon harus diisi.',
            'deskripsi.required' => 'Deskripsi Polygon harus diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        // buat folder untuk menyimpan gambar jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        $image_old = $this->polygon->find($id)->image;

        // Get the uploaded image file
        if ($iimage_old = $request->hasFile('image')) {
            $image_old = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image_old->getClientOriginalExtension());
            $image_old->move('storage/images', $name_image);
        } else {
            $name_image = $image_old; // Jika tidak ada gambar baru, gunakan nama gambar lama
        }

        $data = [
            'geom' => $request->geometri,
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'image' => $name_image,
        ];

        // simpan update data ke database
        if ($this->polygon->find($id)->update($data)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Data Polygon berhasil diperbarui!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal memperbarui data polygon!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari nama file gambar berdasarkan ID polygon
        $image = $this->polygon->find($id)->image;

        // Hapus data dari database
        if ($this->polygon->destroy($id)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Polygon berhasil dihapus!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal menghapus polygon!');
    }
}
