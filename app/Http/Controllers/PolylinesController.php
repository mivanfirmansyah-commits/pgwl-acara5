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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'geometri_polyline.required' => 'Geometri polyline harus diisi.',
            'nama.required' => 'Nama Polyline harus diisi.',
            'deskripsi.required' => 'Deskripsi Polyline harus diisi.',
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
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometri_polyline,
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'image' => $name_image,
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
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id,
        ];
        return view('map-edit-polyline', $data);
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
            'geometri_polyline.required' => 'Geometri polyline harus diisi.',
            'nama.required' => 'Nama Polyline harus diisi.',
            'deskripsi.required' => 'Deskripsi Polyline harus diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        // buat folder untuk menyimpan gambar jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        $image_old = $this->polylines->find($id)->image;

        // Get the uploaded image file
        if ($iimage_old = $request->hasFile('image')) {
            $image_old = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image_old->getClientOriginalExtension());
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
        if ($this->polylines->find($id)->update($data)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Data Polyline berhasil diperbarui!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal memperbarui data polyline!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari nama file gambar berdasarkan ID polyline
        $image = $this->polylines->find($id)->image;

        // Hapus data dari database
        if ($this->polylines->destroy($id)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Polyline berhasil dihapus!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal menghapus polyline!');
    }
}
