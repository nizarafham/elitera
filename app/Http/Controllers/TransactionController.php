<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function createTransaction(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        // Simpan transaksi dengan status 'pending'
        $transaction = auth()->user()->transactions()->create([
            'amount' => $course->price,
            'course_id' => $course->id,
            'status' => 'pending', // Status awal
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id, // Gunakan ID transaksi sebagai order_id
                'gross_amount' => $course->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.index', compact('snapToken', 'course'));
    }

    public function handleNotification(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new \Midtrans\Notification();

        $transaction = Transaction::find($notification->order_id);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        switch ($notification->transaction_status) {
            case 'capture':
            case 'settlement':
                $transaction->status = 'success';
                $transaction->save();

                // Tambahkan ke tabel pivot user_courses
                $transaction->user->courses()->attach($transaction->course_id);
                break;

            case 'deny':
            case 'expire':
            case 'cancel':
                $transaction->status = 'failed';
                $transaction->save();
                break;
        }

        return response()->json(['success' => true]);
    }

    public function midtransCallback(Request $request)
    {
        // Ambil server key untuk validasi
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Pastikan callback valid
        if ($hashed === $request->signature_key) {
            // Cek status transaksi
            if ($request->transaction_status === 'settlement') {
                // Ambil transaksi berdasarkan order_id
                $transaction = Transaction::where('id', $request->order_id)->first();

                if ($transaction) {
                    // Update status transaksi menjadi sukses
                    $transaction->status = 'success';
                    $transaction->save();

                    // Tambahkan kursus ke user_courses
                    $transaction->user->courses()->attach($transaction->course_id);
                }
            }
        }
    }

}
