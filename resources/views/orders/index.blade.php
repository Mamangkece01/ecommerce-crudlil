<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase italic tracking-tighter">
            {{ __('Riwayat Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1493238792000-8113da705763?w=1920&h=1080&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid gap-6">
                @forelse($orders as $order)
                <div class="bg-indigo-900 border-4 border-indigo-950 shadow-[8px_8px_0px_0px_rgba(0,0,0,0.5)] p-6 flex flex-col md:flex-row justify-between items-center transition-transform hover:translate-x-1 text-white">
                    
                    <div class="mb-4 md:mb-0">
                        <p class="text-[10px] font-black uppercase text-indigo-300">Order ID</p>
                        <h3 class="text-xl font-black">#Mobil-{{ $order->id }}</h3>
                        <p class="text-xs font-bold text-indigo-200 uppercase">{{ $order->created_at->format('d M Y - H:i') }}</p>
                    </div>

                    <div class="text-center md:text-right border-t-2 md:border-t-0 md:border-l-2 border-indigo-700 pt-4 md:pt-0 md:pl-8">
                        <p class="text-[10px] font-black uppercase text-indigo-300">Total Pembayaran</p>
                        <p class="text-2xl font-black text-indigo-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        
                        <div class="mt-2">
                            <span class="px-4 py-1 text-[10px] font-black uppercase border-2 border-indigo-950
                                {{ $order->status == 'pending' ? 'bg-yellow-500 text-indigo-950' : ($order->status == 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white') }}">
                                {{ $order->status == 'pending' ? ' Menunggu Konfirmasi' : ($order->status == 'success' ? ' Pesanan Diproses' : ' Dibatalkan') }}
                            </span>
                        </div>
                    </div>

                </div>
                @empty
                <div class="bg-indigo-900/80 border-4 border-dashed border-indigo-700 p-20 text-center rounded-2xl">
                    <p class="text-indigo-200 font-black uppercase tracking-widest text-xl italic">Belum ada riwayat belanja.</p>
                    <a href="{{ route('shop.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-8 py-3 font-black uppercase hover:bg-indigo-500 transition-colors rounded-xl">
                        Mulai Belanja →
                    </a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>