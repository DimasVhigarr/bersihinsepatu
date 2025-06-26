<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Bersihin.Sepatu - Pelatihan Video
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Inter', sans-serif;
        }
        /* Anti screen recording overlay */
        video::-webkit-media-controls {
            display:none !important;
        }
        video::-webkit-media-controls-enclosure {
            display:none !important;
        }
        video::-webkit-media-controls-panel {
            display:none !important;
        }
        /* Disable right click on video */
        video {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            pointer-events: auto;
        }
  </style>
 </head>
 <body class="bg-gray-50 min-h-screen flex flex-col">
  <!-- Navbar -->
<nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <a class="flex items-center space-x-2" href="/">
        <img alt="Logo Bersihin.Sepatu" class="h-10 w-10" src="{{ asset('images/logo.jpg') }}" />
        <span class="font-semibold text-xl text-indigo-700">Bersihin.Sepatu</span>
      </a>

      <div class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/tentangkami') }}">Tentang Kami</a>
        <a href="{{ url('/pelatihan') }}">Pelatihan</a>
        <a href="{{ url('/berlangganan') }}">Berlangganan</a>
      </div>

      @auth
      <!-- Dropdown Desktop -->
      <div class="hidden md:flex items-center relative">
        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
          <span class="text-indigo-700 font-semibold mr-2">{{ Auth::user()->name }}</span>
          <img alt="Profile Picture" class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/user.jpg') }}" />
          <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div id="dropdownMenu" class="hidden absolute right-0 mt-12 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
          </form>
        </div>
      </div>
      @else
      <div class="hidden md:flex space-x-4">
        <a class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition" href="{{ route('login') }}">
          Login
        </a>
        <a class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition" href="{{ route('register') }}">
          Daftar
        </a>
      </div>
      @endauth

      <!-- Mobile Menu Button -->
      <button class="md:hidden focus:outline-none focus:ring-2 focus:ring-indigo-600" id="mobile-menu-button">
        <i class="fas fa-bars text-2xl text-indigo-700"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
    <div class="flex flex-col space-y-2 mt-2 text-gray-700">
      <a href="{{ url('/') }}" class="block">Beranda</a>
      <a href="{{ url('/tentangkami') }}" class="block">Tentang Kami</a>
      <a href="{{ url('/pelatihan') }}" class="block">Pelatihan</a>
      <a href="{{ url('/berlangganan') }}" class="block">Berlangganan</a>
      @auth
      <hr class="my-2">
      <form method="POST" action="{{ route('logout') }}" class="block">
        @csrf
        <button type="submit" class="text-left text-red-600 w-full py-1">Logout</button>
      </form>
      @else
      <a href="{{ route('login') }}" class="block">Login</a>
      <a href="{{ route('register') }}" class="block">Daftar</a>
      @endauth
    </div>
  </div>
</nav>
  <!-- Page Header -->
  <header class="bg-indigo-600 text-white py-16 px-6 sm:px-12 md:px-20 text-center max-w-7xl mx-auto rounded-b-lg shadow-lg">
   <h1 class="text-4xl font-extrabold mb-2">
    Detail Pelatihan Bersihin.Sepatu
   </h1>
   <p class="text-indigo-200 text-lg max-w-3xl mx-auto">
    Pelajari teknik pembersihan sepatu profesional dengan materi lengkap dan sertifikat digital.
   </p>
  </header>
  <!-- Training Content -->
  <main class="max-w-7xl mx-auto px-6 sm:px-12 py-12 flex flex-col md:flex-row gap-12">
    <section class="md:w-2/3 space-y-8">
        @forelse ($courses as $course)
        <article class="bg-white rounded-lg shadow-md p-6 flex flex-col">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4">{{ $course->title }}</h2>
            <video controls controlsList="nodownload nofullscreen noremoteplayback" disablePictureInPicture
                class="w-full rounded-lg shadow-lg" height="360" preload="metadata"
                poster="{{ $course->image_url ?? 'https://placehold.co/640x360?text=Thumbnail' }}" width="640">
                <source src="{{ $course->video_url }}" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
            <p class="mt-4 text-gray-700 leading-relaxed flex-grow">
                {{ $course->description }}
            </p>
        </article>
        @empty
        <div class="text-gray-600">Belum ada pelatihan yang tersedia saat ini.</div>
        @endforelse
    </section>
   <aside class="md:w-1/3 space-y-8">
    @guest
    <!-- Tampil hanya untuk user yang belum login -->
    <div class="bg-white rounded-lg shadow-md p-6 sticky top-20 space-y-6">
        <div>
            <h3 class="text-xl font-semibold text-indigo-700 mb-4">
                Status Pelatihan Anda
            </h3>
            <p class="text-gray-700 mb-4">
                Anda belum login. Silakan login atau daftar untuk mengakses video lengkap dan mendapatkan sertifikat digital.
            </p>
            <a class="block bg-indigo-600 text-white text-center py-3 rounded mb-3 hover:bg-indigo-700 transition font-semibold" href="{{ route('login') }}">
                Login
            </a>
            <a class="block border border-indigo-600 text-indigo-600 text-center py-3 rounded hover:bg-indigo-600 hover:text-white transition font-semibold" href="{{ route('register') }}">
                Daftar
            </a>
        </div>

        <!-- Sertifikat Digital (digabung dalam kotak yang sama) -->
        <div class="pt-4 border-t border-gray-200">
            <h3 class="text-xl font-semibold text-indigo-700 mb-3">Sertifikat Digital</h3>
            <p class="text-gray-700 text-sm">
                Setelah menyelesaikan semua video pelatihan, Anda akan menerima sertifikat digital resmi dari <strong>Bersihin.Sepatu</strong> sebagai bukti keahlian Anda.
            </p>
        </div>
    </div>
    @endguest
</aside>
  </main>
  <!-- Footer -->
  <footer class="bg-indigo-700 text-indigo-200 py-8 mt-auto">
   <div
    class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row justify-between items-center"
   >
    <p class="text-sm">© 2024 Bersihin.Sepatu. All rights reserved.</p>
    <div class="flex space-x-6 mt-4 md:mt-0">
      <a aria-label="Whatsapp" class="hover:text-white" href="http://wa.me/message/GLB7CD3URGIHI1">
         <i class="fab fa-whatsapp">
         </i>
        </a>
        <a aria-label="Instagram" class="hover:text-white" href="https://www.instagram.com/bersihin.sepatu?igsh=MXF0Ynd0Y2Viejc4YQ==">
         <i class="fab fa-instagram">
         </i>
        </a>
        <a aria-label="TikTok" class="hover:text-white" href="https://www.tiktok.com/@bersihinsepatu.depok?_t=ZS-8xAiayDDyoK&_r=1 ">
         <i class="fab fa-tiktok">
         </i>
        </a>
    </div>
   </div>
  </footer>
  <script>
   // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.querySelector('button[onclick="toggleDropdown()"]');
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
  </script>
 </body>
</html>