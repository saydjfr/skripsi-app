<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Daftar Alamat</h2>

    @if ($addresses->isEmpty())
        <p class="text-gray-500">Belum ada alamat yang ditambahkan.</p>
    @else
        <ul class="space-y-2">
            @foreach ($addresses as $address)
                <li class="flex items-start p-4 border border-gray-200 rounded-lg bg-gray-50">
                    {{-- <div class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full">
                        📞
                    </div> --}}
                    <div class="ml-3">
                        <p class="text-sm text-gray-600"><strong>Telepon:</strong> {{ $address->phone }}</p>
                        <p class="text-sm text-gray-800"><strong>Alamat:</strong> {{ $address->alamat }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4">
        <a href="/tambahaddres"
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 inline-block text-center">Tambah
            Alamat</a>
    </div>
</div>
