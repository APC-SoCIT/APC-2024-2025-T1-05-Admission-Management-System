@section('title', 'Users | InnolabAMS')
@extends('application') <!-- Use the application layout -->

@section('content') <!-- Define the content section -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold mx-4 my-4">Users</h1>

        <div class="flex items-center space-x-4">
            <!-- Search Icon and Bar -->
            <div class="relative flex items-center">
                <button id="searchIcon"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="text" id="searchBar" placeholder="Search..."
                    class="absolute top-0 right-12 hidden bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-md w-64 focus:outline-none">
            </div>

            <!-- Sort Icon and Dropdown -->
            <div class="relative">
                <button id="sortIcon"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div id="sortDropdown"
                    class="absolute right-0 mt-2 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-40">
                    <button id="sortOldNew" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                        Old - New
                    </button>
                    <button id="sortNewOld" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                        New - Old
                    </button>
                </div>
            </div>

            <!-- Add User Button -->
            <button id="addUserButton"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                + Add User
            </button>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('user.show') }}"
                class="{{ request()->routeIs('user.show') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                All Users
            </a>
            <a href="{{ route('user.admin') }}"
                class="{{ request()->routeIs('user.admin') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Admin ({{ $adminCount ?? 0 }})
            </a>
            <a href="{{ route('user.staff') }}"
                class="{{ request()->routeIs('user.staff') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Staff ({{ $staffCount ?? 0 }})
            </a>
            <a href="{{ route('user.applicant') }}"
                class="{{ request()->routeIs('user.applicant') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Applicant ({{ $applicantCount ?? 0 }})
            </a>
        </nav>
    </div>

    <!-- Table -->
    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="w-1/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="w-2/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="w-3/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="w-3/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col"
                                        class="w-3/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        Date Created
                                    </th>
                                    <th scope="col"
                                        class="w-1/12 px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="userTable">
                                @forelse ($adminUsers as $admin)

                                    <tr>
                                        <td class="w-1/12 py-2 px-4 border-b text-center">{{ $admin->id }}</td>
                                        <td class="w-2/12 py-2 px-4 border-b text-center">{{ $admin->name }}</td>
                                        <td class="w-3/12 py-2 px-4 border-b text-center">{{ $admin->email }}</td>
                                        <td class="w-3/12 py-2 px-4 border-b text-center">{{ $admin->role }}</td>
                                        <td class="w-3/12 py-2 px-4 border-b text-center">
                                            {{ $admin->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="w-1/12 py-2 px-4 border-b text-center">
                                            <button class="text-red-600 py-1 px-2 rounded delete-button"
                                                data-id="{{ $admin->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-700">
            Showing {{ $adminUsers->firstItem() ?? 0 }} to {{ $adminUsers->lastItem() ?? 0 }} of {{ $adminUsers->total() }} applications
        </div>
        <div class="flex space-x-2">
            @if($adminUsers->previousPageUrl())
                <a href="{{ $adminUsers->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 text-gray-700">Previous</a>
            @endif

            <span class="px-3 py-1 rounded bg-blue-500 text-white">{{ $adminUsers->currentPage() }}</span>

            @if($adminUsers->hasMorePages())
                <a href="{{ $adminUsers->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 text-gray-700">Next</a>
            @endif
        </div>
    </div>
   

    <!-- Modal -->
    <div id="addUserModal" class="fixed z-10 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md">
                <div class="px-4 py-3 border-b flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">User Credentials</h3>
                    <button id="closeModalButton" class="text-gray-400 hover:text-gray-500">
                        ✕
                    </button>
                </div>
                <!-- Include the add user form -->
                <div class="px-4 py-6">
                    @include('auth.add-user')
                </div>
            </div>
        </div>
    </div>
@endsection



<script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("addUserModal");
        const addUserButton = document.getElementById("addUserButton");
        const closeModalButton = document.getElementById("closeModalButton");
        const searchIcon = document.getElementById("searchIcon");
        const searchBar = document.getElementById("searchBar");
        const userTable = document.getElementById("userTable");
        const sortIcon = document.getElementById("sortIcon");
        const sortDropdown = document.getElementById("sortDropdown");
        const sortOldNew = document.getElementById("sortOldNew");
        const sortNewOld = document.getElementById("sortNewOld");
        const deleteButtons = document.querySelectorAll(".delete-button");
        let sortOrder = "asc";

        // Modal Logic
        addUserButton.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        closeModalButton.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        // Search Bar Logic
        searchIcon.addEventListener("click", () => {
            if (searchBar.classList.contains("hidden")) {
                searchBar.classList.remove("hidden");
                searchBar.focus();
            } else {
                searchBar.classList.add("hidden");
            }
        });

        searchBar.addEventListener("input", () => {
            const filter = searchBar.value.toLowerCase();
            const rows = userTable.querySelectorAll("tr");

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const email = row.children[2].textContent.toLowerCase();

                if (name.includes(filter) || email.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Sort Dropdown Logic
        sortIcon.addEventListener("click", () => {
            sortDropdown.classList.toggle("hidden");
        });

        // Sort Old - New
        sortOldNew.addEventListener("click", () => {
            const rows = Array.from(userTable.querySelectorAll("tr"));
            rows.sort((a, b) => parseInt(a.children[0].textContent) - parseInt(b.children[0].textContent));
            rows.forEach(row => userTable.appendChild(row));
            sortDropdown.classList.add("hidden");
        });

        // Sort New - Old
        sortNewOld.addEventListener("click", () => {
            const rows = Array.from(userTable.querySelectorAll("tr"));
            rows.sort((a, b) => parseInt(b.children[0].textContent) - parseInt(a.children[0].textContent));
            rows.forEach(row => userTable.appendChild(row));
            sortDropdown.classList.add("hidden");
        });

        // Delete button
        deleteButtons.forEach(button => {
            button.addEventListener("click", () => {
                const userId = button.getAttribute("data-id");

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this user?")) {
                    // Send a delete request
                    fetch(`/users/${userId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                        },
                    })
                        .then(response => {
                            if (response.ok) {
                                // Reload the page or remove the row
                                button.closest("tr").remove();
                            } else {
                                alert("Failed to delete the user.");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                }
            });
        });
    }); 
</script>