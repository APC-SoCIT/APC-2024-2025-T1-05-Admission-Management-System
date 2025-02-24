@extends('application') <!-- Use the application layout -->
@section('title', 'Accepted Applications | InnolabAMS')

@section('content')
<div class="container mx-auto px-6">
    <!-- Title and Actions Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Applications</h1>

        <div class="flex items-center space-x-4">
            <!-- Search Icon and Bar -->
            <div class="relative flex items-center">
                <div class="relative inline-flex items-center">
                    <button id="searchIcon"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none z-10">
                        <i class="fas fa-search"></i>
                    </button>
                    <input type="text"
                           id="searchInput"
                           placeholder="Search..."
                           class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-md w-64 focus:outline-none absolute hidden transition-all duration-300"
                           style="right: 2.5rem; top: 0;">
                </div>
            </div>

            <!-- Sort Icon -->
            <div class="relative">
                <button id="sortIcon"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div id="sortDropdown"
                    class="absolute right-0 mt-2 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-40">
                    <button id="sortOldNew" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Old - New</button>
                    <button id="sortNewOld" class="block w-full text-left px-4 py-2 hover:bg-gray-100">New - Old</button>
                </div>
            </div>

            <!-- Add Applicant Button -->
            <a href="{{ route('admission.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fa-solid fa-plus mr-2"></i>Add Applicant
            </a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('admission.index') }}"
               class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                All Applications
            </a>
            <a href="{{ route('admission.new') }}"
               class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                New ({{ $newCount ?? 0 }})
            </a>
            <a href="{{ route('admission.accepted') }}"
               class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Accepted ({{ $acceptedCount ?? 0 }})
            </a>
            <a href="{{ route('admission.rejected') }}"
               class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Rejected ({{ $rejectedCount ?? 0 }})
            </a>
        </nav>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200" id="applicantsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sex</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($applicants as $applicant)
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->id }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->full_name }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->gender }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->apply_program }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->applicant_email }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $applicant->applicant_mobile_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 text-center inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Accepted
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('admission.show', $applicant->id) }}"
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No accepted applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-700">
            Showing {{ $applicants->firstItem() ?? 0 }} to {{ $applicants->lastItem() ?? 0 }} of {{ $applicants->total() }} applications
        </div>
        <div class="flex space-x-2">
            @if($applicants->previousPageUrl())
                <a href="{{ $applicants->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 text-gray-700">Previous</a>
            @endif

            <span class="px-3 py-1 rounded bg-blue-500 text-white">{{ $applicants->currentPage() }}</span>

            @if($applicants->hasMorePages())
                <a href="{{ $applicants->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 text-gray-700">Next</a>
            @endif
        </div>
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

        // Sort functionality
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
