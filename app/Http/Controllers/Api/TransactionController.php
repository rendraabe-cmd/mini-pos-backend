<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'items'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'                 => 'required|array|min:1',
            'items.*.product_id'    => 'required|exists:products,id',
            'items.*.quantity'      => 'required|integer|min:1',
            'payment_amount'        => 'required|numeric|min:0',
            'payment_method'        => 'required|in:cash,qris',
        ]);

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $itemsData   = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok produk {$product->name} tidak mencukupi.",
                    ], 422);
                }

                $subtotal      = $product->price * $item['quantity'];
                $totalAmount  += $subtotal;

                $itemsData[] = [
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'price'        => $product->price,
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $subtotal,
                ];

                // Kurangi stok
                $product->decrement('stock', $item['quantity']);
            }

            if ($request->payment_amount < $totalAmount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah pembayaran kurang.',
                ], 422);
            }

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(uniqid()),
                'user_id'        => $request->user()->id,
                'total_amount'   => $totalAmount,
                'payment_amount' => $request->payment_amount,
                'change_amount'  => $request->payment_amount - $totalAmount,
                'payment_method' => $request->payment_method,
                'status'         => 'paid',
            ]);

            $transaction->items()->createMany($itemsData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil.',
                'data'    => $transaction->load('items'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show(Transaction $transaction)
    {
        return response()->json([
            'success' => true,
            'data'    => $transaction->load(['user', 'items']),
        ]);
    }
}
