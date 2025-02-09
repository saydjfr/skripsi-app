<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg dark:bg-gray-800 mt-4 mb-4">
  <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">📦 Detail Pesanan</h2>

  <div class="grid grid-cols-2 gap-4">
      <!-- Info Pesanan -->
      <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
          <p class="text-sm text-gray-600 dark:text-gray-400">Nomor Pesanan</p>
          <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
            {{ $produkPesanan->nomor_pesanan}}
          </p>
      </div>

      <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
          <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Pesanan</p>
          <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
              {{$produkPesanan->created_at->locale('id')->translatedFormat('l, d F Y') }}
          </p>
      </div>

      <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
          <p class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran</p>
          <p class="text-lg font-bold text-green-600 dark:text-green-400">
              Rp {{ number_format($produkPesanan->grand_total, 0, ',', '.') }}
          </p>
      </div>

      <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
          <p class="text-sm text-gray-600 dark:text-gray-400">Metode Pembayaran</p>
          <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
            {{ $produkPesanan->payment_methode }}
          </p>
      </div>
  </div>

  <!-- Status Pesanan -->
  <div class="mt-6 text-center">
      <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 ">Status Pesanan</p>
      <span class="px-4 py-2 text-lg font-medium rounded-full
          @if($produkPesanan->status == 'new') bg-yellow-100 text-yellow-800
          @elseif($produkPesanan->status == 'processing') bg-green-100 text-green-800
          @elseif($produkPesanan->status == 'completed') bg-red-100 text-red-800
          @endif">
          {{ ucfirst($produkPesanan->status) }}
      </span>
  </div>

  <!-- Daftar Produk yang Dipesan -->
  <div class="mt-8">
      <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">🛒 Produk yang Dipesan</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- {{$produkPesanan->items}} --}}
          @foreach($produkPesanan->items as $item)
              <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md">
                  <img src="{{url('storage',$item->product->image[0])}}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg object-cover">
                  <div class="ml-4">
                      <p class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ $item->product->name }}</p>
                      <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Produk : {{ $item->quantity }}</p>
                      <p class="text-lg font-bold text-green-600 dark:text-green-400">
                          Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                      </p>
                  </div>
              </div>
          @endforeach
      </div>
  </div>

  <!-- Tombol Kembali -->
  <div class="mt-6 text-center">
      <a 
      href="/myorders" 
      class="px-5 py-2 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
          🔙 Kembali ke Daftar Pesanan
      </a>
  </div>
</div>
