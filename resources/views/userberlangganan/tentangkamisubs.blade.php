<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Bersihin.Sepatu - Tentang Kami</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
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

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <a href="{{ url('/subs/beranda') }}">Beranda</a>
          <a href="{{ url('/subs/tentangkami') }}">Tentang Kami</a>
          <a href="{{ url('/subs/pelatihan') }}">Pelatihan</a>
          <a href="{{ url('/subs/kelola') }}">Kelola Akun</a>
        </div>

        <!-- User Auth / Profile -->
        @auth
        <div class="hidden md:flex items-center relative">
          <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
            <span class="text-indigo-700 font-semibold mr-2">{{ Auth::user()->name }}</span>
            <img alt="Profile Picture" class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/user.jpg') }}" />
            <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <!-- Dropdown -->
          <div id="dropdownMenu" class="hidden absolute right-0 mt-12 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <a href="{{ url('/subs/kelola') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
            </form>
          </div>
        </div>
        @else
        <!-- Guest Menu -->
        <div class="hidden md:flex space-x-4">
          <a class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition" href="{{ route('login') }}">Login</a>
          <a class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition" href="{{ route('register') }}">Daftar</a>
        </div>
        @endauth

        <!-- Mobile Toggle -->
        <button class="md:hidden focus:outline-none focus:ring-2 focus:ring-indigo-600" id="mobile-menu-button">
          <i class="fas fa-bars text-2xl text-indigo-700"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 shadow-sm px-4 pb-4">
      <a href="{{ url('/subs/beranda') }}" class="block py-2 text-gray-700 hover:bg-gray-100">Beranda</a>
      <a href="{{ url('/subs/tentangkami') }}" class="block py-2 text-gray-700 hover:bg-gray-100">Tentang Kami</a>
      <a href="{{ url('/subs/pelatihan') }}" class="block py-2 text-gray-700 hover:bg-gray-100">Pelatihan</a>
      <a href="{{ url('/subs/kelola') }}" class="block py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>

      @auth
      <div class="border-t border-gray-100 my-2"></div>
      <a href="{{ url('/subs/kelola') }}" class="block py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left py-2 text-red-600 hover:bg-gray-100">Logout</button>
      </form>
      @else
      <div class="border-t border-gray-100 my-2"></div>
      <a href="{{ route('login') }}" class="block py-2 text-indigo-600 hover:bg-gray-100">Login</a>
      <a href="{{ route('register') }}" class="block py-2 bg-indigo-600 text-white text-center rounded hover:bg-indigo-700">Daftar</a>
      @endauth
    </div>
  </nav>

  <!-- About Us Content -->
  <main class="flex-grow bg-indigo-50 py-16 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-indigo-700 mb-8 text-center">Tentang Bersihin.Sepatu</h1>
    <div class="max-w-4xl mx-auto space-y-8 text-gray-700 text-lg leading-relaxed">
      <p>
        Bersihin.Sepatu adalah platform pelatihan pembersihan sepatu profesional yang didirikan untuk memenuhi kebutuhan masyarakat akan pelatihan praktis dari praktisi berpengalaman. Kami menyediakan video tutorial eksklusif, materi manajemen usaha, serta sertifikat digital resmi untuk member yang telah menyelesaikan pelatihan.
      </p>
      <p>
        Kami percaya bahwa pelatihan yang efektif adalah pelatihan yang dilakukan secara langsung dan praktis, bukan hanya sekadar menonton video di platform umum. Bersihin.Sepatu hadir sebagai solusi terpercaya untuk Anda yang ingin mengembangkan keahlian dan usaha pembersihan sepatu secara profesional.
      </p>
      <img alt="Trainer" class="rounded-lg shadow-lg mx-auto" height="400" src="{{ asset('images/logo.jpg') }}" width="600" />
      <h2 class="text-2xl font-semibold text-indigo-700 mt-12 text-center">Misi Kami</h2>
      <p>
        Memberikan pelatihan pembersihan sepatu yang berkualitas tinggi dengan pendekatan praktis dan langsung dari para ahli, serta mendukung pengembangan usaha pembersihan sepatu di Indonesia.
      </p>
      <h2 class="text-2xl font-semibold text-indigo-700 mt-8 text-center">Visi Kami</h2>
      <p>
        Menjadi platform pelatihan pembersihan sepatu profesional terkemuka yang terpercaya dan diakui oleh masyarakat luas.
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-indigo-700 text-indigo-200 py-8 mt-auto">
    <div class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row justify-between items-center">
      <p class="text-sm">© 2024 Bersihin.Sepatu. All rights reserved.</p>
      <div class="flex space-x-6 mt-4 md:mt-0">
        <a aria-label="Whatsapp" class="hover:text-white" href="http://wa.me/message/GLB7CD3URGIHI1">
          <i class="fab fa-whatsapp"></i>
        </a>
        <a aria-label="Instagram" class="hover:text-white" href="https://www.instagram.com/bersihin.sepatu?igsh=MXF0Ynd0Y2Viejc4YQ==">
          <i class="fab fa-instagram"></i>
        </a>
        <a aria-label="TikTok" class="hover:text-white" href="https://www.tiktok.com/@bersihinsepatu.depok?_t=ZS-8xAiayDDyoK&_r=1">
          <i class="fab fa-tiktok"></i>
        </a>
      </div>
    </div>
  </footer>

  <!-- Script -->
  <script>
    function toggleDropdown() {
      document.getElementById('dropdownMenu').classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
      const dropdown = document.getElementById('dropdownMenu');
      const button = document.querySelector('button[onclick="toggleDropdown()"]');
      if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });

    // Toggle mobile menu
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
