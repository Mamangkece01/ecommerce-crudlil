<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[32px] shadow-2xl p-8 border border-slate-200">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Pesanan Berhasil!</h1>
                <p class="text-slate-500 mb-8">Terima kasih. Pesanan Anda berhasil dicatat dan sedang diproses.</p>

                @php
                    $paymentMethods = [
                        'qris' => [
                            'title' => 'QRIS',
                            'description' => 'Bayar cepat dengan scan QR di aplikasi e-wallet atau mobile banking.',
                            'details' => 'Gunakan fitur "Scan QR" di aplikasi Anda dan pastikan nominal sesuai total.'
                        ],
                        'bca' => [
                            'title' => 'Bank BCA',
                            'description' => 'Transfer ke rekening BCA resmi kami.',
                            'details' => 'Nomor Rekening: 123-456-7890 a/n Toko Musik Bro'
                        ],
                        'mandiri' => [
                            'title' => 'Bank Mandiri',
                            'description' => 'Bayar melalui Mandiri online banking atau transfer manual.',
                            'details' => 'Nomor Rekening: 987-654-3210 a/n Toko Musik Bro'
                        ],
                        'bni' => [
                            'title' => 'Bank BNI',
                            'description' => 'Bayar lewat BNI Virtual Account atau transfer biasa.',
                            'details' => 'Nomor Rekening: 112-233-4455 a/n Toko Musik Bro'
                        ],
                    ];
                    $selected = $paymentMethods[$method] ?? null;
                @endphp

                <div class="bg-slate-50 rounded-3xl p-6 mb-8 border border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-indigo-600 font-semibold">Metode Pembayaran</p>
                            <h2 class="text-2xl font-bold text-slate-900 mt-2">{{ $selected['title'] ?? 'Metode Terpilih' }}</h2>
                        </div>
                        @if($orderTotal)
                            <div class="rounded-3xl bg-white px-5 py-4 shadow-sm border border-slate-200 text-slate-800">
                                <p class="text-xs text-slate-500 uppercase">Total Pembayaran</p>
                                <p class="mt-2 text-xl font-semibold">Rp {{ number_format($orderTotal, 0, ',', '.') }}</p>
                            </div>
                        @endif
                    </div>

                    <p class="mt-4 text-slate-600">{{ $selected['description'] ?? 'Ikuti instruksi pembayaran di bawah ini.' }}</p>

                    <div class="mt-6 rounded-3xl bg-white p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Instruksi Pembayaran</h3>
                        <p class="mt-3 text-slate-700 leading-7">{{ $selected['details'] ?? 'Silakan gunakan metode pembayaran yang Anda pilih pada halaman checkout.' }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('orders.index') }}" class="block text-center bg-indigo-600 text-white px-8 py-4 rounded-2xl font-semibold hover:bg-indigo-700 transition shadow-md">
                        Lihat Riwayat Pesanan
                    </a>
                    <a href="{{ route('shop.index') }}" class="block text-center bg-slate-100 text-slate-800 px-8 py-4 rounded-2xl font-semibold hover:bg-slate-200 transition border border-slate-200">
                        Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
