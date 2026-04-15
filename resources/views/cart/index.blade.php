<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-900/50 border border-emerald-500 text-emerald-200 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800 overflow-hidden shadow-2xl sm:rounded-2xl p-6 border border-slate-700">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="flex flex-col lg:flex-row gap-8">

                        <div class="w-full lg:w-3/5">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b border-slate-700">
                                            <th class="pb-4 font-semibold text-slate-400">Produk</th>
                                            <th class="pb-4 font-semibold text-slate-400">Harga</th>
                                            <th class="pb-4 font-semibold text-slate-400 text-center">Jumlah</th>
                                            <th class="pb-4 font-semibold text-slate-400 text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        @php $total = 0; @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity']; @endphp
                                            <tr class="hover:bg-slate-700/30 transition">
                                                <td class="py-4 flex items-center">
                                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-16 h-16 object-cover rounded-lg mr-4 border border-slate-600 shadow-inner">
                                                    <div>
                                                        <span class="block font-bold text-slate-100">{{ $details['name'] }}</span>
                                                        <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $id }}">
                                                            <button type="submit" class="text-xs text-red-400 hover:text-red-300 hover:underline mt-1">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="py-4 text-slate-300 text-sm">
                                                    Rp {{ number_format($details['price'], 0, ',', '.') }}
                                                </td>
                                                <td class="py-4 text-center text-slate-300 font-mono">
                                                    {{ $details['quantity'] }}
                                                </td>
                                                <td class="py-4 text-right font-bold text-indigo-400">
                                                    Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="w-full lg:w-2/5">
                            <div class="bg-slate-900 p-6 rounded-2xl border border-slate-700 shadow-xl">
                                <h3 class="text-lg font-bold text-slate-100 mb-6 border-b border-slate-700 pb-2 uppercase tracking-tight">Ringkasan Pesanan</h3>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-slate-400">
                                        <span>Subtotal</span>
                                        <span class="font-semibold text-slate-200">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between pt-4 border-t border-slate-700">
                                        <span class="text-xl font-extrabold text-slate-100">Total</span>
                                        <span class="text-xl font-extrabold text-indigo-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                                    @csrf

                                    <div class="space-y-4">
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Informasi Pengiriman</p>

                                        <div>
                                            <label class="block text-xs text-slate-400 mb-1">Nama Lengkap</label>
                                            <input type="text" name="name" required
                                                class="w-full rounded-xl bg-slate-800 border-slate-700 text-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder-slate-600"
                                                placeholder="Nama penerima...">
                                        </div>

                                        <div>
                                            <label class="block text-xs text-slate-400 mb-1">Alamat Email</label>
                                            <input type="email" name="email" required
                                                class="w-full rounded-xl bg-slate-800 border-slate-700 text-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder-slate-600"
                                                placeholder="email@example.com">
                                        </div>

                                        <div>
                                            <label class="block text-xs text-slate-400 mb-1">Alamat Lengkap</label>
                                            <textarea name="address" rows="3" required
                                                class="w-full rounded-xl bg-slate-800 border-slate-700 text-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder-slate-600"
                                                placeholder="Nama jalan, nomor rumah, kec, kota..."></textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Metode Pembayaran</p>
                                        <div class="grid grid-cols-1 gap-3">
                                            <label class="group cursor-pointer rounded-xl border border-slate-700 p-3 flex items-center gap-4 hover:border-indigo-500 bg-slate-800 transition">
                                                <input type="radio" name="payment_method" value="qris" checked class="sr-only peer" />
                                                <div class="w-10 h-10 rounded-lg bg-slate-700 text-indigo-400 flex items-center justify-center text-xs font-bold border border-slate-600 peer-checked:bg-indigo-600 peer-checked:text-white transition-all">QR</div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-slate-100 text-sm">QRIS</div>
                                                    <p class="text-[10px] text-slate-500">OVO, GoPay, ShopeePay</p>
                                                </div>
                                            </label>

                                            <label class="group cursor-pointer rounded-xl border border-slate-700 p-3 flex items-center gap-4 hover:border-indigo-500 bg-slate-800 transition">
                                                <input type="radio" name="payment_method" value="bca" class="sr-only peer" />
                                                <div class="w-10 h-10 rounded-lg bg-slate-700 text-blue-400 flex items-center justify-center text-xs font-bold border border-slate-600 peer-checked:bg-blue-600 peer-checked:text-white transition-all">BCA</div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-slate-100 text-sm">Bank BCA</div>
                                                    <p class="text-[10px] text-slate-500">Transfer Manual / VA</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg flex items-center justify-center gap-2 group">
                                        <span>Konfirmasi Pembayaran</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="text-center py-24">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-900 border border-slate-700 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-100">Keranjang Masih Kosong</h3>
                        <p class="text-slate-500 mt-2 mb-8">Sepertinya Anda belum memilih produk apapun.</p>
                        <a href="{{ route('shop.index') }}" class="inline-block bg-indigo-600 text-white px-10 py-3 rounded-xl hover:bg-indigo-500 transition shadow-lg shadow-indigo-900/20">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
