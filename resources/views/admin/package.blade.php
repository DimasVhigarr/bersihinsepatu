<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bersihin.Sepatu - Courses</title>
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
     <button
      class="md:hidden focus:outline-none focus:ring-2 focus:ring-indigo-600"
      id="mobile-menu-button"
     >
      <i class="fas fa-bars text-2xl text-indigo-700"></i>
     </button>
    </div>
   </div>
  </nav>

  <div class="flex ">
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
      class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900"
     >
      <i class="fas fa-tag w-5"></i>
      <span>Paket Berlangganan</span>
     </a>
     <a
      href="/admin/courses"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
     >
      <i class="fas fa-video w-5"></i>
      <span>Video Courses</span>
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
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
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
            <h2 class="text-5xl font-bold text-indigo-700">Manajemen Paket</h2>
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
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <button id="addPackageBtn" class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition mb-5">
            <i class="fas fa-plus mr-2"></i> Tambah Paket
        </button>

        <div id="addPackageModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                <button onclick="toggleAddModal()" class="absolute top-2 right-4 text-gray-500 text-xl">&times;</button>
                <h3 class="text-xl font-semibold text-indigo-700 mb-4">Tambah Paket Baru</h3>
                <form method="POST" action="{{ route('admin.packages.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Nama Paket</label>
                            <input type="text" name="name" required class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Deskripsi</label>
                            <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Harga</label>
                            <input type="number" name="price" step="0.01" required class="w-full border px-3 py-2 rounded">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200 mt-4">
                        <button type="button" onclick="toggleAddModal()" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($packages as $package)
                        <tr>
                            <td class="px-6 py-4">{{ $package->name }}</td>
                            <td class="px-6 py-4">{{ $package->description }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" onclick="openEditModal({{ $package->id }})" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <div id="editModal-{{ $package->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">
                            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                                <button onclick="closeEditModal({{ $package->id }})" class="absolute top-2 right-4 text-gray-500 text-xl">&times;</button>
                                <h3 class="text-xl font-semibold text-indigo-700 mb-4">Edit Paket</h3>
                                <form method="POST" action="{{ route('admin.packages.update', $package->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium">Nama Paket</label>
                                            <input type="text" name="name" value="{{ $package->name }}" required class="w-full border px-3 py-2 rounded">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Deskripsi</label>
                                            <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded">{{ $package->description }}</textarea>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Harga</label>
                                            <input type="number" name="price" step="0.01" value="{{ $package->price }}" required class="w-full border px-3 py-2 rounded">
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200 mt-4">
                                        <button type="button" onclick="closeEditModal({{ $package->id }})" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">Batal</button>
                                        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
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

    function toggleAddModal() {
        document.getElementById('addPackageModal').classList.toggle('hidden');
    }

    function openEditModal(id) {
        document.getElementById('editModal-' + id).classList.remove('hidden');
    }

    function closeEditModal(id) {
        document.getElementById('editModal-' + id).classList.add('hidden');
    }

    document.getElementById('addPackageBtn').addEventListener('click', toggleAddModal);
</script>

 </body>
</html>