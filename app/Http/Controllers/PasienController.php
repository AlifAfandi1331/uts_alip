<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Support\Facades\Storage;


class PasienController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pasien'] = \App\Models\Pasien::latest()->paginate(10);
        return view('pasien.pasien_index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('pasien.pasien_create');

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien',
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'nomor_telepon_pasien' => 'required|numeric',
            'foto' => 'required|image|mimes:jpg,png|max:50000',   
            ]);
            $pasien = new \App\Models\Pasien(); //membuat objek kosong di variabel model
            $pasien->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData4
            $pasien->foto = $request->file('foto')->store('images', 'public');
            $pasien->save();
            flash('Data Telah Disimpan')->success();
            return back();
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
        $data['pasien'] = \App\Models\Pasien::findOrFail($id);
        return view('pasien_edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien,' . $id,
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'nomor_telepon_pasien' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,png|max:50000',   
     // foto boleh null
        ]);
    
        $pasien = \App\Models\Pasien::findOrFail($id);
    
        $pasien->fill($requestData);
    
        // karena di validasi foto boleh null, maka perlu pengecekan apakah ada file foto yang diupload
        // jika ada maka file foto lama dihapus dan diganti dengan file foto yang baru
        if ($request->hasFile('foto')) {
            Storage::delete($pasien->foto);
            $pasien->foto = $request->file('foto')->store('public');
        }
    
        $pasien->save();
    
        flash('Data sudah diupdate')->success();
    
        return redirect('/pasien');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Pasien::findOrFail($id);
        flash('Data sudah dihapus')->success();
        return back();

    }
    public function buat()
    { $data['nama'] = "budi";
        $data['umur'] = 20;
        $data['hobi'] = "makan";

        $data['nama1'] = "rapli";
        $data['umur2'] = 20;
        $data['hobi3'] = "lagu";
        return view('pasien.pasien_form', $data);
    }
}
