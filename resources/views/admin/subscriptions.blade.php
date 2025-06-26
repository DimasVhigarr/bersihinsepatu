<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bersihin.Sepatu - Subscriptions</title>
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
     </div>
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
      class="flex items-center space-x-3 text-indigo-700 font-semibold hover:text-indigo-900"
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
   <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto space-y-12">
    <section>
     <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
      <h2 class="text-5xl font-bold text-indigo-700">Subscriptions</h2>
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
         <th
          scope="col"
          class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider"
         >
          User Name
         </th>
         <th
          scope="col"
          class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider"
         >
          Paket
         </th>
         <th
          scope="col"
          class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider"
         >
          Status
         </th>
         <th
          scope="col"
          class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider"
         >
          Start Date
         </th>
         <th
          scope="col"
          class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider"
         >
          End Date
         </th>
         <th scope="col" class="relative px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">
          Actions
         </th>
        </tr>
       </thead>
       <tbody class="divide-y divide-gray-200">
        @foreach ($subscriptions as $subscription )
              <tr>
              <td>
                {{ $subscription->name }}
              </td>
              <td>
                {{ $subscription->package->name ?? '-' }}
              </td>
              <td>
                {{ $subscription->status }}
              </td>
              <td>
                {{ $subscription->start_date }}
              </td>
              <td>
                {{ $subscription->end_date }}
              </td>
            </tr>
            @endforeach
       </tbody>
      </table>
     </div>
    </section>
   </main>
  </div>

  <!-- Add/Edit Subscription Modal -->
  <div
   id="subscriptionModal"
   class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden"
   aria-modal="true"
   role="dialog"
   aria-labelledby="modalTitle"
  >
   <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4">
    <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
     <h3 id="modalTitle" class="text-xl font-semibold text-indigo-700">
      Add New Subscription
     </h3>
     <button
      id="closeModalBtn"
      class="text-gray-400 hover:text-gray-600 focus:outline-none"
      aria-label="Close modal"
     >
      <i class="fas fa-times text-2xl"></i>
     </button>
    </div>
    <form id="subscriptionForm" class="px-6 py-4 space-y-4">
     <div>
      <label for="subscriptionId" class="block text-sm font-medium text-gray-700"
       >Subscription ID</label
      >
      <input
       type="text"
       id="subscriptionId"
       name="subscriptionId"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
       placeholder="e.g. SUB006"
      />
     </div>
     <div>
      <label for="userName" class="block text-sm font-medium text-gray-700"
       >User Name</label
      >
      <input
       type="text"
       id="userName"
       name="userName"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
       placeholder="e.g. John Doe"
      />
     </div>
     <div>
      <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
      <input
       type="text"
       id="course"
       name="course"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
       placeholder="e.g. Basic Shoe Cleaning"
      />
     </div>
     <div>
      <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
      <select
       id="status"
       name="status"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
      >
       <option value="" disabled selected>Select status</option>
       <option value="Active">Active</option>
       <option value="Expired">Expired</option>
      </select>
     </div>
     <div>
      <label for="startDate" class="block text-sm font-medium text-gray-700"
       >Start Date</label
      >
      <input
       type="date"
       id="startDate"
       name="startDate"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
      />
     </div>
     <div>
      <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
      <input
       type="date"
       id="endDate"
       name="endDate"
       required
       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500"
      />
     </div>
     <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
      <button
       type="button"
       id="cancelBtn"
       class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
      >
       Cancel
      </button>
      <button
       type="submit"
       class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition"
      >
       Save
      </button>
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
   if(logoutBtn) logoutBtn.addEventListener("click", logout);
   if(mobileLogoutBtn) mobileLogoutBtn.addEventListener("click", logout);

   // Modal elements
   const openModalBtn = document.getElementById("openModalBtn");
   const subscriptionModal = document.getElementById("subscriptionModal");
   const closeModalBtn = document.getElementById("closeModalBtn");
   const cancelBtn = document.getElementById("cancelBtn");
   const subscriptionForm = document.getElementById("subscriptionForm");
   const subscriptionsTableBody = document.getElementById("subscriptionsTableBody");

   // State to track subscriptions and editing index
   let editingIndex = null;

   // Helper function to create status badge
   function createStatusBadge(status) {
    const span = document.createElement("span");
    span.classList.add(
     "inline-flex",
     "rounded-full",
     "px-2",
     "text-xs",
     "font-semibold",
     "leading-5"
    );
    if (status === "Active") {
     span.classList.add("bg-green-100", "text-green-800");
    } else if (status === "Expired") {
     span.classList.add("bg-red-100", "text-red-800");
    } else {
     span.classList.add("bg-gray-100", "text-gray-800");
    }
    span.textContent = status;
    return span;
   }

   // Render subscriptions table rows
   function renderSubscriptions() {
    subscriptionsTableBody.innerHTML = "";
    subscriptions.forEach((sub, index) => {
     const tr = document.createElement("tr");

     // Subscription ID
     const tdId = document.createElement("td");
     tdId.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
     tdId.textContent = sub.subscriptionId;
     tr.appendChild(tdId);

     // User Name
     const tdUser = document.createElement("td");
     tdUser.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
     tdUser.textContent = sub.userName;
     tr.appendChild(tdUser);

     // Course
     const tdCourse = document.createElement("td");
     tdCourse.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
     tdCourse.textContent = sub.course;
     tr.appendChild(tdCourse);

     // Status
     const tdStatus = document.createElement("td");
     tdStatus.className = "px-6 py-4 whitespace-nowrap text-sm";
     tdStatus.appendChild(createStatusBadge(sub.status));
     tr.appendChild(tdStatus);

     // Start Date
     const tdStart = document.createElement("td");
     tdStart.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-500";
     tdStart.textContent = sub.startDate;
     tr.appendChild(tdStart);

     // End Date
     const tdEnd = document.createElement("td");
     tdEnd.className = "px-6 py-4 whitespace-nowrap text-sm text-gray-500";
     tdEnd.textContent = sub.endDate;
     tr.appendChild(tdEnd);

     // Actions (Edit + Delete)
     const tdActions = document.createElement("td");
     tdActions.className = "px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end space-x-4";

     // Edit link
     const editLink = document.createElement("a");
     editLink.href = "#";
     editLink.className = "text-indigo-600 hover:text-indigo-900 cursor-pointer";
     editLink.textContent = "Edit";
     editLink.addEventListener("click", (e) => {
      e.preventDefault();
      openEditModal(index);
     });
     tdActions.appendChild(editLink);

     // Delete link
     const deleteLink = document.createElement("a");
     deleteLink.href = "#";
     deleteLink.className = "text-red-600 hover:text-red-900 cursor-pointer";
     deleteLink.textContent = "Delete";
     deleteLink.addEventListener("click", (e) => {
      e.preventDefault();
      if (confirm(`Apakah Anda yakin ingin menghapus subscription "${sub.subscriptionId}"?`)) {
       subscriptions.splice(index, 1);
       alert("Subscription berhasil dihapus.");
       renderSubscriptions();
      }
     });
     tdActions.appendChild(deleteLink);

     tr.appendChild(tdActions);

     subscriptionsTableBody.appendChild(tr);
    });
   }

   // Initial render
   renderSubscriptions();

   // Open modal for add or edit
   openModalBtn.addEventListener("click", () => {
    editingIndex = null;
    subscriptionModal.querySelector("#modalTitle").textContent = "Add New Subscription";
    subscriptionForm.reset();
    subscriptionForm.subscriptionId.disabled = false;
    subscriptionModal.classList.remove("hidden");
   });

   // Close modal function
   function closeModal() {
    subscriptionModal.classList.add("hidden");
    subscriptionForm.reset();
    editingIndex = null;
   }

   closeModalBtn.addEventListener("click", closeModal);
   cancelBtn.addEventListener("click", closeModal);

   // Open modal for editing subscription
   function openEditModal(index) {
    editingIndex = index;
    const sub = subscriptions[index];
    subscriptionModal.querySelector("#modalTitle").textContent = "Edit Subscription";
    subscriptionForm.subscriptionId.value = sub.subscriptionId;
    subscriptionForm.userName.value = sub.userName;
    subscriptionForm.course.value = sub.course;
    subscriptionForm.status.value = sub.status;
    subscriptionForm.startDate.value = sub.startDate;
    subscriptionForm.endDate.value = sub.endDate;
    subscriptionForm.subscriptionId.disabled = true; // ID should not be changed
    subscriptionModal.classList.remove("hidden");
   }

   // Form submit handler for add/edit
   subscriptionForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const subscriptionId = subscriptionForm.subscriptionId.value.trim();
    const userName = subscriptionForm.userName.value.trim();
    const course = subscriptionForm.course.value.trim();
    const status = subscriptionForm.status.value;
    const startDate = subscriptionForm.startDate.value;
    const endDate = subscriptionForm.endDate.value;

    if (
     !subscriptionId ||
     !userName ||
     !course ||
     !status ||
     !startDate ||
     !endDate
    ) {
     alert("Please fill in all fields.");
     return;
    }

    if (editingIndex === null) {
     // Check for duplicate subscriptionId
     if (subscriptions.some((s) => s.subscriptionId === subscriptionId)) {
      alert("Subscription ID already exists.");
      return;
     }
     // Add new subscription
     subscriptions.push({
      subscriptionId,
      userName,
      course,
      status,
      startDate,
      endDate,
     });
     alert("Subscription berhasil ditambahkan.");
    } else {
     // Update existing subscription
     subscriptions[editingIndex] = {
      subscriptionId,
      userName,
      course,
      status,
      startDate,
      endDate,
     };
     alert("Subscription berhasil diperbarui.");
    }

    renderSubscriptions();
    closeModal();
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