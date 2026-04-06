<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center border border-gray-100">
                <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Pesanan Berhasil!</h1>
                <p class="text-gray-500 mb-8">Terima kasih telah berbelanja. Pesanan Anda sedang kami proses.</p>

                <div class="bg-indigo-50 rounded-2xl p-6 mb-8 text-left">
                    <h3 class="font-bold text-indigo-900 mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Langkah Selanjutnya:
                    </h3>
                    <ul class="text-sm text-indigo-800 space-y-2 list-disc list-inside">
                        <li>Silakan transfer ke rekening **Bank BCA 123-456-7890** a/n **Toko Musik Bro**.</li>
                        <li>Pastikan nominal sesuai dengan total tagihan.</li>
                        <li>Simpan bukti transfer Anda untuk verifikasi manual oleh admin.</li>
                        <li>Status pesanan akan berubah otomatis setelah diverifikasi.</li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('orders.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-md">
                        Lihat Riwayat Pesanan
                    </a>
                    <a href="{{ route('shop.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                        Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>