<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Course - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
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
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 overflow-y-auto" aria-label="Sidebar">
            <div class="sticky top-0 bg-white z-10 border-b border-gray-200 p-6 flex flex-col items-center space-y-2">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-40 w-40" />
                <span class="font-semibold text-xl text-indigo-700">Bersihin.Sepatu</span>
            </div>
            <nav class="flex flex-col p-6 space-y-4 sticky top-16">
                <p class="text-sm font-bold text-gray-400 mb-2">MENU</p>
                <a href="/admin/dashboard" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
                    <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
                </a>
                <a href="/admin/users" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
                    <i class="fas fa-users w-5"></i><span>Users</span>
                </a>
                <a href="/admin/packages" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
                    <i class="fas fa-tag w-5"></i><span>Management Paket</span>
                </a>
                <a href="/admin/courses" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
                    <i class="fas fa-video w-5"></i><span>Management Courses</span>
                </a>
                <a href="/admin/quiz" class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900">
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
  <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto space-y-8">
    <section>
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-5xl font-bold text-indigo-700">Hasil Course</h2>
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

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nilai</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Klaim Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($results as $userId => $userResults)
                            @foreach ($userResults as $r)
                                <tr class="hover:bg-gray-50 align-top">
                                    {{-- Nama & Paket hanya ditampilkan di baris pertama user --}}
                                    @if ($loop->first)
                                        <td class="px-6 py-4 text-gray-800 font-semibold align-top" rowspan="{{ $userResults->count() }}">
                                            {{ $r->user->subscription->name ?? '-' }}
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-gray-800">{{ $r->course->title }}</td>
                                    <td class="px-6 py-4 text-gray-800">{{ $r->score }}</td>
                                    <td class="px-6 py-4">
                                        @if ($r->approved)
    <span class="inline-block text-green-700 bg-green-100 rounded px-2 py-1 text-xs">Disetujui</span>
@else
    <span class="inline-block text-red-700 bg-red-100 rounded px-2 py-1 text-xs">Tidak Lulus</span>
@endif

                                    </td>

                                    {{-- Kolom Klaim Sertifikat hanya ditampilkan di baris pertama user --}}
                                    @if ($loop->first)
    <td class="px-6 py-4 text-center align-top" rowspan="{{ $userResults->count() }}">
        @php
    $user = $r->user;
    $totalCourses = \App\Models\Course::count();
    $answeredCourses = $userResults->pluck('course_id')->unique()->count();
    $allScoresAbove70 = $userResults->every(fn($r) => $r->score >= 70);
@endphp

@if ($answeredCourses === $totalCourses && $allScoresAbove70)
    <span class="text-green-700 bg-green-100 px-3 py-1 rounded text-sm">Selesai</span>
@else
    <span class="text-yellow-700 bg-yellow-100 px-3 py-1 rounded text-sm">Belum Selesai</span>
@endif

    </td>
@endif

                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 px-6 py-4">Belum ada hasil quiz.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-indigo-700 text-indigo-200 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm">© 2024 Bersihin.Sepatu. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a aria-label="Whatsapp" class="hover:text-white" href="http://wa.me/message/GLB7CD3URGIHI1">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a aria-label="Instagram" class="hover:text-white" href="https://www.instagram.com/bersihin.sepatu">
                    <i class="fab fa-instagram"></i>
                </a>
                <a aria-label="TikTok" class="hover:text-white" href="https://www.tiktok.com/@bersihinsepatu.depok">
                    <i class="fab fa-tiktok"></i>
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
</body>
</html>
