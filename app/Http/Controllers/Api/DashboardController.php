<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats()
    {
        $totalRevenue = Transaction::where('status', 'paid')->sum('total_amount');
        $totalOrders  = Transaction::where('status', 'paid')->count();
        $totalProducts = Product::where('is_active', true)->count();
        $lowStock     = Product::where('stock', '<=', 10)->count();

        $topProducts = DB::table('transaction_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(subtotal) as total_revenue'))
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        $recentTransactions = Transaction::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'total_revenue'       => $totalRevenue,
                'total_orders'        => $totalOrders,
                'total_products'      => $totalProducts,
                'low_stock_products'  => $lowStock,
                'top_products'        => $topProducts,
                'recent_transactions' => $recentTransactions,
            ],
        ]);
    }
}
