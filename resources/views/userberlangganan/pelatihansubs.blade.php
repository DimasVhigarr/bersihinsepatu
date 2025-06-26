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
    <!-- Video List -->
    <section class="md:w-2/3 space-y-8">
        @forelse ($courses as $course)
        <article class="bg-white rounded-lg shadow-md p-6 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-indigo-700">{{ $course->title }}</h2>
                
                @php
                    $status = $coursesStatus[$course->id] ?? 'incomplete';
                    $badge = match ($status) {
                        'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'icon' => '✅', 'label' => 'Selesai & Disetujui'],
                        'waiting' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'icon' => '🕒', 'label' => 'Menunggu Persetujuan'],
                        default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => '❌', 'label' => 'Belum Selesai'],
                    };
                @endphp

                <span class="ml-4 {{ $badge['bg'] }} {{ $badge['text'] }} px-3 py-1 text-sm rounded-full font-medium shadow-sm">
                    {{ $badge['icon'] }} {{ $badge['label'] }}
                </span>
            </div>
            <video controls controlsList="nodownload nofullscreen noremoteplayback" disablePictureInPicture
                class="w-full rounded-lg shadow-lg" height="360" preload="metadata"
                poster="{{ $course->image_url ?? 'https://placehold.co/640x360?text=Thumbnail' }}" width="640">
                <source src="{{ $course->video_url }}" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
            <p class="mt-4 text-gray-700 leading-relaxed flex-grow text-center">
                {{ $course->description }}
            </p>
            <a href="{{ url('/video/' . $course->slug) }}"
                class="mt-4 inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition font-semibold mx-auto">
                Tonton Video Eksklusif
            </a>
        </article>
        @empty
        <p class="text-gray-600">Belum ada pelatihan yang tersedia.</p>
        @endforelse
    </section>
   <aside class="md:w-1/3 space-y-8">
  <div class="bg-white rounded-lg shadow-md p-6 sticky top-20 space-y-6">
    <h3 class="text-xl font-semibold text-indigo-700 mb-4">
      Status Pelatihan Anda
    </h3>

    @if($package)
      <p class="text-gray-700">
        Anda sudah berlangganan dan memiliki akses penuh ke semua video pelatihan dan materi eksklusif.
      </p>
      <div class="inline-block bg-indigo-100 border border-indigo-600 text-indigo-700 px-6 py-3 rounded-lg font-semibold shadow">
        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
      </div>
      <a class="block bg-indigo-600 text-white text-center py-3 rounded hover:bg-indigo-700 transition font-semibold" href="/subs/kelola">
        Kelola Akun Saya
      </a>

      <!-- Sertifikat Digital -->
      <div class="pt-6 border-t border-gray-200">
        <h3 class="text-xl font-semibold text-indigo-700 mb-3">Sertifikat Digital</h3>
        <p class="text-gray-700 mb-4 text-sm">
          Klik tombol di bawah ini untuk melihat atau mengunduh sertifikat Anda.
        </p>

        <form action="{{ route('preview.sertifikat') }}" method="GET" target="_blank">
          <button 
            type="submit"
            class="w-full font-semibold px-4 py-3 rounded transition
              {{ $completedAllCourses && $allApproved ? 'bg-indigo-600 hover:bg-indigo-700 text-white cursor-pointer' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
            {{ $completedAllCourses && $allApproved ? '' : 'disabled' }}
          >
            {{ $completedAllCourses && $allApproved ? 'Lihat Sertifikat' : 'Sertifikat Belum Tersedia' }}
          </button>
        </form>
      </div>
    @else
      <p class="text-gray-700">
        Anda belum memiliki langganan aktif. Silakan pilih paket berlangganan untuk mendapatkan akses penuh.
      </p>
      <a class="block bg-indigo-600 text-white text-center py-3 rounded hover:bg-indigo-700 transition font-semibold" href="{{ route('berlangganan.index') }}">
        Berlangganan Sekarang
      </a>
    @endif
  </div>
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

    const video = document.getElementById('training-video');
    video.addEventListener('ended', function() {
        fetch("/video/{{ $course->id }}/watch", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        });
    });

    function markWatched(courseId) {
    fetch(`/video/${courseId}/watch`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({})
    }).then(response => {
        if (response.ok) {
            console.log("Ditandai selesai.");
            location.reload(); // Refresh halaman untuk update status
        }
    });
}
  </script>
 </body>
</html>