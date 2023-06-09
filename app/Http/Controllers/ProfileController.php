<?php

namespace App\Http\Controllers;

use App\Models\Pakar;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use TCPDF;


class ProfileController extends Controller
{
    // edit profil user
    public function index1()
    {
        return view('user.profile-edit');
    }
    public function update1(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:4', 'max:20', 'regex:/^\S+$/', Rule::unique('users')->ignore(Auth::guard('user')->user()->id),],
            'foto' => 'mimes:jpeg,jpg,png,gif'
        ], [
            'username.regex' => 'username tidak boleh spasi',
            'foto.mimes' => 'File foto hanya boleh berekstensi JPEG, JPG, PNG, dan GIF'
        ]);

        $user = Auth::guard('user')->user();

        // Menghapus gambar lama jika ada
        $oldImage = Auth::guard('user')->user()->foto;
        if ($request->hasFile('foto') && $oldImage) {
            Storage::delete($oldImage);
        }

        //Mengupdate mengupdate gambar yang sudah ada di database tanpa harus menambah file gambar
        if ($request->hasFile('foto')) {
            $file_name = $request->foto->getClientOriginalName();
            $image = $request->foto->storeAs('images', $file_name);
            $user->foto = $image;
        }

        $user->username = $request->username;
        $user->save();

        // $file_name = $request->foto->getClientOriginalName();
        // $image = $request->foto->storeAs('images', $file_name);

        // Auth::guard('user')->user()->update([
        //     'username' => $request->username,
        //     'foto' => $image
        // ]);

        return redirect('/profile')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function show1()
    {
        return view('user.profile');
    }


    // edit profil pakar
    public function index2()
    {
        $provincies = Province::all();
        $regencies = Regency::all();
        return view('pakar.profilepakar-edit', compact('provincies', 'regencies'));
    }
    public function update2(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:4|max:30',
            'username' => ['required', 'min:4', 'max:20', 'regex:/^\S+$/', Rule::unique('pakars')->ignore(Auth::guard('pakar')->user()->id),],
            'no_telepon' => 'required',
            'regencies_id' => 'required',
            'alamat' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'instansi' => 'nullable',
            'foto' => 'nullable|mimes:jpeg,jpg,png,gif',
        ], [
            'username.regex' => 'username tidak boleh spasi',
            'foto.mimes' => 'File foto hanya boleh berekstensi JPEG, JPG, PNG, dan GIF',
            // 'regencies_id.required' => 'hehehe'
        ]);

        $user = Auth::guard('pakar')->user();

        // Menghapus gambar lama jika ada
        $oldImage = Auth::guard('pakar')->user()->foto;
        $image = null;
        if ($request->hasFile('foto')) {
            // Menghapus gambar lama jika ada
            $oldImage = $user->foto;
            if ($oldImage) {
                Storage::delete($oldImage);
            }
            $file_name = $request->foto->getClientOriginalName();
            $image = $request->foto->storeAs('images', $file_name);
        }

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;
        $user->pendidikan_terakhir = $request->pendidikan_terakhir;
        $user->pekerjaan = $request->pekerjaan;
        $user->instansi = $request->instansi;
        $user->foto = $image;
        $user->save();

        // Update regencies_id
        $regency = Regency::find($request->regencies_id);
        if ($regency) {
            $user->regency()->associate($regency);
            $user->save();
        }

        return redirect('/profilepakar')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function show2()
    {
        $pakar = Auth::guard('pakar')->user();
        $regencies = Regency::with('Province')->whereIn('id', [$pakar->regencies_id])->paginate();

        return view('pakar.profilepakar', compact('regencies', 'pakar'));
    }


    // edit profil admin
    public function index3()
    {
        return view('admin.profileadmin-edit');
    }

    public function update3(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:4', 'max:20', 'regex:/^\S+$/', Rule::unique('admins')->ignore(Auth::guard('admin')->user()->id),],
            'foto' => 'mimes:jpeg,jpg,png,gif',
        ], [
            'username.regex' => 'username tidak boleh spasi',
            'foto.mimes' => 'File foto hanya boleh berekstensi JPEG, JPG, PNG, dan GIF'
        ]);

        $user = Auth::guard('admin')->user();

        // Menghapus gambar lama jika ada
        $oldImage = Auth::guard('admin')->user()->foto;
        if ($request->hasFile('foto') && $oldImage) {
            Storage::delete($oldImage);
        }

        //Mengupdate mengupdate gambar yang sudah ada di database tanpa harus menambah file gambar
        if ($request->hasFile('foto')) {
            $file_name = $request->foto->getClientOriginalName();
            $image = $request->foto->storeAs('images', $file_name);
            $user->foto = $image;
        }

        $user->username = $request->username;
        $user->save();
        return redirect('/profileadmin')->with('success', 'Profil Berhasil Diperbarui');
    }
    public function show3()
    {
        return view('admin.profileadmin');
    }


    public function index4()
    {
        return view('pakar.cv-sertifikat');
    }

    public function update4(Request $request)
    {
        $validatedData = $request->validate([
            'cv' => 'required|mimes:pdf',
            'sertifikat' => 'nullable|mimes:pdf',
            'status' => 'required'
        ], [
            'cv.mimes' => 'File harus berformat PDF',
            'sertifikat.mimes' => 'File harus berformat PDF',
        ]);

        $status = $validatedData['status'];

        $pakar = Pakar::findOrFail($request->user()->id);

        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvNama = time() . '.' . $cvFile->getClientOriginalExtension();
            $cvFile->move('cv', $cvNama);
            $validatedData['cv'] = $cvNama;
        }

        if ($request->hasFile('sertifikat')) {
            $sertifikatFile = $request->file('sertifikat');
            $sertifikatNama = time() . '.' . $sertifikatFile->getClientOriginalExtension();
            $sertifikatFile->move('sertifikat', $sertifikatNama);
            $validatedData['sertifikat'] = $sertifikatNama;
        }

        $validatedData['status'] = $status;

        $pakar->update($validatedData);

        return redirect()->route('profilepakar')->with('success', 'Pengajuan pakar berhasil diperbarui');
    }
}
