<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Menampilkan daftar seluruh pengguna
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan riwayat pesanan (orders) dari satu user spesifik
    public function orders(User $user)
    {
        $orders = Order::with('items.product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('admin.users.orders', compact('user', 'orders'));
    }
}
