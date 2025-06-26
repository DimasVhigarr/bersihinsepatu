<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Bersihin.Sepatu - Login
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
          <a href="{{ url('/kelola') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>
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
      <a href="{{ url('/kelola') }}" class="block">Kelola Akun</a>
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

  <!-- Login Section -->
  <main class="flex-grow flex items-center justify-center px-4 py-16">
   <div
    class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 sm:p-10"
    role="main"
    aria-label="Login form"
   >
    <div class="mb-8 text-center">
     <img
      alt="Logo Bersihin.Sepatu, a stylized shoe cleaning brush icon"
      class="mx-auto mb-4"
      height="80"
      src="{{ asset('images/logo.jpg') }}"
      width="80"
     />
     <h1 class="text-3xl font-extrabold text-indigo-700">Masuk ke Bersihin.Sepatu</h1>
     <p class="text-gray-600 mt-2">
         Masukkan email dan kata sandi Anda untuk melanjutkan
     </p>
      @if (session('error'))
         <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 border border-red-300 rounded">
            {{ session('error') }}
         </div>
      @endif
    </div>
    <form method="POST" action="{{ url('/login') }}" class="space-y-6" novalidate>
    @csrf
     <div>
      <label
       for="email"
       class="block text-sm font-medium text-gray-700 mb-1"
       >Email</label
      >
      <div class="relative">
       <input
          type="email"
          name="email"
          id="email"
          autocomplete="email"
          required
          placeholder="you@example.com"
          value="{{ old('email', Cookie::get('email')) }}"
          class="block w-full rounded-md border border-gray-300 px-3 py-2 pl-10 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
        />
       <div
        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400"
       >
        <i class="fas fa-envelope"></i>
       </div>
      </div>
     </div>
     <div>
      <label
       for="password"
       class="block text-sm font-medium text-gray-700 mb-1"
       >Kata Sandi</label
      >
      <div class="relative">
       <input
        type="password"
        name="password"
        id="password"
        autocomplete="current-password"
        required
        minlength="8"
        placeholder="••••••••"
        class="block w-full rounded-md border border-gray-300 px-3 py-2 pl-10 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
       />
      @error('password')
         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
       <div
        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400"
       >
        <i class="fas fa-lock"></i>
       </div>
      </div>
     </div>
     <div class="flex items-center justify-between">
      <div class="flex items-center">
       <input
        id="remember"
        name="remember"
        type="checkbox"
        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
       />
       <label for="remember_me" class="ml-2 block text-sm text-gray-900"
        >Ingat saya / Remember</label
       >
      </div>
      {{-- <div class="text-sm">
       <a
        href="#"
        class="font-medium text-indigo-600 hover:text-indigo-500 transition"
        >Lupa kata sandi?</a
       >
      </div> --}}
     </div>
     <div>
      <button
       type="submit"
       class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 font-semibold"
      >
       Masuk
      </button>
     </div>
     <div>
      <a href="{{ url('/auth/google') }}"
                    class="block bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded mb-4 text-center hover:bg-gray-100">
                    <i class="fab fa-google mr-2"></i> Login with Google
      </a>
     </div>
    </form>
    <p class="mt-6 text-center text-sm text-gray-600">
     Belum punya akun?
     <a
      href="/daftar"
      class="font-medium text-indigo-600 hover:text-indigo-500 transition"
      >Daftar sekarang</a
     >
    </p>
   </div>
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
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });

  function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
  }

  window.addEventListener('click', function (e) {
    const dropdown = document.getElementById('dropdownMenu');
    const button = document.querySelector('button[onclick=\"toggleDropdown()\"]');
    if (button && !button.contains(e.target) && dropdown && !dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>

 </body>
</html>