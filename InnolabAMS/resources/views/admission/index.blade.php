@extends('dashboard')
@section('title', 'Applications | InnolabAMS')

@section('content')
<!-- Title Section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Applications</h1>

    <div class="flex items-center space-x-4">
        <!-- Search Icon and Bar -->
        <div class="relative flex items-center">
            <button id="searchIcon"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fas fa-search"></i>
            </button>
            <input type="text"
                   id="searchInput"
                   placeholder="Search..."
                   class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-md w-64 focus:outline-none ml-2 hidden transition-all duration-300">
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

        <!-- Add Applicant Button -->
        <a href="{{ route('admission.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i>Add Applicant
        </a>
    </div>
</div>


<!-- Table Section -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="applicantsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Sex</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Program</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Email Address</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Contact No.</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($applicants as $applicant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->gender }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->apply_program }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $applicant->applicant_mobile_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('admission.show', $applicant->id) }}"
                               class="text-blue-600 hover:text-blue-800 underline">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
   document.addEventListener("DOMContentLoaded", () => {
        const searchIcon = document.getElementById("searchIcon");
        const searchInput = document.getElementById("searchInput");
        const applicantsTable = document.getElementById("applicantsTable");
        const sortIcon = document.getElementById("sortIcon");
        const sortDropdown = document.getElementById("sortDropdown");
        const sortOldNew = document.getElementById("sortOldNew");
        const sortNewOld = document.getElementById("sortNewOld");

        // Toggle search bar
        searchIcon.addEventListener("click", () => {
            searchInput.classList.toggle("hidden");
            if (!searchInput.classList.contains("hidden")) {
                searchInput.focus();
            }
        });

        // Close search bar when clicking outside
        document.addEventListener("click", (e) => {
            if (!searchInput.contains(e.target) && !searchIcon.contains(e.target)) {
                searchInput.classList.add("hidden");
            }
        });

        // Search functionality
        function performSearch() {
            const filter = searchInput.value.toLowerCase();
            const tbody = applicantsTable.getElementsByTagName("tbody")[0];
            const rows = tbody.getElementsByTagName("tr");

            Array.from(rows).forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[4].textContent.toLowerCase();
                const program = row.cells[3].textContent.toLowerCase();

                if (name.includes(filter) ||
                    email.includes(filter) ||
                    program.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        // Add event listeners for search
        searchInput.addEventListener("input", performSearch);
        searchInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                performSearch();
            }
        });

        // Sort functionality (unchanged)
        sortIcon.addEventListener("click", () => {
            sortDropdown.classList.toggle("hidden");
        });

        sortOldNew.addEventListener("click", () => {
            const tbody = applicantsTable.getElementsByTagName("tbody")[0];
            const rows = Array.from(tbody.getElementsByTagName("tr"));

            rows.sort((a, b) => parseInt(a.cells[0].textContent) - parseInt(b.cells[0].textContent));

            rows.forEach(row => tbody.appendChild(row));
            sortDropdown.classList.add("hidden");
        });

        sortNewOld.addEventListener("click", () => {
            const tbody = applicantsTable.getElementsByTagName("tbody")[0];
            const rows = Array.from(tbody.getElementsByTagName("tr"));

            rows.sort((a, b) => parseInt(b.cells[0].textContent) - parseInt(a.cells[0].textContent));

            rows.forEach(row => tbody.appendChild(row));
            sortDropdown.classList.add("hidden");
        });
    });
</script>
@endpush
@endsection
