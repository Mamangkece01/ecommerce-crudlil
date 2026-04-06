<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl p-6 border-b-8 border-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Daftar Semua Pengguna</h3>
                        <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Pantau dan kelola akun pelanggan</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg text-xs font-black uppercase hover:bg-gray-300 transition-colors">← Kembali</a>
                </div>

                <div class="overflow-x-auto rounded-lg border-2 border-gray-200">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-4 font-black text-xs uppercase text-gray-600">Nama</th>
                                <th class="p-4 font-black text-xs uppercase text-gray-600">Email</th>
                                <th class="p-4 font-black text-xs uppercase text-gray-600 text-center">Role</th>
                                <th class="p-4 font-black text-xs uppercase text-gray-600">Terdaftar</th>
                                <th class="p-4 font-black text-xs uppercase text-gray-600 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($users as $u)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <p class="font-black text-gray-900">{{ $u->name }}</p>
                                </td>
                                <td class="p-4">
                                    <p class="text-gray-600 text-sm font-medium">{{ $u->email }}</p>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded {{ $u->role === 'admin' ? 'bg-red-100 text-red-800 border-red-200' : 'bg-green-100 text-green-800 border-green-200' }} border-2">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <p class="text-gray-500 text-xs font-bold">{{ $u->created_at->format('d M Y') }}</p>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('admin.users.orders', $u->id) }}" class="inline-flex items-center gap-1 bg-gray-900 text-white px-3 py-1 rounded text-[10px] font-black uppercase hover:bg-black transition-colors shadow-[2px_2px_0px_0px_rgba(0,0,0,0.2)]">
                                        Lihat Pesanan
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400 font-bold uppercase tracking-widest">Belum ada pengguna terdaftar</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
