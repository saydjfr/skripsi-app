<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Riwayat Belanja</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nomor
                                    Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    Pembayaran</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total Harga
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($myorders as $myorder)
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $myorder->nomor_pesanan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $myorder->created_at->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <span
                                            class="bg-orange-500 py-1 px-3 rounded text-white shadow">{{ $myorder->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <span
                                            class="bg-green-500 py-1 px-3 rounded text-white shadow">{{ $myorder->payment_status }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        Rp {{ number_format($myorder->grand_total, 0, ',', '.') }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex gap-2 justify-end">
                                        @if ($myorder->payment_methode == 'midtrans' && $myorder->payment_status == 'unpaid')
                                            <button type="button"
                                                wire:click="midtrans_payment('{{ $myorder->nomor_pesanan }}')"
                                                class="bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-500">Bayar</button>
                                        @endif
                                        <a href="/myorders/{{ $myorder->nomor_pesanan }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Lihat
                                            Pesanan</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
