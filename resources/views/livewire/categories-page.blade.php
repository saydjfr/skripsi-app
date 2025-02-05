{{-- <div class=" bg-base-200 min-h-screen w-full max-w-full py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">
  
        @foreach ($categories as $category)
          <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_categories[0]={{$category->id}}" wire:key ="{{$category->id}}">
            <div class="p-4 md:p-5">
              <div class="flex justify-between items-center">
                <div class="flex items-center">
                  <img class="h-[5rem] w-[5rem]" src="{{url('storage', $category->image)}}" alt="{{$category->name}}">
                  <div class="ms-3">
                    <h3 class="group-hover:text-blue-600 text-2xl font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                      {{$category->name}}
                    </h3>
                  </div>
                </div>
                <div class="ps-3">
                  <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </div>
              </div>
            </div>
          </a>    
        @endforeach
        
  
      </div>
    </div>
  </div> --}}


  <div class="categories-container bg-gradient-to-b from-blue-50 to-blue-100 min-h-screen flex flex-col items-center py-12">
    <!-- Categories Section -->
    <div class="categories-section text-center w-full max-w-7xl px-6">
      <h2 class="section-title text-3xl font-bold text-gray-800 mb-8">Kategori Produk <span class="text-blue-500">E-Kantin</span></h2>
      <p class="section-subtitle text-lg text-gray-600 mb-12">Temukan berbagai kategori produk yang kami sediakan, mulai dari makanan, minuman, hingga kebutuhan lainnya.</p>
      <div class="categories-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <!-- Category Item -->
      @foreach ($categories as $category)
      <a href="/products?selected_categories[0]={{$category->id}}" wire:key ="{{$category->id}}" class="category-item bg-white shadow-lg rounded-xl p-6 text-center transform hover:scale-105 transition duration-300">
        <div class="category-icon mb-4">
          <img src="{{url('storage', $category->image)}}" alt="{{$category->name}}" class="w-16 h-16 mx-auto">
        </div>
        <h3 class="category-title text-xl font-semibold text-gray-800 mb-2"> {{$category->name}}</h3>
        {{-- <p class="category-description text-gray-600">Berbagai pilihan makanan lezat siap dinikmati.</p> --}}
      </a>
      @endforeach
      </div>
    </div>
  </div>
  
