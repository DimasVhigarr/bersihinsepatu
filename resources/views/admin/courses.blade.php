<!DOCTYPE html> 
<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bersihin.Sepatu - Courses</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
  <header class="p-4 flex justify-between items-center shadow-md bg-white md:hidden">
    <button id="mobile-menu-button" class="focus:outline-none">
      <i class="fas fa-bars text-2xl text-indigo-700"></i>
    </button>
    <span class="text-xl font-bold text-indigo-700">Courses</span>
  </header>

  <!-- Mobile Sidebar -->
  <div id="mobile-menu" class="md:hidden fixed inset-0 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-6 space-y-4">
      <div class="flex justify-between items-center mb-4">
        <span class="font-semibold text-xl text-indigo-700">Menu</span>
        <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-gray-900 text-xl">&times;</button>
      </div>
      <a href="/admin/dashboard" class="block text-gray-700 hover:text-indigo-700">Dashboard</a>
      <a href="/admin/users" class="block text-gray-700 hover:text-indigo-700">Users</a>
      <a href="/admin/packages" class="block text-gray-700 hover:text-indigo-700">Paket Berlangganan</a>
      <a href="/admin/courses" class="block font-semibold text-indigo-700 hover:text-indigo-900">Management Courses</a>
      <a href="/admin/subscriptions" class="block text-gray-700 hover:text-indigo-700">Subscriptions</a>
      <a href="/admin/payments/history" class="block text-gray-700 hover:text-indigo-700">Payments History</a>
      <form method="POST" action="/logout" onsubmit="return confirmLogout(event)">
        <!-- @csrf -->
        <button type="submit" class="w-full px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition">Logout</button>
      </form>
    </div>
  </div>

  <div class="flex flex-1">
    <!-- Desktop Sidebar -->
    <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 overflow-y-auto">
      <div class="sticky top-0 bg-white z-10 border-b border-gray-200 p-6 flex flex-col items-center space-y-2">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-40 w-40" />
        <span class="font-semibold text-xl text-indigo-700">Bersihin.Sepatu</span>
      </div>
      <nav class="flex flex-col p-6 space-y-4">
        <p class="text-sm font-bold text-gray-400 mb-2">MENU</p>
        <a href="/admin/dashboard" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
        <a href="/admin/users" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"><i class="fas fa-users w-5"></i><span>Users</span></a>
        <a href="/admin/packages" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"><i class="fas fa-tag w-5"></i><span>Management Paket</span></a>
        <a href="/admin/courses" class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900"><i class="fas fa-video w-5"></i><span>Management Courses</span></a>
        <a href="/admin/quiz" 
     class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700">
      <i class="fas fa-solid fa-paperclip w-5"></i><span>Hasil Course</span>
      </a>
        <a href="/admin/subscriptions" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"><i class="fas fa-user-shield w-5"></i><span>Subscriptions</span></a>
        <a href="/admin/payments/history" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"><i class="fas fa-money-check w-5"></i><span>Payments History</span></a>
      </nav>
      <div class="p-6 border-t border-gray-200 mt-auto">
        <form method="POST" action="/logout" onsubmit="return confirmLogout(event)">
          @csrf
          <button type="submit" class="w-full px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition">Logout</button>
        </form>
      </div>
    </aside>

   <!-- Main Content -->
<main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto space-y-8">
    <section>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-5xl font-bold text-indigo-700">Management Courses</h2>
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
          @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
            <button id="addCourseBtn" class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition mb-5">
                <i class="fas fa-plus mr-2"></i> Add Course
            </button>
        </div>

        {{-- Course Modal --}}
<div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full max-h-screen overflow-y-auto p-6 relative">
    <h3 class="text-xl font-semibold text-indigo-700 mb-4">Add Course</h3>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Title</label>
          <input type="text" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600"></textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Image</label>
          <input type="file" name="image" id="addImageInput" class="mt-1 block w-full rounded-md ...">
<small id="addImageError" class="text-red-500 text-sm"></small>

        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Video</label>
          <input type="file" name="video" id="addVideoInput" class="mt-1 block w-full rounded-md ...">
<small id="addVideoError" class="text-red-500 text-sm"></small>

        </div>

        {{-- Quiz Section --}}
        <div id="quiz-section" class="mt-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Quiz Questions (Pilihan Ganda)</label>
          <div id="quiz-list" class="space-y-4">
            <div class="quiz-item border p-4 rounded-md bg-gray-50 space-y-2">
              <input type="text" name="quiz_questions[0][question]" placeholder="Pertanyaan" class="w-full border rounded px-3 py-2" required />
              <input type="number" name="quiz_questions[0][appear_time]" placeholder="Muncul di detik ke-" class="w-full border rounded px-3 py-2" min="0" />

              <input type="text" name="quiz_questions[0][option_a]" placeholder="Pilihan A" class="w-full border rounded px-3 py-2" required />
              <input type="text" name="quiz_questions[0][option_b]" placeholder="Pilihan B" class="w-full border rounded px-3 py-2" required />
              <input type="text" name="quiz_questions[0][option_c]" placeholder="Pilihan C" class="w-full border rounded px-3 py-2" required />
              <input type="text" name="quiz_questions[0][option_d]" placeholder="Pilihan D" class="w-full border rounded px-3 py-2" required />

              <label class="block text-sm mt-1">Jawaban Benar</label>
              <select name="quiz_questions[0][correct_answer]" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Jawaban Benar --</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
              <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:underline text-sm mt-1">Hapus Pertanyaan</button>
            </div>
          </div>
          <button type="button" onclick="addQuiz()" class="mt-2 px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600">+ Tambah Pertanyaan</button>
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
          <button type="button" id="cancelBtn" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Cancel</button>
          <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Video</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Quiz</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($courses as $course)
                    <tr>
                        <td class="px-6 py-4">{{ $course->title }}</td>
                        <td class="px-6 py-4">{{ $course->description }}</td>
                        <td class="px-6 py-4">
                            @if($course->image)
                            <img src="{{ asset('storage/'.$course->image) }}" alt="Course Image" class="h-16 w-16 object-cover rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($course->video)
                                <a href="{{ asset('storage/'.$course->video) }}" target="_blank" class="text-indigo-600">Lihat Video</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($course->quizzes->count())
                                <a href="{{ route('admin.courses.quizzes', $course->id) }}" target="_blank" class="text-indigo-600 hover:underline">Lihat Quiz</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                      <a href="#"
                        class="text-blue-500 hover:underline" 
                        data-modal-target="editModal-{{ $course->id }}" 
                        data-modal-toggle="editModal-{{ $course->id }}"
                        data-course-id="{{ $course->id }}"> {{-- ✅ Tambahkan ini --}}
                        Edit
                      </a>

                      <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin ingin menghapus course ini?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-500 hover:underline">Delete</button>
                      </form>
                  </td>
                    </tr>
<!-- Modal Edit Course -->
<div id="editModal-{{ $course->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <button onclick="document.getElementById('editModal-{{ $course->id }}').classList.add('hidden')" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

        <h3 class="text-xl font-bold text-indigo-700 mb-4">Edit Course</h3>

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-semibold">Judul</label>
                <input type="text" name="title" value="{{ $course->title }}" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ $course->description }}</textarea>
            </div>

            <!-- Gambar -->
            <div class="mb-4">
                <label class="block text-sm font-semibold">Gambar Saat Ini</label>
                @if ($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" alt="Image" class="h-16 w-16 rounded mb-2">
                @else
                    <p class="text-sm text-gray-500">-</p>
                @endif

                <div class="mt-1">
                    <input type="file" name="image" id="editImageInput-{{ $course->id }}" class="block w-full">
                    <small id="editImageError-{{ $course->id }}" class="text-red-500 text-sm block mt-1"></small>
                </div>
            </div>


            <!-- Video -->
            <div class="mb-4">
                <label class="block text-sm font-semibold">Video Saat Ini</label>
                @if ($course->video)
                    <a href="{{ asset('storage/' . $course->video) }}" class="text-indigo-600 inline-block mb-2" target="_blank">Lihat Video</a>
                @else
                    <p class="text-sm text-gray-500">-</p>
                @endif

                <div class="mt-1">
                    <input type="file" name="video" id="editVideoInput-{{ $course->id }}" class="block w-full">
                    <small id="editVideoError-{{ $course->id }}" class="text-red-500 text-sm block mt-1"></small>
                </div>
            </div>


            <!-- Quiz Lama -->
        <div class="mt-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Quiz Questions (Lama)</label>
          <div class="space-y-4">
            @foreach ($course->quizzes as $index => $quiz)
  <div class="quiz-item border p-4 rounded-md bg-gray-50 space-y-2">
    <input type="hidden" name="quiz_questions[{{ $quiz->id }}][id]" value="{{ $quiz->id }}">
    <input type="hidden" name="quiz_questions[{{ $quiz->id }}][delete]" class="quiz-delete-flag" value="0">

    <input type="text" name="quiz_questions[{{ $quiz->id }}][question]" placeholder="Pertanyaan" value="{{ $quiz->question }}" class="w-full border rounded px-3 py-2" required />

    {{-- Tambahkan appear_time --}}
    <input type="number" name="quiz_questions[{{ $quiz->id }}][appear_time]" placeholder="Muncul di detik ke-" value="{{ $quiz->appear_time }}" class="w-full border rounded px-3 py-2" min="0" />

    <input type="text" name="quiz_questions[{{ $quiz->id }}][option_a]" placeholder="Pilihan A" value="{{ $quiz->option_a }}" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[{{ $quiz->id }}][option_b]" placeholder="Pilihan B" value="{{ $quiz->option_b }}" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[{{ $quiz->id }}][option_c]" placeholder="Pilihan C" value="{{ $quiz->option_c }}" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[{{ $quiz->id }}][option_d]" placeholder="Pilihan D" value="{{ $quiz->option_d }}" class="w-full border rounded px-3 py-2" required />

    <label class="block text-sm mt-1">Jawaban Benar</label>
    <select name="quiz_questions[{{ $quiz->id }}][correct_answer]" class="w-full border rounded px-3 py-2" required>
      <option value="">-- Pilih Jawaban Benar --</option>
      @foreach(['A','B','C','D'] as $opt)
        <option value="{{ $opt }}" @if(strtoupper($quiz->correct_answer) == $opt) selected @endif>{{ $opt }}</option>
      @endforeach
    </select>

    {{-- Tombol Hapus --}}
    <button type="button" onclick="hapusQuizLama(this)" class="text-red-500 hover:underline text-sm mt-1">Hapus Pertanyaan</button>
  </div>
@endforeach

          </div>
        </div>



                <!-- Tambah Quiz Baru (Hidden until button clicked) -->
        <div x-data="{ showNewQuiz: false }" class="mt-4">
          <button type="button"
            @click="showNewQuiz = !showNewQuiz"
            class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 mb-2">
            + Tambah Pertanyaan
          </button>

          <div x-show="showNewQuiz" class="space-y-4" x-transition>
  <div class="quiz-item border p-4 rounded-md bg-gray-50 space-y-2">
    <input type="text" name="quiz_questions[new_1][question]" placeholder="Pertanyaan" class="w-full border rounded px-3 py-2" />

    <input type="number" name="quiz_questions[new_1][appear_time]" placeholder="Muncul di detik ke-" class="w-full border rounded px-3 py-2" min="0" />

    <input type="text" name="quiz_questions[new_1][option_a]" placeholder="Pilihan A" class="w-full border rounded px-3 py-2" />
    <input type="text" name="quiz_questions[new_1][option_b]" placeholder="Pilihan B" class="w-full border rounded px-3 py-2" />
    <input type="text" name="quiz_questions[new_1][option_c]" placeholder="Pilihan C" class="w-full border rounded px-3 py-2" />
    <input type="text" name="quiz_questions[new_1][option_d]" placeholder="Pilihan D" class="w-full border rounded px-3 py-2" />

    <label class="block text-sm mt-1">Jawaban Benar</label>
    <select name="quiz_questions[new_1][correct_answer]" class="w-full border rounded px-3 py-2">
      <option value="">-- Pilih Jawaban Benar --</option>
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
    </select>
  </div>
</div>

        </div>



            <!-- Tombol Simpan dan Batal -->
        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
          <button type="button" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition" onclick="document.getElementById('editModal-{{ $course->id }}').classList.add('hidden')">Cancel</button>
          <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>


    @endforeach  {{-- ✅ Ini yang wajib ditambahkan --}}
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
  // Inisialisasi map index quiz edit (penting: letakkan di awal!)
  let quizEditIndexMap = {};

  // Mobile menu toggle
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  }

  // Toggle user dropdown menu
  function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    if (dropdown) {
      dropdown.classList.toggle("hidden");
    }
  }

  // Close dropdown if clicked outside
  window.addEventListener("click", function (e) {
    const dropdown = document.getElementById("dropdownMenu");
    const button = document.querySelector('button[onclick="toggleDropdown()"]');
    if (
      dropdown &&
      button &&
      !dropdown.contains(e.target) &&
      !button.contains(e.target)
    ) {
      dropdown.classList.add("hidden");
    }
  });

  // Open Add Course Modal
  const openBtn = document.getElementById("addCourseBtn");
  const modal = document.getElementById("addCourseModal");
  const closeBtn = document.getElementById("cancelBtn");

  if (openBtn && modal) {
    openBtn.addEventListener("click", () => {
      modal.classList.remove("hidden");
    });
  }

  if (closeBtn && modal) {
    closeBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
    });
  }

  // Untuk tombol modal edit per course
  document.querySelectorAll("[data-modal-toggle]").forEach((button) => {
  button.addEventListener("click", function () {
    const target = this.getAttribute("data-modal-target");
    if (target) {
      const modalTarget = document.getElementById(target);
      if (modalTarget) {
        modalTarget.classList.remove("hidden");

        // ✅ Reset index saat buka ulang modal
        const courseId = this.getAttribute("data-course-id");
        if (courseId) {
          const quizList = document.getElementById(`edit-quiz-list-${courseId}`);
          quizEditIndexMap[courseId] = quizList?.querySelectorAll(".quiz-item").length || 0;
        }
      }
    }
  });
});


  // Quiz untuk modal ADD
  let quizIndex = document.querySelectorAll("#quiz-list .quiz-item").length;

  function addQuiz() {
  const quizList = document.getElementById("quiz-list");
  const quizItem = document.createElement("div");
  quizItem.className = "quiz-item border p-4 rounded-md bg-gray-50 space-y-2";

  quizItem.innerHTML = `
    <input type="text" name="quiz_questions[${quizIndex}][question]" placeholder="Pertanyaan" class="w-full border rounded px-3 py-2" required />
    <input type="number" name="quiz_questions[${quizIndex}][appear_time]" placeholder="Muncul di detik ke-" class="w-full border rounded px-3 py-2" min="0" />

    <input type="text" name="quiz_questions[${quizIndex}][option_a]" placeholder="Pilihan A" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[${quizIndex}][option_b]" placeholder="Pilihan B" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[${quizIndex}][option_c]" placeholder="Pilihan C" class="w-full border rounded px-3 py-2" required />
    <input type="text" name="quiz_questions[${quizIndex}][option_d]" placeholder="Pilihan D" class="w-full border rounded px-3 py-2" required />
    
    <label class="block text-sm mt-1">Jawaban Benar</label>
    <select name="quiz_questions[${quizIndex}][correct_answer]" class="w-full border rounded px-3 py-2" required>
      <option value="">-- Pilih Jawaban Benar --</option>
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
    </select>
    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:underline text-sm mt-1">Hapus Pertanyaan</button>
  `;

  quizList.appendChild(quizItem);
  quizIndex++;
}


  window.addQuiz = addQuiz; // agar bisa dipanggil dari HTML

//   // Quiz untuk modal EDIT
//   function addQuizEdit(courseId) {
//   const quizList = document.getElementById(`edit-quiz-list-${courseId}`);
//   if (!quizList) return;

//   if (!quizEditIndexMap[courseId]) {
//     quizEditIndexMap[courseId] = quizList.querySelectorAll('.quiz-item').length;
//   }

//   const index = quizEditIndexMap[courseId]++;

//   const html = `
//     <div class="quiz-item border p-4 rounded-md bg-gray-50 space-y-2">
//       <input type="text" name="quiz_questions[${index}][question]" placeholder="Pertanyaan" class="w-full border rounded px-3 py-2" required />
//       <input type="text" name="quiz_questions[${index}][option_a]" placeholder="Pilihan A" class="w-full border rounded px-3 py-2" required />
//       <input type="text" name="quiz_questions[${index}][option_b]" placeholder="Pilihan B" class="w-full border rounded px-3 py-2" required />
//       <input type="text" name="quiz_questions[${index}][option_c]" placeholder="Pilihan C" class="w-full border rounded px-3 py-2" required />
//       <input type="text" name="quiz_questions[${index}][option_d]" placeholder="Pilihan D" class="w-full border rounded px-3 py-2" required />

//       <label class="block text-sm mt-1">Jawaban Benar</label>
//       <select name="quiz_questions[${index}][correct_answer]" class="w-full border rounded px-3 py-2" required>
//         <option value="">-- Pilih Jawaban Benar --</option>
//         <option value="A">A</option>
//         <option value="B">B</option>
//         <option value="C">C</option>
//         <option value="D">D</option>
//       </select>

//       <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:underline text-sm mt-1">Hapus Pertanyaan</button>
//     </div>
//   `;

//   quizList.insertAdjacentHTML("beforeend", html);
// }


//   window.addQuizEdit = addQuizEdit;

function hapusQuizLama(button) {
  const container = button.closest('.quiz-item');
  const deleteInput = container.querySelector('.quiz-delete-flag');
  if (deleteInput) {
    deleteInput.value = 1;
    container.classList.add('hidden');
  }
}

document.addEventListener('DOMContentLoaded', function () {
    // ADD COURSE
    const addImageInput = document.getElementById('addImageInput');
    const addVideoInput = document.getElementById('addVideoInput');
    const addImageError = document.getElementById('addImageError');
    const addVideoError = document.getElementById('addVideoError');

    if (addImageInput) {
        addImageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.size > 10 * 1024 * 1024) {
                addImageError.textContent = 'Ukuran gambar maksimal 10MB!';
                this.value = '';
            } else {
                addImageError.textContent = '';
            }
        });
    }

    if (addVideoInput) {
        addVideoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.size > 50 * 1024 * 1024) {
                addVideoError.textContent = 'Ukuran video maksimal 50MB!';
                this.value = '';
            } else {
                addVideoError.textContent = '';
            }
        });
    }

    // EDIT COURSE: jalankan untuk setiap course
    @foreach ($courses as $course)
        const editImageInput{{ $course->id }} = document.getElementById('editImageInput-{{ $course->id }}');
        const editVideoInput{{ $course->id }} = document.getElementById('editVideoInput-{{ $course->id }}');
        const editImageError{{ $course->id }} = document.getElementById('editImageError-{{ $course->id }}');
        const editVideoError{{ $course->id }} = document.getElementById('editVideoError-{{ $course->id }}');

        if (editImageInput{{ $course->id }}) {
            editImageInput{{ $course->id }}.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 10 * 1024 * 1024) {
                    editImageError{{ $course->id }}.textContent = 'Ukuran gambar maksimal 10MB!';
                    this.value = '';
                } else {
                    editImageError{{ $course->id }}.textContent = '';
                }
            });
        }

        if (editVideoInput{{ $course->id }}) {
            editVideoInput{{ $course->id }}.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 50 * 1024 * 1024) {
                    editVideoError{{ $course->id }}.textContent = 'Ukuran video maksimal 50MB!';
                    this.value = '';
                } else {
                    editVideoError{{ $course->id }}.textContent = '';
                }
            });
        }
    @endforeach
});



</script>

 </body>
</html>