<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function createTransaction(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $transaction = auth()->user()->transactions()->create([
            'amount' => $course->price,
            'course_id' => $course->id,
            'status' => 'success',
            'midtrans_order_id' => 'TRX-' . time() . '-' . auth()->id(), 
        ]);

        $this->configureMidtrans();

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->midtrans_order_id, 
                'gross_amount' => $course->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $course = Course::find($transaction->course_id);
        $transaction->user->courses()->save($course);
        return view('payment.index', compact('snapToken', 'course'));
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $transaction = Transaction::where('midtrans_order_id', $request->order_id)->first();

            if ($transaction) {
                if ($request->transaction_status === 'settlement') {
                    $transaction->status = 'success';
                    $transaction->save();

                    if (!$transaction->user->courses->contains($transaction->course_id)) {
                        $transaction->user->courses()->attach($transaction->course_id);
                    }
                }
            }
        }

        return response()->json(['success' => true]);
    }

    private function configureMidtrans()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}