<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Bersihin.Sepatu - Berlangganan
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
    {{-- Pesan sukses --}}
@if (session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-center">
    {{ session('success') }}
</div>
@endif

{{-- Pesan error --}}
@if ($errors->any())
<div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-center">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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

{{-- Konten Form Pembayaran --}}
<main class="flex-grow max-w-3xl mx-auto px-6 sm:px-12 py-16">
    <h1 class="text-4xl font-bold text-indigo-700 mb-10 text-center">Pembayaran Paket Berlangganan</h1>

    <form action="{{ route('berlangganan.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8 space-y-8">
        @csrf
        {{-- Pilih Paket --}}
        <section>
            <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Pilih Paket Berlangganan</h2>
            @foreach($packages as $package)
                <label for="package-{{ $package->id }}" class="package-label block border rounded p-4 mb-4 cursor-pointer hover:border-indigo-500">
                    <input type="radio" id="package-{{ $package->id }}" name="package_id" value="{{ $package->id }}" required />
                    <div class="inline-block align-middle">
                        <p class="text-xl font-semibold mb-1">{{ $package->name }}</p>
                        <p class="text-2xl font-extrabold text-indigo-600 mb-2">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        <ul class="text-gray-700 space-y-1 text-sm">
                            @foreach(explode("\n", $package->description) as $description)
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>{{ $description }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </label>
            @endforeach
            @error('package_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </section>

        {{-- Informasi Diri --}}
        <section>
            <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Informasi Pembayaran</h2>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required class="w-full border rounded px-4 py-2" placeholder="Nama Lengkap">
                </div>
                <div>
                    <label for="email" class="block font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" required class="w-full border rounded px-4 py-2" placeholder="email@example.com">
                </div>
                <div>
                    <label for="phone" class="block font-medium mb-2">Nomor Telepon</label>
                    <input type="tel" name="phone" id="phone" required class="w-full border rounded px-4 py-2" placeholder="08xxxxxxxxxx">
                </div>
            </div>
        </section>

        {{-- Metode Pembayaran --}}
        <section>
            <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Metode Pembayaran</h2>
            <div class="space-y-4">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="radio" name="payment_method" value="bank_transfer" class="form-radio text-indigo-600" checked onchange="togglePaymentInfo()">
                    <span class="text-gray-700 font-medium">Transfer Bank</span>
                </label>
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="radio" name="payment_method" value="qr_code" class="form-radio text-indigo-600" onchange="togglePaymentInfo()">
                    <span class="text-gray-700 font-medium">QR Code</span>
                </label>
            </div>

            {{-- Info Transfer Bank --}}
            <div id="bank-info" class="mt-6 p-4 bg-gray-100 rounded">
                <p class="font-semibold mb-2">Silakan transfer ke rekening berikut:</p>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/bca.jpg') }}" alt="BCA" class="h-8">
                    <span class="text-lg font-semibold">1234567890 a.n. Bersihin.Sepatu</span>
                </div>
            </div>

            {{-- Info QR Code --}}
            <div id="qr-info" class="mt-6 p-4 bg-gray-100 rounded hidden">
                <p class="font-semibold mb-2">Scan QR Code berikut untuk membayar:</p>
                <img src="{{ asset('images/qr.jpg') }}" alt="QR Code" class="h-40 mx-auto">
            </div>
        </section>

        {{-- Upload Bukti Pembayaran --}}
        <section>
            <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Upload Bukti Pembayaran</h2>
            <div>
                <label for="payment_proof" class="block font-medium mb-2">Bukti Pembayaran (jpg, png, max 5MB)</label>
                <input type="file" name="payment_proof" id="payment_proof" required accept=".jpg,.jpeg,.png" class="w-full border rounded px-4 py-2">
            </div>
        </section>

        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded hover:bg-indigo-700 text-lg font-semibold">Bayar Sekarang</button>
    </form>
</main>

{{-- Footer --}}
<footer class="bg-indigo-700 text-indigo-200 py-8">
    <div class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm">© 2024 Bersihin.Sepatu. All rights reserved.</p>
        <div class="flex space-x-6 mt-4 md:mt-0">
            <a href="http://wa.me/message/GLB7CD3URGIHI1" class="hover:text-white"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/bersihin.sepatu?igsh=MXF0Ynd0Y2Viejc4YQ==" class="hover:text-white"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@bersihinsepatu.depok?_t=ZS-8xAiayDDyoK&_r=1" class="hover:text-white"><i class="fab fa-tiktok"></i></a>
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

    setInterval(() => {
        fetch('/api/check-status')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'aktif') {
                    location.reload();
                }
            });
    }, 5000); // cek setiap 5 detik

    
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

    function togglePaymentInfo() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const bankInfo = document.getElementById('bank-info');
        const qrInfo = document.getElementById('qr-info');

        if (selectedMethod === 'bank_transfer') {
            bankInfo.classList.remove('hidden');
            qrInfo.classList.add('hidden');
        } else {
            bankInfo.classList.add('hidden');
            qrInfo.classList.remove('hidden');
        }
    }

    document.addEventListener("DOMContentLoaded", togglePaymentInfo);
</script>
</body>
</html>
