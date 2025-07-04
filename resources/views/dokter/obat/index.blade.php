<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-4">
                 <h3 class="text-lg font-semibold text-gray-900">Daftar Obat</h3>
                <div class="flex gap-2">
                    <a href="{{ route('dokter.obat.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Obat
                    </a>

                    <a href="{{ route('dokter.obat.trash') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 012 2v0a2 2 0 01-2 2H7a2 2 0 01-2-2v0a2 2 0 012-2h10z"/>
                        </svg>
                        Obat Terhapus
                    </a>
                </div>
            </div>
                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="relative p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-green-800 hover:text-green-900">
                            &times;
                        </button>
                    </div>
                @endif

                @if (session('danger'))
                    <div class="relative p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        {{ session('danger') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-red-800 hover:text-red-900">
                            &times;
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="relative p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-red-800 hover:text-red-900">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 table-auto">
                        <thead class="text-xs text-white uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Obat</th>
                                <th class="px-4 py-3">Kemasan</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $index => $obat)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $obat->nama_obat }}</td>
                                    <td class="px-4 py-2">{{ $obat->kemasan }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('dokter.obat.edit', $obat->id) }}"
                                           class="inline-block px-3 py-1 text-xs font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('dokter.obat.destroy', $obat->id) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus obat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                        Tidak ada data obat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
