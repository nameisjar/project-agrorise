<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DetailPembayaran;
use App\Models\Pakar;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('database.database-pakar');
    }
    public function show1()
    {
        $data = User::orderBy('id', 'desc')->paginate(5);
        return view('database.database-user')->with('data', $data);
    }
    public function show2()
    {
        $data = Pakar::orderBy('id', 'desc')->paginate(6);
        return view('database.database-pakar', compact('data'));
    }
    public function show3(Request $request)
    {
        $data = Course::orderBy('id', 'desc')->paginate(6);
        return view('database.pengajuan-course', compact('data'));
    }
    public function show4(Request $request)
    {
        // 1. Dapatkan ID pengguna yang sedang terautentikasi
        $userId = Auth::guard('pakar')->id();

        // 2. Dapatkan semua detail pembayaran yang sesuai
        $data = DetailPembayaran::whereHas('course', function ($query) use ($userId) {
            $query->where('pakar_id', $userId);
        })
            ->with('user', 'course')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // 3. Tampilkan data-detail pembayaran dalam tampilan
        return view('pakar.invoice-course', compact('data'));
    }


    public function store(Request $request)
    {
        // Validasi input form jika diperlukan
        $validatedData = $request->validate([
            'admin_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'setuju' => 'required|in:1,0',
        ]);

        $adminId = $validatedData['admin_id'];
        $courseId = $validatedData['course_id'];
        $setuju = $validatedData['setuju'];

        // Lakukan pemrosesan sesuai kebutuhan
        if ($setuju == 1) {
            // Jika disetujui, masukkan admin_id ke dalam tabel course
            $course = Course::find($courseId);
            $course->admin_id = $adminId;
            $course->status = 'Disetujui';
            $course->save();

            // Tambahkan logika lain yang perlu dilakukan jika disetujui
            // ...
        } else {
            // Jika ditolak, lakukan tindakan lain yang sesuai
            // ...

            // Misalnya, jika Anda ingin menghapus data course yang ditolak, Anda dapat menggunakan kode berikut:
            // Course::find($courseId)->delete();

            $course = Course::find($courseId);
            $course->admin_id = null; // Hapus admin_id jika ditolak
            $course->status = 'Ditolak';
            $course->save();
        }

        // Kembali ke halaman yang sesuai setelah pemrosesan
        return redirect()->back()->with('success', 'Persetujuan berhasil diproses.');
    }
    public function store1(Request $request)
    {
        // Validasi input form jika diperlukan
        $validatedData = $request->validate([
            'admin_id' => 'required|numeric',
            'pakar_id' => 'required|numeric',
            'setuju' => 'required|in:1,0',
        ]);

        $adminId = $validatedData['admin_id'];
        $courseId = $validatedData['pakar_id'];
        $setuju = $validatedData['setuju'];

        // Lakukan pemrosesan sesuai kebutuhan
        if ($setuju == 1) {
            // Jika disetujui, masukkan admin_id ke dalam tabel course
            $course = Pakar::find($courseId);
            $course->admin_id = $adminId;
            $course->status = 'Disetujui';
            $course->save();

            // Tambahkan logika lain yang perlu dilakukan jika disetujui
            // ...
        } else {
            // Jika ditolak, lakukan tindakan lain yang sesuai
            // ...

            // Misalnya, jika Anda ingin menghapus data course yang ditolak, Anda dapat menggunakan kode berikut:
            // Course::find($courseId)->delete();

            $course = Pakar::find($courseId);
            $course->admin_id = null; // Hapus admin_id jika ditolak
            $course->status = 'Ditolak';
            $course->save();
        }

        // Kembali ke halaman yang sesuai setelah pemrosesan
        return redirect()->back()->with('success', 'Persetujuan berhasil diproses.');
    }
}
