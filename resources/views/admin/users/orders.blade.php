<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl p-6 border-b-8 border-gray-900 mb-8">
                <div class="flex justify-between items-start mb-6 border-b-2 border-gray-100 pb-6">
                    <div class="flex items-center gap-4">
                        <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center text-3xl shadow-inner border-2 border-gray-200">
                            👤
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tight">{{ $user->name }}</h3>
                            <p class="text-gray-500 font-bold">{{ $user->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-gray-200 text-gray-800 text-[10px] uppercase font-black rounded border-2 border-gray-300">
                                Anggota sejak {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg text-xs font-black uppercase hover:bg-gray-300 transition-colors">
                        ← Kembali ke Daftar
                    </a>
                </div>

                <h4 class="text-xl font-black text-gray-800 uppercase mb-4 flex items-center gap-2">
                    <span class="w-3 h-3 bg-gray-900 inline-block"></span> Riwayat Pembelian
                </h4>

                @forelse($orders as $order)
                <div class="bg-gray-50 rounded-xl border-2 border-gray-200 p-6 mb-6">
                    <div class="flex justify-between flex-wrap gap-4 border-b-2 border-gray-200 pb-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Order ID</p>
                            <p class="font-black text-gray-900 uppercase">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Tanggal</p>
                            <p class="font-black text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Status</p>
                            <span class="inline-block mt-1 px-3 py-1 text-[10px] font-black uppercase border-2 {{ $order->status == 'PENDING' ? 'border-yellow-400 bg-yellow-100 text-yellow-800' : 'border-green-400 bg-green-100 text-green-800' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="text-right border-l-2 border-gray-200 pl-4">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Total Belanja</p>
                            <p class="text-2xl font-black text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Item yang dibeli:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-4 bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                @if($item->product && $item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-400 border border-gray-300">No Img</div>
                                @endif
                                
                                <div class="flex-1">
                                    <p class="font-black text-gray-800 line-clamp-1">{{ $item->product ? $item->product->name : 'Produk Telah Dihapus' }}</p>
                                    <div class="flex justify-between mt-1">
                                        <p class="text-sm font-medium text-gray-500">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        <p class="font-black text-gray-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <div class="text-4xl mb-3">🛒</div>
                    <p class="font-bold text-gray-500 uppercase tracking-widest">Pengguna ini belum pernah melakukan pembelian.</p>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
