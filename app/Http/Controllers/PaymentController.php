<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function checkPaymentStatus($orderId)
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);

            // Update status transaksi di database
            $transaction = Transaksi::where('id_pendaftar', $orderId)->first();
            $transaction->status = 'ora pending';
            $transaction->save();

            return response()->json($transaction);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleMidtransCallback(Request $request)
    {
        $notification = new \Midtrans\Notification();
        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        $transaction = Transaksi::where('order_id', $orderId)->first();

        if ($transaction) {
            if ($transaction == 'capture' || $transaction == 'settlement') {
                $transaction->status = 'success';
            } else if ($transaction == 'pending') {
                $transaction->status = 'pending';
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $transaction->status = 'failed';
            }
            $transaction->save();
        }

        return response()->json(['status' => 'success']);
    }
}
