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

  <!-- Hero Section -->
  <header class="bg-indigo-600 text-white py-20 px-6 sm:px-12 md:px-20 flex flex-col md:flex-row items-center max-w-7xl mx-auto">
   <div class="md:w-1/2 space-y-6">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
     Pelatihan Pembersihan Sepatu Profesional Bersihin.Sepatu
    </h1>
    <p class="text-lg sm:text-xl text-indigo-200">
     Belajar langsung dari praktisi berpengalaman dengan materi eksklusif dan sertifikat digital.
    </p>
    <a class="inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded shadow hover:bg-indigo-50 transition" href="/berlangganan">
     Mulai Berlangganan
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
     Kenapa Memilih Bersihin.Sepatu?
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
     <div class="flex flex-col items-center text-center space-y-4 px-6">
      <img alt="Icon representing expert trainers, a professional with a shoe brush and cleaning tools" class="w-24 h-24" height="100" src="https://storage.googleapis.com/a1aa/image/bb15b137-8dbb-4fb1-aadd-873153176607.jpg" width="100"/>
      <h3 class="text-xl font-semibold text-indigo-600">
       Praktisi Berpengalaman
      </h3>
      <p class="text-gray-600">
       Belajar langsung dari praktisi yang sudah berpengalaman di bidang pembersihan sepatu premium.
      </p>
     </div>
     <div class="flex flex-col items-center text-center space-y-4 px-6">
      <img alt="Icon representing exclusive content, a locked video tutorial screen" class="w-24 h-24" height="100" src="https://storage.googleapis.com/a1aa/image/5f4d6101-fc65-458d-1162-8a074d5e6337.jpg" width="100"/>
      <h3 class="text-xl font-semibold text-indigo-600">
       Fitur Membership
      </h3>
      <p class="text-gray-600">
       Akses video tutorial dan materi manajemen usaha yang hanya tersedia untuk member berlangganan.
      </p>
     </div>
     <div class="flex flex-col items-center text-center space-y-4 px-6">
      <img alt="Icon representing digital certificate, a certificate with a ribbon and digital checkmark" class="w-24 h-24" height="100" src="https://storage.googleapis.com/a1aa/image/a4fff612-49e2-4a4b-d202-dd346a9140b6.jpg" width="100"/>
      <h3 class="text-xl font-semibold text-indigo-600">
       Sertifikat Digital
      </h3>
      <p class="text-gray-600">
       Dapatkan sertifikat digital resmi setelah menyelesaikan pelatihan sebagai bukti keahlian Anda.
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
        </div>
      </article>
      @empty
        <p class="col-span-full text-gray-600 text-center">Belum ada video pelatihan tersedia.</p>
      @endforelse
    </div>
  </div>
</section>

  <!-- Subscription Plans -->
  <section class="py-16 bg-white" id="pricing">
  <div class="max-w-7xl mx-auto px-6 sm:px-12">
    <h2 class="text-3xl font-bold text-indigo-700 mb-12 text-center">
      Paket Berlangganan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
      @foreach ($packages as $package)
        <div class="border {{ $loop->index == 1 ? 'border-2 bg-indigo-50 shadow-lg' : 'border' }} border-indigo-300 rounded-lg p-8 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-indigo-700 mb-4">
            {{ $package->name }}
          </h3>
          <p class="text-4xl font-extrabold text-indigo-600 mb-4">
            Rp {{ number_format($package->price, 0, ',', '.') }}
          </p>

          <ul class="mb-6 text-gray-700 space-y-2 text-left">
            @foreach (explode("\n", $package->description) as $description)
              <li class="flex items-start">
                @if(Str::contains($description, '[x]'))
                  <i class="fas fa-times text-red-500 mr-2 mt-1"></i>
                  <span>{{ str_replace('[x]', '', $description) }}</span>
                @else
                  <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                  <span>{{ $description }}</span>
                @endif
              </li>
            @endforeach
          </ul>
          <form action="{{ route('berlangganan.submit') }}" method="GET">
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition w-full">
              Berlangganan
            </button>
          </form>
        </div>
      @endforeach
    </div>
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
