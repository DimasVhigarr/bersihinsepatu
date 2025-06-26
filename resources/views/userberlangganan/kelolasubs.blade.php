<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Bersihin.Sepatu - Kelola User
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

    <!-- Profile Section -->
    <main class="flex-grow max-w-3xl mx-auto px-6 sm:px-12 py-16">
        <h1 class="text-4xl font-bold text-indigo-700 mb-10 text-center">Profil Saya</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8 space-y-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-8">
                <img 
                    src="{{ asset('images/user.jpg') }}" 
                    alt="Foto Profil"
                    class="rounded-full w-36 h-36 object-cover mx-auto sm:mx-0" 
                />
                <div class="mt-6 sm:mt-0 flex-1">
                    <h2 class="text-2xl font-semibold text-indigo-700 mb-2">{{ $user->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $user->email }}</p>
                    <p class="text-gray-600 mb-6">Bergabung sejak {{ $user->created_at->format('d F Y') }}</p>
                    <a class="inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition font-semibold" href="#edit-profile">Edit Profil</a>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 max-w-md mx-auto">
    <h3 class="text-xl font-semibold text-indigo-700 mb-4 text-center">Paket Berlangganan</h3>
    <div class="bg-indigo-100 border border-indigo-600 text-indigo-700 px-6 py-4 rounded-lg font-semibold shadow text-center">
        @if($subscription)
            {{ $package?->name ?? 'Paket Tidak Diketahui' }} - {{ ucfirst($subscription->status) }} <br>
            <span class="text-sm font-normal text-gray-700">
                Berlaku Sampai : {{ \Carbon\Carbon::parse($subscription->end_date)->translatedFormat('d F Y') }}
            </span>
        @else
            Tidak Berlangganan
        @endif
    </div>
    <!-- Sertifikat -->
<div class="bg-white rounded-lg shadow-md p-6 mt-8">
    <h3 class="text-xl font-semibold text-indigo-700 mb-4 text-center">Sertifikat Digital</h3>
    <p class="text-gray-700 mb-4 text-center">
        Selesaikan semua pelatihan <strong>dan quiz yang disetujui admin</strong> untuk mendapatkan sertifikat resmi.
    </p>

    <button 
        class="w-full text-white font-semibold px-4 py-3 rounded 
            {{ $allApproved ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-400 cursor-not-allowed' }}"
        {{ $allApproved ? '' : 'disabled' }}
        onclick="if({{ $allApproved ? 'true' : 'false' }}) window.location='{{ route('subs.sertifikat') }}';"
    >
        Lihat Sertifikat
    </button>
</div>
</div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <section class="bg-white rounded-lg shadow-md p-8 mt-12 max-w-xl mx-auto hidden" id="edit-profile">
            <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Edit Profil</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="name">Nama Lengkap</label>
                    <input class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-indigo-600" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
                    <input class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-indigo-600" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition font-semibold">Simpan Perubahan</button>
                    <button type="button" onclick="toggleEditProfile(false)" class="text-indigo-600 font-semibold hover:underline">Batal</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-700 text-indigo-200 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm">© 2024 Bersihin.Sepatu. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a class="hover:text-white" href="http://wa.me/message/GLB7CD3URGIHI1"><i class="fab fa-whatsapp"></i></a>
                <a class="hover:text-white" href="https://www.instagram.com/bersihin.sepatu?igsh=MXF0Ynd0Y2Viejc4YQ=="><i class="fab fa-instagram"></i></a>
                <a class="hover:text-white" href="https://www.tiktok.com/@bersihinsepatu.depok?_t=ZS-8xAiayDDyoK&_r=1 "><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        function toggleEditProfile(show) {
            const form = document.getElementById('edit-profile');
            if (show) {
                form.classList.remove('hidden');
                window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
            } else {
                form.classList.add('hidden');
            }
        }

        document.querySelector('a[href="#edit-profile"]').addEventListener('click', e => {
            e.preventDefault();
            toggleEditProfile(true);
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
