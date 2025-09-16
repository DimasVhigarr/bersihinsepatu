<html lang="en">
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<title>Bersihin.Sepatu - Payments History</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
<style>
  body {
    font-family: "Inter", sans-serif;
  }
  /* Scrollbar for sidebar */
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
</nav>
<div class="flex flex-1">
   <!-- Sidebar -->
   <aside
    class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 overflow-y-auto"
    aria-label="Sidebar"
   >
    <div class="sticky top-0 bg-white z-10 border-b border-gray-200 p-6 flex flex-col items-center space-y-2">
     <img
      alt="Logo Bersihin.Sepatu, a stylized shoe cleaning brush with sparkling clean shoes in blue and white colors"
      class="h-40 w-40"
    
      src="{{ asset('images/logo.jpg') }}"
    
     />
     <span class="font-semibold text-xl text-indigo-700">
      Bersihin.Sepatu
     </span>
    </div>
    <nav class="flex flex-col p-6 space-y-4 sticky top-16">
    <p class="text-sm font-bold text-gray-400 mb-2">MENU</p>
     <a
      href="/admin/dashboard"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-tachometer-alt w-5"></i>
      <span>Dashboard</span>
     </a>
     <a
      href="/admin/users"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-users w-5"></i>
      <span>Users</span>
     </a>
     <a
      href="/admin/packages"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-tag w-5"></i>
      <span>Management Paket</span>
     </a>
     <a
      href="/admin/courses"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-video w-5"></i>
      <span>Management Courses</span>
     </a>
     <a href="/admin/quiz" 
     class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
      <i class="fas fa-solid fa-paperclip w-5"></i><span>Hasil Course</span>
      </a>
     <a
      href="/admin/subscriptions"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-user-shield w-5"></i>
      <span>Subscriptions</span>
     </a>
     <a
      href="/admin/payments/history"
      class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900"
     >
      <i class="fas fa-money-check w-5"></i>
      <span>Payments History</span>
     </a>
     </nav>
    <div class="p-6 border-t border-gray-200 mt-auto">
     <form method="POST" action="/logout" onsubmit="return confirmLogout(event)">
      @csrf
      <button
       type="submit"
       class="w-full px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition"
      >
       Logout
      </button>
     </form>
    </div>
   </aside>
  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto space-y-8">
    <section>
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-5xl font-bold text-indigo-700">Payments History</h2>
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
      <div class="overflow-x-auto bg-white rounded-lg shadow">
        <div class="flex justify-end mb-6">
  <form method="GET" action="{{ route('admin.payments.history') }}" class="flex items-end flex-wrap gap-4">
    <div>
  <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
  <input 
    type="text" 
    name="name" 
    id="name" 
    value="{{ request('name') }}" 
    placeholder="Cari nama..." 
    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
  />
</div>
    <div>
        <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
        <select name="month" id="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">Semua</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endfor
        </select>
    </div>

    <div>
        <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
        <select name="year" id="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="">Semua</option>
            @for ($y = now()->year; $y >= 2022; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </div>

    <div class="flex items-center gap-2">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Filter
        </button>
        <a href="{{ route('admin.payments.history') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
            Reset
        </a>
    </div>
</form>

</div>

        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-indigo-100">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Email</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Paket</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Metode</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Bukti</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Tanggal</th>
            </tr>
          </thead>
          <tbody>
                    @forelse ($allPayments as $index => $payment)
                        <tr class="text-center">
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
                                {{ $payment->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-gray-500 text-center">Tidak ada riwayat pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
<!-- Add/Edit User Modal backdrop -->
<div id="userModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 flex items-center justify-center">
  <!-- Add/Edit User Modal -->
  <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative" role="dialog" aria-modal="true" aria-labelledby="userModalTitle">
    <h3 id="userModalTitle" class="text-xl font-semibold text-indigo-700 mb-4">Add New User</h3>
    <form id="userForm" class="space-y-4" novalidate>
      <div>
        <label for="userName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" id="userName" name="userName" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600" placeholder="Masukkan nama lengkap" />
        <p class="mt-1 text-xs text-red-600 hidden" id="nameError">Nama wajib diisi.</p>
      </div>
      <div>
        <label for="userEmail" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="userEmail" name="userEmail" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600" placeholder="Masukkan email" />
        <p class="mt-1 text-xs text-red-600 hidden" id="emailError">Email tidak valid atau sudah digunakan.</p>
      </div>
      <div>
        <label for="userStatus" class="block text-sm font-medium text-gray-700">Status Langganan</label>
        <select id="userStatus" name="userStatus" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600">
          <option value="" disabled selected>Pilih status</option>
          <option value="Aktif">Aktif</option>
          <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
        <p class="mt-1 text-xs text-red-600 hidden" id="statusError">Status wajib dipilih.</p>
      </div>
      <div>
        <label for="userDate" class="block text-sm font-medium text-gray-700">Tanggal Daftar</label>
        <input type="date" id="userDate" name="userDate" required class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600" />
        <p class="mt-1 text-xs text-red-600 hidden" id="dateError">Tanggal wajib diisi.</p>
      </div>
      <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
        <button type="button" id="cancelUserBtn" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">Save</button>
      </div>
    </form>
  </div>
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
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = event.target.closest('button');

        if (!event.target.closest('#dropdownMenu') && !event.target.closest('button[onclick="toggleDropdown()"]')) {
            dropdown.classList.add('hidden');
        }
    });
  </script>