<div class="z-0">
  {{-- hero section start --}}
  <div
  class="hero min-h-screen"
  style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
  <div class="hero-overlay bg-opacity-80"></div>
  <div class="hero-content text-neutral-content text-center">
    <div class="max-w-md">
      <h1 class=" static mb-5 text-5xl font-bold">E-canteen</h1>
      <p class=" static mb-5">
        Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
        quasi. In deleniti eaque aut repudiandae et a id nisi.
      </p>
      <a href="{{route('login')}}" class="btn btn-primary" wire:navigate>Get Started</a>
    </div>
  </div>
</div>
  {{-- hero section end --}}
  {{-- brand section start --}}
  <div class="bg-orange-200 py-20">
    <div class="max-w-xl mx-auto">
      <div class="text-center ">
        <div class="relative flex flex-col items-center">
          <h1 class="text-5xl font-bold dark:text-gray-200"> Ada <span class="text-blue-500"> Apa Aja ?
            </span> </h1>
          <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
            <div class="flex-1 h-2 bg-blue-200">
            </div>
            <div class="flex-1 h-2 bg-blue-400">
            </div>
            <div class="flex-1 h-2 bg-blue-600">
            </div>
          </div>
        </div>
        <p class="mb-12 text-base text-center text-gray-500">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus magni eius eaque?
          Pariatur
          numquam, odio quod nobis ipsum ex cupiditate?
        </p>
      </div>
    </div>
  
    <div class="max-w-full px-4 sm:px-6 lg:px-8 mx-auto ">
      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
        
        @foreach ($categories as $category)
        <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_categories[0]={{$category->id}}" wire:key="{{$category->id}}">
          <div class="p-4 md:p-5">
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <img class="h-[2.375rem] w-[2.375rem] rounded-full" src="{{url('storage', $category->image)}}" alt="{{$category->name}}">
                <div class="ms-3">
                  <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
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
  
  </div>
  {{-- brand section end --}}

</div>