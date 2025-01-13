<div class="navbar bg-base-100 fixed top-0 z-[500] drop-shadow-md">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        <li><a wire:navigate class="{{ request()->is('/')?'active':'disactive'}}" href="/">Home</a></li>
        <li><a wire:navigate class="{{ request()->is('categories')?'active':'disactive'}}" href="/categories">Categories</a></li>
        <li><a wire:navigate class="{{ request()->is('products')?'active':'disactive'}}" href="/products">Products</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">E-Canteen</a>
  </div>
  <div class="navbar-end  ">
    {{-- menu starts --}}
    <ul class="menu menu-horizontal px-4 hidden lg:flex">
      <li><a wire:navigate class="{{ request()->is('/')?'active':'disactive'}}" href="/">Home</a></li>
      <li><a wire:navigate class="{{ request()->is('categories')?'active':'disactive'}}" href="/categories">Categories</a></li>
      <li><a wire:navigate class="{{ request()->is('products')?'active':'disactive'}}" href="/products">Products</a></li>
      <li> 
        <a wire:navigate class="{{ request()->is('cart')?'active':'disactive'}} flex items-center px-0" href="/cart">
            <div class="indicator">
              <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="flex-shrink-0 w-5 h-5 mr-1">
              <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
              <span class="badge badge-xs badge-primary indicator-item">{{$total_count}}</span>
            </div>
      </a>
    </li>
    </ul>
    {{-- menu end --}}
  </div>
  
    <a 
      wire:navigate
      href="/admin/login"
    class="btn btn-sm">
    Log-in</a>
  </div>
</div>