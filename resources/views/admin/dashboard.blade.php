<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Bersihin.Sepatu - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
      ::-webkit-scrollbar {
        width: 8px;
      }
      ::-webkit-scrollbar-thumb {
        background-color: rgba(99, 102, 241, 0.6);
        border-radius: 4px;
      }
    </style>
  </head>
  <body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Mobile Menu Button -->
    <div class="p-4">
      <button
        class="md:hidden focus:outline-none focus:ring-2 focus:ring-indigo-600"
        id="mobile-menu-button"
      >
        <i class="fas fa-bars text-2xl text-indigo-700"></i>
      </button>
    </div>

    <!-- Mobile Sidebar -->
    <aside
      id="mobile-menu"
      class="md:hidden fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out"
    >
      <div class="p-6 flex flex-col items-center space-y-2 border-b border-gray-200">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-32 w-32" />
        <span class="font-semibold text-lg text-indigo-700">Bersihin.Sepatu</span>
      </div>
      <nav class="flex flex-col p-6 space-y-4">
        <a href="/admin/dashboard" class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900">
          <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
        </a>
        <a href="/admin/users" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
          <i class="fas fa-users w-5"></i><span>Users</span>
        </a>
        <a href="/admin/packages" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
          <i class="fas fa-tag w-5"></i><span>Paket Berlangganan</span>
        </a>
        <a href="/admin/courses" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
          <i class="fas fa-video w-5"></i><span>Video Courses</span>
        </a>
        <a href="/admin/subscriptions" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
          <i class="fas fa-user-shield w-5"></i><span>Subscriptions</span>
        </a>
        <a href="/admin/payments/history" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
          <i class="fas fa-money-check w-5"></i><span>Payments History</span>
        </a>
        <form method="POST" action="/logout" class="pt-6 border-t border-gray-200" onsubmit="return confirm('Yakin ingin logout?')">
          @csrf
          <button type="submit" class="w-full px-4 py-2 mt-4 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition">
            Logout
          </button>
        </form>
      </nav>
    </aside>

    <!-- Overlay -->
    <div id="mobile-overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-40" onclick="closeMobileMenu()"></div>

    <div class="flex">
      <!-- Desktop Sidebar -->
      <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 overflow-y-auto" aria-label="Sidebar">
        <div class="sticky top-0 bg-white z-10 border-b border-gray-200 p-6 flex flex-col items-center space-y-2">
          <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-40 w-40" />
          <span class="font-semibold text-xl text-indigo-700">Bersihin.Sepatu</span>
        </div>
        <nav class="flex flex-col p-6 space-y-4 sticky top-16">
          <p class="text-sm font-bold text-gray-400 mb-2">MENU</p>
          <a href="/admin/dashboard" class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900">
            <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
          </a>
          <a href="/admin/users" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-users w-5"></i><span>Users</span>
          </a>
          <a href="/admin/packages" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-tag w-5"></i><span>Paket Berlangganan</span>
          </a>
          <a href="/admin/courses" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-video w-5"></i><span>Video Courses</span>
          </a>
          <a href="/admin/quiz" 
          class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-solid fa-paperclip w-5"></i><span>Hasil Course</span>
            </a>
          <a href="/admin/subscriptions" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-user-shield w-5"></i><span>Subscriptions</span>
          </a>
          <a href="/admin/payments/history" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
            <i class="fas fa-money-check w-5"></i><span>Payments History</span>
          </a>
        </nav>
        <div class="p-6 border-t border-gray-200 mt-auto">
          <form method="POST" action="/logout" onsubmit="return confirm('Yakin ingin logout?')">
            @csrf
            <button type="submit" class="w-full px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition">
              Logout
            </button>
          </form>
        </div>
      </aside>

   <!-- Main Content -->
   <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto space-y-12">
    <!-- Dashboard Overview -->
    <section id="dashboard">
      <div class="flex justify-between">
     <h2 class="text-5xl font-bold text-indigo-700 mb-6">Dashboard Overview</h2>
     <div class="relative inline-block text-left">
        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
            <h3 class="text-gray-500 text-lg font-bold mr-3 uppercase">
                {{ Auth::user()->name }}
            </h3>
            <img alt="Profile Picture" class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/logo.jpg') }}" />
            <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
      </div>
      <div>
                        <h1 class="text-black font-bold text-xl select-none">
                            Hai, {{ Auth::user()->name }}
                        </h1>
                        <p class="text-black text-opacity-70 text-sm select-none mb-5">Welcome back!</p>
                    </div>
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">

    <!-- Total Users -->
    <a href="/admin/users" class="group">
        <div class="bg-white rounded-lg shadow p-10 flex flex-col items-center text-center hover:shadow-lg transition">
            <i class="fas fa-users text-indigo-600 text-6xl mb-3 group-hover:text-indigo-800"></i>
            <p class="text-gray-500">Total Users</p>
            <p class="text-3xl font-semibold text-indigo-700">{{ $totalUsers }}</p>
        </div>
    </a>

    <!-- Total Paket -->
    <a href="/admin/packages" class="group">
        <div class="bg-white rounded-lg shadow p-10 flex flex-col items-center text-center hover:shadow-lg transition">
            <i class="fas fa-tag text-indigo-600 text-6xl mb-3 group-hover:text-indigo-800"></i>
            <p class="text-gray-500">Total Paket</p>
            <p class="text-3xl font-semibold text-indigo-700">{{ $totalPackages }}</p>
        </div>
    </a>

    <!-- Total Video -->
    <a href="/admin/courses" class="group">
        <div class="bg-white rounded-lg shadow p-10 flex flex-col items-center text-center hover:shadow-lg transition">
            <i class="fas fa-video text-indigo-600 text-6xl mb-3 group-hover:text-indigo-800"></i>
            <p class="text-gray-500">Total Video</p>
            <p class="text-3xl font-semibold text-indigo-700">{{ $totalCourses }}</p>
        </div>
    </a>

    <!-- Payments -->
    <a href="/admin/payments/history" class="group">
        <div class="bg-white rounded-lg shadow p-10 flex flex-col items-center text-center hover:shadow-lg transition">
            <i class="fas fa-money-check text-indigo-600 text-6xl mb-3 group-hover:text-indigo-800"></i>
            <p class="text-gray-500">Payments History</p>
            <p class="text-3xl font-semibold text-indigo-700">{{ $totalPayments }}</p>
        </div>

    <!-- Active Subscriptions -->
    <a href="/admin/subscriptions" class="group">
        <div class="bg-white rounded-lg shadow p-10 flex flex-col items-center text-center hover:shadow-lg transition">
            <i class="fas fa-file-invoice-dollar text-indigo-600 text-6xl mb-3 group-hover:text-indigo-800"></i>
            <p class="text-gray-500">Active Subscriptions</p>
            <p class="text-3xl font-semibold text-indigo-700">{{ $totalSubscriptions }}</p>
        </div>
    </a>
</div>
                <div class="flex justify-center items-center">
                    <h2 class="text-5xl font-bold text-indigo-700 mb-5" >Pending Payments</h2>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto bg-white rounded shadow p-6">
                    <table class="min-w-full text-center border border-gray-300">
                        <thead>
                            <tr class="bg-indigo-600 text-white">
                                <th class="py-3 px-4 border">No</th>
                                <th class="py-3 px-4 border">Nama</th>
                                <th class="py-3 px-4 border">Email</th>
                                <th class="py-3 px-4 border">Paket</th>
                                <th class="py-3 px-4 border">Metode</th>
                                <th class="py-3 px-4 border">Bukti</th>
                                <th class="py-3 px-4 border">Status</th>
                                <th class="py-3 px-4 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr>
                                    <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border">{{ $payment->name }}</td>
                                    <td class="py-2 px-4 border">{{ $payment->email }}</td>
                                    <td class="py-2 px-4 border capitalize">{{ $payment->package->name ?? 'Tidak ada paket' }}</td>
                                    <td class="py-2 px-4 border">{{ ucfirst($payment->payment_method) }}</td>
                                    <td class="py-2 px-4 border">
                                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="text-indigo-600 underline">Lihat</a>
                                    </td>
                                    <td class="py-2 px-4 border capitalize">
                                        <span class="
                                            @if($payment->status == 'approved') text-green-600
                                            @elseif($payment->status == 'pending') text-yellow-500
                                            @else text-red-600
                                            @endif
                                        ">
                                            {{ $payment->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border">
                                        @if($payment->status == 'pending')
                                            <div class="flex justify-center space-x-2">
                                                <form action="{{ route('admin.dashboard.approve', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyetujui pembayaran ini?')">
                                                    @csrf
                                                    <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                                                </form>

                                                <form action="{{ route('admin.dashboard.reject', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                                                    @csrf
                                                    <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                                                </form>
                                            </div>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-gray-500">Belum ada data pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
    </section>
   </main>
  </div>

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
   const mobileMenu = document.getElementById("mobile-menu");
      const mobileOverlay = document.getElementById("mobile-overlay");
      const mobileMenuButton = document.getElementById("mobile-menu-button");

      function toggleMobileMenu() {
        mobileMenu.classList.toggle("-translate-x-full");
        mobileOverlay.classList.toggle("hidden");
      }

      function closeMobileMenu() {
        mobileMenu.classList.add("-translate-x-full");
        mobileOverlay.classList.add("hidden");
      }

      mobileMenuButton.addEventListener("click", toggleMobileMenu);

   // Logout button handlers (demo)
   const logoutBtn = document.getElementById("logoutBtn");
   const mobileLogoutBtn = document.getElementById("mobileLogoutBtn");
   function logout() {
    alert("Anda telah logout.");
   }
   if(logoutBtn) logoutBtn.addEventListener("click", logout);
   if(mobileLogoutBtn) mobileLogoutBtn.addEventListener("click", logout);

   function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }

    // Optional: tutup dropdown saat klik di luar
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