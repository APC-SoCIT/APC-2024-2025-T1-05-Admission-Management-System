@extends('dashboard')
@section('title', 'Applications | InnolabAMS')

@section('content')
<!-- Title Section -->
<div class="mb-4">
    <h1 class="text-2xl font-semibold">Applications</h1>
</div>

<!-- Filter and Action Buttons -->
<div class="flex justify-between items-center mb-4">
    <!-- Filter Options with increased spacing -->
    <div class="flex space-x-16">
    <button id="allButton" class="text-gray-600 hover:text-gray-900">All</button>
    <button id="sortByButton" class="text-gray-600 hover:text-gray-900">Sort by</button>
</div>

    <!-- Action Buttons -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admission.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i>Add Applicant
        </a>

        <button id="searchIcon"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        <div class="relative">
            <button id="menuIcon" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fa-solid fa-bars"></i>
                </button>
                <div id="menuDropdown" class="absolute right-0 mt-2 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-40 z-10">
                <button id="sortOldNew" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    Old - New
                </button>
                <button id="sortNewOld" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    New - Old
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar (Hidden by default) -->
<div class="relative mb-4">
    <input type="text" id="searchBar" placeholder="Search..."
        class="hidden w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
        const searchBar = document.getElementById("searchBar");
        const applicantsTable = document.getElementById("applicantsTable");
        const menuIcon = document.getElementById("menuIcon");
        const menuDropdown = document.getElementById("menuDropdown");
        const sortOldNew = document.getElementById("sortOldNew");
        const sortNewOld = document.getElementById("sortNewOld");
        const allButton = document.getElementById("allButton");
        const sortByButton = document.getElementById("sortByButton");

        // Initialize "All" as active
        allButton.classList.add('underline');

            // Sort By button functionality
        sortByButton.addEventListener("click", () => {
            sortByButton.classList.add('underline');
            allButton.classList.remove('underline');
            // Add your sort logic here
        });

        // All button functionality
        allButton.addEventListener("click", () => {
            allButton.classList.add('underline');
            sortByButton.classList.remove('underline');
            // Reset to default view
        });

        // Search Bar Logic
            menuIcon.addEventListener("click", () => {
            menuDropdown.classList.toggle("hidden");
        });

        searchBar.addEventListener("input", () => {
            const filter = searchBar.value.toLowerCase();
            const rows = applicantsTable.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[4].textContent.toLowerCase();
                const program = row.cells[3].textContent.toLowerCase();

                if (name.includes(filter) || email.includes(filter) || program.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Sort Dropdown Logic
            document.addEventListener("click", (e) => {
            if (!menuIcon.contains(e.target)) {
                menuDropdown.classList.add("hidden");
            }
        });

        // Sorting Logic
        const sortRows = (ascending = true) => {
            const rows = Array.from(applicantsTable.querySelectorAll("tbody tr"));
            const tbody = applicantsTable.querySelector("tbody");
            
            rows.sort((a, b) => {
                const aId = parseInt(a.cells[0].textContent);
                const bId = parseInt(b.cells[0].textContent);
                return ascending ? aId - bId : bId - aId;
            });

            rows.forEach(row => tbody.appendChild(row));
            sortDropdown.classList.add("hidden");
        };

        sortOldNew.addEventListener("click", () => sortRows(true));
        sortNewOld.addEventListener("click", () => sortRows(false));
    });
</script>
@endpush
@endsection