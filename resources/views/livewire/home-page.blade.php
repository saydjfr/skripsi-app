<div class="home-container bg-gradient-to-b from-blue-50 to-blue-100 min-h-screen flex flex-col items-center justify-center">
  <!-- Hero Section -->
  <div class="hero-section text-center py-20 px-6 bg-white shadow-xl rounded-3xl w-full max-w-6xl mt-6">
    <h1 class="hero-title text-5xl font-extrabold text-gray-800 mb-6">Selamat Datang di <span class="text-blue-500">E-Kantin</span></h1>
    <p class="hero-subtitle text-lg text-center italic text-gray-600 mb-8">
     <b> E-Kantin</b> adalah solusi modern yang mengubah cara Anda berbelanja di kantin. Dengan platform kami, Anda dapat memesan makanan dan minuman favorit dengan mudah, cepat, dan tanpa antre. Nikmati pengalaman belanja yang nyaman dengan antarmuka yang ramah pengguna, transaksi yang aman, dan pelayanan terpercaya. E-Kantin hadir untuk memenuhi kebutuhan Anda dengan teknologi terkini, memberikan Anda lebih banyak waktu untuk fokus pada hal-hal penting lainnya.

Apakah Anda siap untuk merasakan kemudahan dan kecepatan yang ditawarkan oleh E-Kantin? Bergabunglah sekarang dan rasakan pengalaman belanja yang benar-benar berbeda!
    </p>
    <a href="/products" class=" btn hero-button bg-blue-500 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">Mulai Belanja</a>
    <div class="hero-image w-full mt-10">
      <img src="{{asset('image/HeroIcon.jpg')}}" alt="E-Kantin Hero" class="mx-auto w-full max-w-xl rounded-xl shadow-md">
    </div>
  </div>

  <!-- Features Section -->
  <div class="features-section text-center mt-16 px-6 w-full max-w-7xl mb-10">
    <h2 class="section-title text-3xl font-bold text-gray-800 mb-10">Mengapa Memilih <span class="text-blue-500">E-Kantin?</span></h2>
    <div class="features-list grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="feature-item bg-white shadow-lg rounded-2xl p-8 transform hover:scale-105 transition duration-300">
        <div class="feature-icon mb-6">
          <img src="{{asset('image/quick-response.png')}}" alt="Cepat" class="w-16 h-16 mx-auto">
        </div>
        <h3 class="feature-title text-xl font-bold text-gray-800 mb-4">Cepat</h3>
        <p class="feature-description text-gray-600">Pesan makanan dan minuman hanya dengan beberapa klik. Tidak perlu antre!</p>
      </div>
      <div class="feature-item bg-white shadow-lg rounded-2xl p-8 transform hover:scale-105 transition duration-300">
        <div class="feature-icon mb-6">
          <img src="{{asset('image/cargo.png')}}" alt="Mudah" class="w-16 h-16 mx-auto">
        </div>
        <h3 class="feature-title text-xl font-bold text-gray-800 mb-4">Mudah</h3>
        <p class="feature-description text-gray-600">Antarmuka yang ramah pengguna untuk kemudahan Anda. Semua bisa diakses dengan mudah.</p>
      </div>
      <div class="feature-item bg-white shadow-lg rounded-2xl p-8 transform hover:scale-105 transition duration-300">
        <div class="feature-icon mb-6">
          <img src="{{asset('image/badge.png')}}" alt="Aman" class="w-16 h-16 mx-auto">
        </div>
        <h3 class="feature-title text-xl font-bold text-gray-800 mb-4">Aman</h3>
        <p class="feature-description text-gray-600">Transaksi aman dan terpercaya. Data Anda dijamin kerahasiaannya.</p>
      </div>
    </div>
  </div>

  <!-- Call to Action Section -->
  @guest
  <div class="cta-section text-center mt-16 bg-blue-500 text-white py-12 px-6 rounded-3xl w-full max-w-5xl shadow-xl mb-10">
    <h2 class="cta-title text-3xl font-bold mb-6">Siap Mencoba <span class="text-yellow-300">E-Kantin?</span></h2>
    <p class="cta-description text-lg mb-8">Daftar sekarang dan nikmati kemudahan layanan kami. Rasakan pengalaman belanja yang berbeda.</p>
    <a href="/register" class="cta-button bg-yellow-300 text-blue-800 font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-yellow-400 transition duration-300">Daftar Sekarang</a>
  </div>
  @endguest

</div>
