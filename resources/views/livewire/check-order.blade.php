<div id="tracking-container" class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 text-center">Lacak Pesanan</h1>
        <p class="text-gray-600 text-center mt-2 mb-6">
            Masukkan nomor pesanan Anda untuk memeriksa status.
        </p>

        <!-- Form Pelacakan -->
        <form id="trackingForm" class="flex gap-2" wire:submit.prevent="cekPesanan">
            <input
                wire:model="nomor_pesanan"
                type="text"
                id="orderNumber"
                placeholder="Nomor Pesanan"
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            />
            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all"
            >
                Lacak
            </button>
        </form>

        <!-- Status Pesanan -->
      
</div>

{{-- <script>
    function handleTracking(event) {
        event.preventDefault(); // Prevent form submission
        const orderNumber = document.getElementById('orderNumber').value.trim();
        const statusContainer = document.getElementById('statusContainer');

        if (orderNumber) {
            // Tampilkan status pesanan
            statusContainer.classList.remove('hidden');
        } else {
            // Sembunyikan status jika nomor pesanan kosong
            statusContainer.classList.add('hidden');
        }
    }
</script> --}}
