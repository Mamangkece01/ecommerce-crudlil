<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'payment_method' => 'required|in:qris,bca,mandiri,bni',
        ]);

        $cart = session()->get('cart');
        if (!$cart) return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $details) {
                $total += $details['price'] * $details['quantity'];
            }

            // Simpan Order Utama
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'address' => $request->address,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
            ]);

            // Simpan Detail & Kurangi Stok
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                $product = Product::find($id);
                if ($product) {
                    $product->decrement('stock', $details['quantity']);
                }
            }

            DB::commit();
            session()->forget('cart');
            session()->flash('payment_method', $request->payment_method);
            session()->flash('order_total', $total);

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success()
    {
        $method = session('payment_method');
        if (!$method) {
            return redirect()->route('shop.index');
        }

        return view('checkout.success', [
            'method' => $method,
            'orderTotal' => session('order_total'),
        ]);
    }
}
