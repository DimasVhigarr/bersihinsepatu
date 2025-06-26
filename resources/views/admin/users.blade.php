<html lang="en">
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<title>Bersihin.Sepatu - Users</title>
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
      class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900"
     >
      <i class="fas fa-users w-5"></i>
      <span>Users</span>
     </a>
     <a
      href="/admin/packages"
      class="flex items-center space-x-3 text-gray-700 hover:text-indigo-700"
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
        <h2 class="text-5xl font-bold text-indigo-700">Users Management</h2>
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
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-indigo-100">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Email</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Status Langganan</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Tanggal Daftar</th>
              <th scope="col" class="relative px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user )
              <tr>
              <td>
                {{ $user->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                {{ $user->subscription_status }}
              </td>
              <td>
                {{ $user->created_at }}
              </td>
            </tr>
            @endforeach
            
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
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });

  // Logout button handlers (demo)
  const logoutBtn = document.getElementById("logoutBtn");
  const mobileLogoutBtn = document.getElementById("mobileLogoutBtn");
  function logout() {
    alert("Anda telah logout.");
  }
  logoutBtn.addEventListener("click", logout);
  mobileLogoutBtn.addEventListener("click", logout);

  // Users data and ID tracking
  let users = [
    { id: "001", name: "Andi Wijaya", email: "andi@example.com", status: "Aktif", date: "2023-11-15" },
  ];

  // Generate next user ID with leading zeros
  function getNextUserId() {
    let maxId = users.reduce((max, user) => {
      const num = parseInt(user.id, 10);
      return num > max ? num : max;
    }, 0);
    let nextId = (maxId + 1).toString().padStart(3, "0");
    return nextId;
  }

  // Render users table rows
  function renderUsers() {
    const tbody = document.getElementById("usersTableBody");
    tbody.innerHTML = "";
    users.forEach((user, index) => {
      const tr = document.createElement("tr");

      // ID
      const tdId = document.createElement("td");
      tdId.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
      tdId.textContent = user.id;
      tr.appendChild(tdId);

      // Name
      const tdName = document.createElement("td");
      tdName.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
      tdName.textContent = user.name;
      tr.appendChild(tdName);

      // Email
      const tdEmail = document.createElement("td");
      tdEmail.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-500";
      tdEmail.textContent = user.email;
      tr.appendChild(tdEmail);

      // Status
      const tdStatus = document.createElement("td");
      tdStatus.className = "px-6 py-4 whitespace-nowrap text-sm";
      const spanStatus = document.createElement("span");
      spanStatus.className =
        "inline-flex rounded-full px-2 text-xs font-semibold leading-5 " +
        (user.status === "Aktif" ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800");
      spanStatus.textContent = user.status;
      tdStatus.appendChild(spanStatus);
      tr.appendChild(tdStatus);

      // Date
      const tdDate = document.createElement("td");
      tdDate.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-500";
      tdDate.textContent = user.date;
      tr.appendChild(tdDate);

      // Actions (Edit + Delete)
      const tdActions = document.createElement("td");
      tdActions.className = "px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end space-x-4";

      // Edit link
      const aEdit = document.createElement("a");
      aEdit.href = "#";
      aEdit.className = "text-indigo-600 hover:text-indigo-900 cursor-pointer";
      aEdit.textContent = "Edit";
      aEdit.addEventListener("click", (e) => {
        e.preventDefault();
        openEditUserModal(index);
      });
      tdActions.appendChild(aEdit);

      // Delete link
      const aDelete = document.createElement("a");
      aDelete.href = "#";
      aDelete.className = "text-red-600 hover:text-red-900 cursor-pointer";
      aDelete.textContent = "Delete";
      aDelete.addEventListener("click", (e) => {
        e.preventDefault();
        if (confirm(`Apakah Anda yakin ingin menghapus user "${user.name}"?`)) {
          users.splice(index, 1);
          alert("User berhasil dihapus.");
          renderUsers();
        }
      });
      tdActions.appendChild(aDelete);

      tr.appendChild(tdActions);

      tbody.appendChild(tr);
    });
  }

  // Initial render
  renderUsers();

  // Modal elements
  const userModalBackdrop = document.getElementById("userModalBackdrop");
  const userModalTitle = document.getElementById("userModalTitle");
  const userForm = document.getElementById("userForm");
  const cancelUserBtn = document.getElementById("cancelUserBtn");

  // Form inputs
  const userNameInput = document.getElementById("userName");
  const userEmailInput = document.getElementById("userEmail");
  const userStatusSelect = document.getElementById("userStatus");
  const userDateInput = document.getElementById("userDate");

  // Error elements
  const nameError = document.getElementById("nameError");
  const emailError = document.getElementById("emailError");
  const statusError = document.getElementById("statusError");
  const dateError = document.getElementById("dateError");

  // State to track if editing and which user index
  let editingIndex = null;

  // Show add user modal
  const addUserBtn = document.getElementById("addUserBtn");
  addUserBtn.addEventListener("click", () => {
    editingIndex = null;
    userModalTitle.textContent = "Add New User";
    userForm.reset();
    clearErrors();
    // Reset select to placeholder
    userStatusSelect.value = "";
    userModalBackdrop.classList.remove("hidden");
  });

  // Cancel modal
  cancelUserBtn.addEventListener("click", () => {
    userModalBackdrop.classList.add("hidden");
  });

  // Validation helpers
  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\\.,;:\s@"]+\.)+[^<>()[\]\\.,;:\s@"]{2,})$/i;
    return re.test(String(email).toLowerCase());
  }
  function emailExists(email, excludeIndex = null) {
    return users.some((user, idx) => {
      if (excludeIndex !== null && idx === excludeIndex) return false;
      return user.email.toLowerCase() === email.toLowerCase();
    });
  }
  function toggleError(el, show) {
    if (el) {
      el.style.display = show ? "block" : "none";
    }
  }
  function clearErrors() {
    toggleError(nameError, false);
    toggleError(emailError, false);
    toggleError(statusError, false);
    toggleError(dateError, false);
  }

  // Open edit user modal with data
  function openEditUserModal(index) {
    editingIndex = index;
    const user = users[index];
    userModalTitle.textContent = "Edit User";
    userNameInput.value = user.name;
    userEmailInput.value = user.email;
    userStatusSelect.value = user.status;
    userDateInput.value = user.date;
    clearErrors();
    userModalBackdrop.classList.remove("hidden");
  }

  // Form submit handler for add/edit
  userForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = userNameInput.value.trim();
    const email = userEmailInput.value.trim();
    const status = userStatusSelect.value;
    const date = userDateInput.value;
    let valid = true;

    if (!name) {
      toggleError(nameError, true);
      valid = false;
    } else {
      toggleError(nameError, false);
    }
    if (!email || !validateEmail(email) || emailExists(email, editingIndex)) {
      toggleError(emailError, true);
      valid = false;
    } else {
      toggleError(emailError, false);
    }
    if (!status) {
      toggleError(statusError, true);
      valid = false;
    } else {
      toggleError(statusError, false);
    }
    if (!date) {
      toggleError(dateError, true);
      valid = false;
    } else {
      toggleError(dateError, false);
    }
    if (!valid) return;

    if (editingIndex === null) {
      // Add new user
      const newUser = {
        id: getNextUserId(),
        name,
        email,
        status,
        date
      };
      users.push(newUser);
      alert("User berhasil ditambahkan.");
    } else {
      // Edit existing user
      users[editingIndex].name = name;
      users[editingIndex].email = email;
      users[editingIndex].status = status;
      users[editingIndex].date = date;
      alert("User berhasil diperbarui.");
    }
    renderUsers();
    userModalBackdrop.classList.add("hidden");
  });

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