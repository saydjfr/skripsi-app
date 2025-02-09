<div class="card shadow-lg p-4 rounded-lg bg-white">
    <h3 class="text-center mb-4 font-bold text-xl text-gray-700">Tambah Alamat</h3>

    @if (session()->has('message'))
        <div class="alert alert-success text-center p-2 rounded bg-green-100 text-green-700">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label for="phone" class="block text-gray-600 font-semibold">Nomor Telepon/Wa</label>
            <input type="text" class="form-input w-full p-2 border rounded focus:ring focus:ring-blue-300"
                id="phone" wire:model="phone">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="alamat" class="block text-gray-600 font-semibold">Alamat</label>
            <input type="text" class="form-input w-full p-2 border rounded focus:ring focus:ring-blue-300"
                id="alamat" wire:model="alamat">
            @error('alamat')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit"
            class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-200">Simpan</button>
    </form>
</div>
