<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DetailPembayaran;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1()
    {
    }



    public function index()
    {
        $pakar_id = Auth::guard('pakar')->user()->id;
        $courses = Course::where('pakar_id', $pakar_id)->get();
        return view('pakar.pengajuan-index', compact('courses'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pakar.pengajuan');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create1()
    {
        return view('pakar.pengajuan-video');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|max:40',
            'thumbnail' => 'required|mimes:png,jpg,jpeg',
            'jmlh_peserta' => 'required',
            'no_rekening' => 'required',
            'deskripsi' => 'required|max:500',
            'harga' => 'required',
            'pertemuan' => 'required',
            'title.*' => 'required', // tambahkan validasi untuk judul video
            'link.*' => 'required' // tambahkan validasi untuk link video
        ]);

        $thumbnail =  $request->thumbnail->getClientOriginalName();
        $file = $request->thumbnail->storeAs('thumbnail', $thumbnail);

        $harga = str_replace(['.', ',', 'Rp'], '', $request->harga);
        $harga = intval($harga);

        $course = Course::create([
            'pakar_id' => Auth::guard('pakar')->user()->id,
            'judul' => $request->judul,
            'thumbnail' => $file,
            'jmlh_peserta' => $request->jmlh_peserta,
            'no_rekening' => $request->no_rekening,
            'pertemuan' => $request->pertemuan,
            'deskripsi' => $request->deskripsi,
            'harga' => $harga
        ]);

        $videos = [];

        // Menyimpan video-video yang ditambahkan
        if (!empty($request->title) && is_array($request->title) && !empty($request->link) && is_array($request->link)) {
            for ($i = 0; $i < count($request->title); $i++) {
                $video = new Video([
                    'title' => $request->title[$i],
                    'link' => $request->link[$i],
                    'course_id' => $course->id
                ]);

                $video->save();
                $videos[] = $video;
            }
        }

        return redirect()->route('pengajuan-index')->with('success', 'Data kursus berhasil disimpan!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
    }

    // untuk menampilkan semua kursus
    public function show1()
    {
        $courses = Course::all();
        return view('course.course', compact('courses'));
    }

    // untuk menampilkan video dari kursus
    public function show2(Course $course)
    {
        $videos = $course->videos;
        return view('course.contentcourse', compact('course', 'videos'));
    }

    // untuk menampilkan kursus yang sudah dibeli
    public function show3()
    {
        $user_id = auth()->user()->id; // Mengambil user_id dari user yang sedang login
        $paidOrders = DetailPembayaran::where('user_id', $user_id)
            ->where('status', 'Paid')
            ->pluck('course_id'); // Mengambil daftar course_id dengan status 'Paid'

        $courses = Course::whereIn('id', $paidOrders)->get(); // Mengambil data course berdasarkan course_id yang memiliki status 'Paid'

        return view('user.profile-course', compact('courses'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->videos()->delete(); // Menghapus video terkait
        $course->delete(); // Menghapus kursus
        return redirect()->back();
    }


    public function index2(Course $course)
    {
        $videos = Video::where('course_id', $course->id)->get();
        return view('course.contentcourse', compact('course', 'videos'));
    }


    public function checkout(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'course_id' => 'required',
            'no_telepon' => 'required',
            // Add other validation rules as needed
        ]);

        // Retrieve the Course based on the course_id
        $course = Course::findOrFail($validatedData['course_id']);

        // Create a new instance of DetailPembayaran
        $order = new DetailPembayaran();
        $order->user_id = $validatedData['user_id'];
        $order->course_id = $validatedData['course_id'];
        $order->no_telepon = $validatedData['no_telepon'];
        $order->status = 'Unpaid';
        $order->save();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->course->harga,
            ),
            'customer_details' => array(
                'course_id' => $validatedData['course_id'],
                'no_telepon' => $validatedData['no_telepon'],
                'user_id' => $validatedData['user_id'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('transaksi.checkout', compact('snapToken', 'order'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = DetailPembayaran::find($request->order_id);
                if ($order) {
                    $order->status = 'Paid';
                    $order->save();
                }
            }
        }
    }

    public function invoice($id)
    {
        $order = DetailPembayaran::findOrFail($id);
        return view('transaksi.invoice', compact('order'));
    }
}
