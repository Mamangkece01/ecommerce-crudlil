<<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="flex flex-col md:flex-row gap-8">
                        
                        <div class="w-full md:w-2/3">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="pb-4 font-semibold text-gray-600">Produk</th>
                                            <th class="pb-4 font-semibold text-gray-600">Harga</th>
                                            <th class="pb-4 font-semibold text-gray-600 text-center">Jumlah</th>
                                            <th class="pb-4 font-semibold text-gray-600 text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity']; @endphp
                                            <tr class="border-b hover:bg-gray-50 transition">
                                                <td class="py-4 flex items-center">
                                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-16 h-16 object-cover rounded-lg mr-4 border">
                                                    <div>
                                                        <span class="block font-bold text-gray-800">{{ $details['name'] }}</span>
                                                        <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $id }}">
                                                            <button type="submit" class="text-xs text-red-500 hover:underline mt-1">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="py-4 text-gray-600 text-sm">
                                                    Rp {{ number_format($details['price'], 0, ',', '.') }}
                                                </td>
                                                <td class="py-4 text-center text-gray-700">
                                                    {{ $details['quantity'] }}
                                                </td>
                                                <td class="py-4 text-right font-bold text-indigo-600">
                                                    Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3">
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Ringkasan Pesanan</h3>
                                
                                <div class="flex justify-between mb-4">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex justify-between mb-6 pt-4 border-t">
                                    <span class="text-xl font-extrabold text-gray-900">Total</span>
                                    <span class="text-xl font-extrabold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>

                                <form action="{{ route('checkout.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-6">
                                        <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Alamat Pengiriman</label>
                                        <textarea 
                                            name="address" 
                                            id="address" 
                                            rows="3" 
                                            required 
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                            placeholder="Masukkan alamat lengkap..."></textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-4 rounded-xl transition duration-300 shadow-lg flex items-center justify-center gap-2">
                                        <span>Konfirmasi Pembayaran</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="text-center py-20">
                        <h3 class="text-2xl font-bold text-gray-800">Keranjang Masih Kosong</h3>
                        <a href="{{ route('shop.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-8 py-3 rounded-xl">Mulai Belanja</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>