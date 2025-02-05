<div id="order-status" class=" mt-[80px] bg-gray-50 min-h-screen flex flex-wrap gap-6 items-stretch justify-center px-4 py-8">
    <!-- Status Pesanan -->
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 flex flex-col">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 text-center">Status Pesanan</h1>
        <p class="text-sm text-gray-600 text-center mt-2">
            Nomor Pesanan: <span class="font-medium text-blue-500">{{$pesanan->nomor_pesanan}}</span>
        </p>

        <!-- Status List -->
        <div class="mt-6 space-y-6">
            <!-- Step 1 -->
            <div class="flex items-start">
                @if ($pesanan->status=='new')
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold">1</div>
                <div class="ml-4">
                    <p class="text-base font-bold text-gray-800">Sedang Diproses</p>
                </div>
                @else
                <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold">1</div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-200">Sedang Diproses</p>
                </div>
                @endif
            </div>

            <!-- Step 2 -->
            <div class="flex items-start">
                @if ($pesanan->status=='processing')
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold">2</div>
                <div class="ml-4">
                    <p class="text-base font-bold text-gray-800">Sedang Diproses</p>
                </div>
                @else
                <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold">2</div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-200">Sedang Diproses</p>
                </div>
                @endif
               
            </div>

            <!-- Step 3 -->
            <div class="flex items-start">
                @if ($pesanan->status=='completed')
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold">3</div>
                <div class="ml-4">
                    <p class="text-base font-bold text-gray-800">Selesai Dibuat</p>
                    <p class="text-base font-bold text-gray-800">Pihak Toko Akan Segera Menghubungi Anda</p>
                </div>
                @else
                <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold">3</div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-200">Selesai Dibuat</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Pesanan -->
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 flex flex-col">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Detail Pesanan</h2>
        <p class="text-sm text-gray-600 text-center mt-2">
            Nomor Pesanan: <span class="font-medium text-blue-500">{{$pesanan->nomor_pesanan}}</span>
        </p>

        <!-- Detail Item -->
        <div class="mt-6 space-y-4">
            <div class="flex justify-between">
                <p class="text-base font-medium text-gray-800">Nama Barang</p>
                <p class="text-base font-medium text-gray-600">
                    @foreach ($pesanan->items as $item)
                        {{$item->product->name}}
                    @endforeach
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-base font-medium text-gray-800">Jumlah</p>
                <p class="text-base font-medium text-gray-600">
                    @foreach ($pesanan->items as $item)
                        {{$item->quantity}}
                    @endforeach
                </p>
            </div>
            <div class="flex justify-between">
                <p class="text-base font-medium text-gray-800">Harga</p>
                <p class="text-base font-medium text-gray-600">
                    @foreach ($pesanan->items as $item)
                    {{Number::currency($item->unit_amount,'IDR')}}
                    @endforeach
            </p>
            </div>
            <div class="flex justify-between">
                <p class="text-base font-medium text-gray-800">Total</p>
                <p class="text-base font-medium text-gray-600">
                   {{Number::currency($pesanan->grand_total,'IDR')}}
                </p>
            </div>
        </div>

        <!-- Informasi Pengiriman -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Pemesanan</h3>
            <p class="text-sm text-gray-600 mt-1">Nama Pemesan : {{$pesanan->nama_customer}}</p>
            <p class="text-sm text-gray-600">Tanggal Pemesanan : {{\Carbon\Carbon::parse($pesanan->created_at)->format('d-M-Y')}}</p>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <a href="/checkorder" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg font-medium hover:bg-gray-400 transition">
                Kembali 
            </a>
        </div>
    </div>
</div>


