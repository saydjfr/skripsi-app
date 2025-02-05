<!-- Products Page Section -->
  <div class="products-page-container bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- Filters Section -->
      <div class="filters-section bg-white p-8 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Filter Produk</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Kategori Filter -->
          <div class="filter-group" >
            <label for="selected_categories" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select wire:model.live="selected_categories" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
              <option value="">Semua Kategori</option>
              @foreach ($categories as $category)
              {{-- <option wire:key="{{$category->id}}" wire:model.live="selected_categories" id="{{$category->slug}}" value="{{$category->id}}">{{$category->name}}</option> --}}
              <option wire:key="{{$category->id}}" id="{{$category->slug}}" value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div>
  
          <!-- Toko Filter -->
          <div class="filter-group">
            <label for="store" class="block text-sm font-medium text-gray-700 mb-2">Toko</label>
            <select wire:model.live="selected_shops"  id="store" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
              <option value="">Semua Toko</option>
              @foreach ($shops as $shop)
              <option wire:key="{{$shop->id}}" id="{{$shop->slug}}" value="{{$shop->id}}">{{$shop->name}}</option>
              @endforeach
            </select>
          </div>
  
  
          <!-- Urutkan Berdasarkan -->
          <div class="filter-group">
            <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Urutkan Berdasarkan</label>
            <select  wire:model.live ="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
              <option value="latest">Terlama</option>
              <option value="price">Harga</option>
            </select>
          </div>
        </div>
      </div>
  
      <!-- Products List Section -->
      <div class="products-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <!-- Product Item -->
        @foreach ($products as $product)
        <div class="product-item bg-white shadow-lg rounded-lg p-6 flex flex-col items-center transition transform hover:scale-105 hover:shadow-xl" wire:key="{{$product->id}}">
          <img src="{{url('storage',$product->image[0])}}" alt="{{$product->name}}" class="w-32 h-32 object-cover rounded-lg mb-4">
          <h3 class="product-title text-lg font-semibold text-gray-800 mb-2 text-center">{{$product->name}}</h3>
          <p class="product-price text-blue-500 font-bold mb-4">{{Number::currency($product->price,'IDR')}}</p>
          <a href="/products/{{$product->slug}}" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition mb-4">Detail</a>
          <a wire:click.prevent='addToCart({{$product->id}})' href="#" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition">
            <span wire:loading.remove wire:target='addToCart({{$product->id}})'>Tambahkan</span>
            <span wire:loading wire:target='addToCart({{$product->id}})'>menambahkan...</span>
          </a>
        </div>
        @endforeach
      </div>
  
      <!-- Pagination Section -->
      <div class="pagination-section mt-8 flex justify-center items-center space-x-2">
        {{$products->links()}}
      </div>
    </div>
  </div>
  