<div class="navbar bg-base-100 sticky top-0 drop-shadow-md">
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
        <li><a href="/">Home</a></li>
        <li><a href="/categories">Categories</a></li>
        <li><a href="/products">Products</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">E-Canteen</a>
  </div>
  <div class="navbar-end  ">
    {{-- menu starts --}}
    <ul class="menu menu-horizontal px-1 hidden lg:flex">
      <li><a class="active" href="/">Home</a></li>
      <li><a href="/categories">Categories</a></li>
      <li><a href="/products">Products</a></li>
    </ul>
    {{-- menu end --}}
    {{-- chart start--}}
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <div class="indicator mr-3">
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
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span class="badge badge-sm indicator-item">8</span>
        </div>
      </div>
      <div
        tabindex="0"
        class="card card-compact dropdown-content bg-base-100 z-[1] mt-3 w-52 shadow">
        <div class="card-body">
          <span class="text-lg font-bold">8 Items</span>
          <span class="text-info">Subtotal: $999</span>
          <div class="card-actions">
            <a class="btn btn-primary btn-block" href="/cart">View cart</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    {{-- chart end --}}
    <a 
     href="{{ route('login') }}"
    class="btn btn-sm">
    Log-in</a>
  </div>
</div>