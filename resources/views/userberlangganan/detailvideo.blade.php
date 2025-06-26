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
        <a href="{{ url('/subs/beranda') }}">Beranda</a>
        <a href="{{ url('/subs/tentangkami') }}">Tentang Kami</a>
        <a href="{{ url('/subs/pelatihan') }}">Pelatihan</a>
        <a href="{{ url('/subs/kelola') }}">Kelola Akun</a>
      </div>

      <!-- Kondisi Login -->
      @auth
      <!-- Start Dropdown Profile -->
      <div class="hidden md:flex items-center relative">
        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
          <span class="text-indigo-700 font-semibold mr-2">{{ Auth::user()->name }}</span>
          <img alt="Profile Picture" class="h-10 w-10 rounded-full object-cover" src="{{ asset('images/user.jpg') }}" />
          <svg class="ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-12 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
          <a href="{{ url('/subs/kelola') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Akun</a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
          </form>
        </div>
      </div>
      <!-- End Dropdown Profile -->
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
</nav>
<body class="bg-gray-50 text-gray-800 font-sans">
{{-- Main context --}}
    <div class="max-w-4xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">{{ $course->title }}</h1>

    {{-- Video --}}
    <div class="w-full aspect-[16/9] mb-6 rounded shadow-lg overflow-hidden">
        <video 
            controls 
            class="w-full h-full object-cover"
            controlsList="nodownload nofullscreen noremoteplayback"
            disablePictureInPicture
        >
            <source src="{{ asset('storage/' . $course->video) }}" type="video/mp4">
            Browser Anda tidak mendukung pemutaran video.
        </video>
    </div>

    {{-- Deskripsi --}}
    <p class="text-gray-700 leading-relaxed text-center mb-10">{{ $course->description }}</p>

    {{-- Quiz --}}
    @if($course->quizzes->count())
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4 text-center">Quiz Course</h2>

 @php
    $quizAnswer = \App\Models\QuizAnswer::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->first();
@endphp

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 mb-6 rounded text-center">
        {{ session('success') }}
    </div>
@endif

@if($quizAnswer)
    <div class="text-center text-lg text-indigo-700 font-semibold mt-4">
        Anda sudah mengisi quiz ini. Skor Anda: {{ $quizAnswer->score }}.
    </div>

    <div class="text-center mt-4">
        <form method="POST" action="{{ route('quiz.retry', $course->id) }}">
            @csrf
            <button type="submit" class="text-red-600 underline hover:text-red-800 text-sm">
                Ulangi Quiz
            </button>
        </form>
    </div>
@else
    {{-- Form Quiz --}}
    <form method="POST" action="{{ route('quiz.submit', $course->id) }}">
        @csrf

        @foreach ($course->quizzes as $quiz)
            <div class="mb-6">
                <p class="font-semibold text-gray-800 mb-2">{{ $loop->iteration }}. {{ $quiz->question }}</p>
                <div class="space-y-2 pl-4">
                    <label class="block">
                        <input type="radio" name="answers[{{ $quiz->id }}]" value="A" required>
                        A. {{ $quiz->option_a }}
                    </label>
                    <label class="block">
                        <input type="radio" name="answers[{{ $quiz->id }}]" value="B">
                        B. {{ $quiz->option_b }}
                    </label>
                    <label class="block">
                        <input type="radio" name="answers[{{ $quiz->id }}]" value="C">
                        C. {{ $quiz->option_c }}
                    </label>
                    <label class="block">
                        <input type="radio" name="answers[{{ $quiz->id }}]" value="D">
                        D. {{ $quiz->option_d }}
                    </label>
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                Kirim Jawaban
            </button>
        </div>
    </form>
@endif
</div>
@endif
    
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

        // Disable alert on buttons for subscribed user
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if(btn.disabled) {
                    e.preventDefault();
                }
            });
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

    document.addEventListener("keydown", function(e) {
    // Blok PrintScreen
    if (e.key === "PrintScreen") {
      navigator.clipboard.writeText("");
      alert("Screenshot dinonaktifkan.");
      e.preventDefault();
    }
    // Blok Ctrl+S, Ctrl+U, F12, dll
    if ((e.ctrlKey && e.key === "s") || (e.ctrlKey && e.key === "u") || e.key === "F12") {
      alert("Akses ini dibatasi.");
      e.preventDefault();
    }
  });

  document.addEventListener("contextmenu", function (e) {
    e.preventDefault();
    alert("Klik kanan dinonaktifkan.");
  });

  window.addEventListener("blur", () => {
    document.body.style.filter = "blur(8px)";
  });
  window.addEventListener("focus", () => {
    document.body.style.filter = "none";
  });

  
  const video = document.querySelector('video');
    video.addEventListener('ended', function () {
        fetch("/video/{{ $course->id }}/watch", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({}) // boleh kosong
        }).then(res => {
            if (res.ok) {
                console.log("Video marked as watched.");
            }
        });
    });
  </script>
</body>
</html>
