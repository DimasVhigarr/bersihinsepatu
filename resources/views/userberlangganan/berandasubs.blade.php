<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Bersihin.Sepatu - Platform Pelatihan Pembersihan Sepatu Profesional
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Inter', sans-serif;
        }
        video::-webkit-media-controls {
            display:none !important;
        }
        video::-webkit-media-controls-enclosure {
            display:none !important;
        }
        video::-webkit-media-controls-panel {
            display:none !important;
        }
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
  <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <a class="flex items-center space-x-2" href="/">
          <img alt="Logo Bersihin.Sepatu" class="h-10 w-10" src="{{ asset('images/logo.jpg') }}" />
          <span class="font-semibold text-xl text-indigo-700">Bersihin.Sepatu</span>
        </a>

        <div class="hidden md:flex space-x-6 text-gray-700 font-medium">
          <a href="{{ url('/subs/beranda') }}">Beranda</a>
          <a href="{{ url('/subs/tentangkami') }}">Tentang Kami</a>
          <a href="{{ url('/subs/pelatihan') }}">Pelatihan</a>
          <a href="{{ url('/subs/kelola') }}">Kelola Akun</a>
        </div>

        @auth
        <div class="hidden md:flex items-center relative">
          <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
            <span class="text-indigo-700 font-semibold mr-2">{{ Auth::user()->name }}</span>
            <img alt="Profile Picture" class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/user.jpg') }}" />
            <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div id="dropdownMenu" class="hidden absolute right-0 mt-12 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <a href="{{ url('/subs/kelola') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>

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

        <button class="md:hidden focus:outline-none focus:ring-2 focus:ring-indigo-600" id="mobile-menu-button">
          <i class="fas fa-bars text-2xl text-indigo-700"></i>
        </button>
      </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
      <div class="space-y-2">
        <a href="{{ url('/subs/beranda') }}" class="block text-gray-700 font-medium">Beranda</a>
        <a href="{{ url('/subs/tentangkami') }}" class="block text-gray-700 font-medium">Tentang Kami</a>
        <a href="{{ url('/subs/pelatihan') }}" class="block text-gray-700 font-medium">Pelatihan</a>
        <a href="{{ url('/subs/kelola') }}" class="block text-gray-700 font-medium">Kelola Akun</a>
        @auth
        <hr class="my-2">
        <a href="{{ url('/subs/kelola') }}" class="block text-gray-700 font-medium">Kelola Akun</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left text-red-600 font-medium">Logout</button>
        </form>
        @else
        <hr class="my-2">
        <a href="{{ route('login') }}" class="block text-gray-700 font-medium">Login</a>
        <a href="{{ route('register') }}" class="block text-gray-700 font-medium">Daftar</a>
        @endauth
      </div>
    </div>
  </nav>
  <!-- Hero Section -->
  <header class="bg-indigo-600 text-white py-20 px-6 sm:px-12 md:px-20 flex flex-col md:flex-row items-center max-w-7xl mx-auto">
   <div class="md:w-1/2 space-y-6">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
  Selamat Datang, 
  <span class="font-bold italic text-black">{{ Auth::user()->name }}</span>! 
  Akses Pelatihan Pembersihan Sepatu Profesional Anda
</h1>

    <p class="text-lg sm:text-xl text-indigo-200">
     Nikmati akses penuh ke semua video tutorial, materi eksklusif, dan sertifikat digital Anda.
    </p>
    <a class="inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded shadow hover:bg-indigo-50 transition" href="/subs/kelola">
     Kelola Akun Saya
    </a>
   </div>
   <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
  <img
    alt="Pelatihan membersihkan sepatu profesional"
    class="rounded-lg shadow-lg"
    height="350"
    src="{{ asset('images/logo.jpg') }}"
    width="500"
/>
</div>
  </header>
  <!-- Features Section -->
  <section class="py-16 bg-white" id="features">
  <div class="max-w-7xl mx-auto px-6 sm:px-12">
    <h2 class="text-3xl font-bold text-center text-indigo-700 mb-12">
      Keuntungan Berlangganan Bersihin.Sepatu
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">

      <!-- Fitur 1: Akses Tanpa Batas -->
      <div class="flex flex-col items-center space-y-4">
        <img src="https://storage.googleapis.com/a1aa/image/a6832b88-0dcf-48fe-1d29-637c70a69eb2.jpg"
             alt="Akses Tanpa Batas" class="w-20 h-20 mx-auto">
        <h3 class="text-lg font-semibold text-indigo-600">Akses Tanpa Batas</h3>
        <p class="text-gray-600 text-sm">
          Nikmati akses penuh ke semua pelatihan dan materi eksklusif kapan saja dan di mana saja.
        </p>
      </div>

      <!-- Fitur 2: Sertifikat Digital -->
      <div class="flex flex-col items-center space-y-4">
        <img src="https://storage.googleapis.com/a1aa/image/4f1c215a-fb43-450e-fc5b-979b153083e8.jpg"
             alt="Sertifikat Digital" class="w-20 h-20 mx-auto">
        <h3 class="text-lg font-semibold text-indigo-600">Sertifikat Digital Resmi</h3>
        <p class="text-gray-600 text-sm">
          Dapatkan sertifikat digital resmi sebagai bukti keahlian Anda setelah menyelesaikan pelatihan.
        </p>
      </div>

      <!-- Fitur 3: Materi Usaha & Branding -->
      <div class="flex flex-col items-center space-y-4">
        <img src="https://static.thenounproject.com/png/business-training-icon-2675600-512.png"
             alt="Usaha & Branding" class="w-20 h-20 mx-auto">
        <h3 class="text-lg font-semibold text-indigo-600">Materi Usaha & Branding</h3>
        <p class="text-gray-600 text-sm">
          Selain pelatihan teknis, Anda juga mendapatkan panduan membangun usaha dan tips branding profesional.
        </p>
      </div>

      <!-- Fitur 4: Lihat Progress Pelatihan -->
      <div class="flex flex-col items-center space-y-4">
        <img src="https://static.thenounproject.com/png/progress-monitoring-icon-7882100-512.png"
             alt="Progress Pelatihan" class="w-20 h-20 mx-auto">
        <h3 class="text-lg font-semibold text-indigo-600">Lihat Progress Pelatihan</h3>
        <p class="text-gray-600 text-sm">
          Lacak perkembangan Anda, lihat nilai quiz, dan pastikan Anda tidak melewatkan materi penting.
        </p>
      </div>

    </div>
  </div>
</section>

  <!-- Courses Section -->
<section class="py-16 bg-indigo-50" id="courses">
  <div class="max-w-7xl mx-auto px-6 sm:px-12">
    <h2 class="text-3xl font-bold text-indigo-700 mb-12 text-center">
      Daftar Pelatihan
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse ($courses as $course)
      <article class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full">
        <div class="aspect-w-16 aspect-h-9">
          <img 
            alt="{{ $course->title }}" 
            src="{{ $course->image_url ?? 'https://placehold.co/400x225?text=Thumbnail' }}" 
            class="w-full h-full object-cover"
          />
        </div>
        <div class="p-6 flex flex-col flex-1">
          <h3 class="text-xl font-semibold text-indigo-700 mb-2">
            {{ $course->title }}
          </h3>
          <p class="text-gray-700 flex-1">
            {{ Str::limit($course->description, 100) }}
          </p>
          <a href="{{ url('/video/' . $course->slug) }}" 
             class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition self-start">
            Tonton Video
          </a>
        </div>
      </article>
      @empty
        <p class="col-span-full text-gray-600 text-center">Belum ada video pelatihan tersedia.</p>
      @endforelse
    </div>
  </div>
</section>

  {{-- STATUS LANGGANAN --}}
<section class="py-8 bg-white" id="subscription-status">
  <div class="max-w-7xl mx-auto px-6 sm:px-12 text-center">
    <h2 class="text-2xl font-bold text-indigo-700 mb-4">Status Berlangganan Anda</h2>

    @if ($subscription && $package)
      <p class="text-gray-700 mb-3">
        Anda saat ini berlangganan <strong>{{ $package->name }}</strong> dengan akses penuh ke semua konten.
      </p>
      <div class="inline-block bg-indigo-100 border border-indigo-600 text-indigo-700 px-6 py-2 rounded-lg font-semibold shadow">
        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
      </div>
      <div class="mt-4">
        <a class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition" href="/subs/kelola">
          Kelola Akun
        </a>
      </div>
    @else
      <p class="text-gray-700 mb-4">Anda belum memiliki langganan aktif saat ini.</p>
      <a href="{{ route('berlangganan.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
        Berlangganan Sekarang
      </a>
    @endif
  </div>
</section>

  <!-- About Section -->
  <section class="py-16 bg-indigo-50" id="about">
   <div class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row items-center gap-12">
    <div class="md:w-1/2">
     <img alt="Experienced shoe cleaning trainer demonstrating techniques to a group of students in a bright classroom" class="rounded-lg shadow-lg" height="400" src="{{ asset('images/logo.jpg') }}" width="600"/>
    </div>
    <div class="md:w-1/2 space-y-6">
     <h2 class="text-3xl font-bold text-indigo-700">
      Tentang Bersihin.Sepatu
     </h2>
     <p class="text-gray-700 text-lg leading-relaxed">
      Bersihin.Sepatu adalah platform pelatihan pembersihan sepatu profesional yang didirikan untuk memenuhi kebutuhan masyarakat akan pelatihan praktis dari praktisi berpengalaman. Kami menyediakan video tutorial eksklusif, materi manajemen usaha, serta sertifikat digital resmi untuk member yang telah menyelesaikan pelatihan. Dengan sistem berlangganan, kami menjaga eksklusivitas konten dan memberikan proteksi anti screen recording untuk menjaga kualitas dan keaslian materi.
     </p>
     <p class="text-gray-700 text-lg leading-relaxed">
      Kami percaya bahwa pelatihan yang efektif adalah pelatihan yang dilakukan secara langsung dan praktis, bukan hanya sekadar menonton video di platform umum. Bersihin.Sepatu hadir sebagai solusi terpercaya untuk Anda yang ingin mengembangkan keahlian dan usaha pembersihan sepatu secara profesional.
     </p>
    </div>
   </div>
  </section>
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
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if(mobileMenuButton && mobileMenu){
      mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }
    document.querySelectorAll('button').forEach(btn => {
      btn.addEventListener('click', (e) => {
        if(btn.disabled) {
          e.preventDefault();
        }
      });
    });
    function toggleDropdown() {
      const dropdown = document.getElementById('dropdownMenu');
      if(dropdown){
        dropdown.classList.toggle('hidden');
      }
    }
    window.addEventListener('click', function(e) {
      const dropdown = document.getElementById('dropdownMenu');
      const button = document.querySelector('button[onclick="toggleDropdown()"]');
      if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
 </body>
</html>
