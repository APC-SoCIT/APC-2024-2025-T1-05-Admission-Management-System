@extends('application')
@section('title', 'Applications | InnolabAMS')

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Inquiries</h1>

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
    </div>
</div>


<!-- Table Section -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="applicantsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">INQUIRY ID</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Contact No.</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Email Address</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">INQUIRED DETAILS</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">DATE</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">STATUS</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-black text-black uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($leadInfos as $leadInfo)
                <tr>

                    <td class="w-1/12 py-2 px-4 border-b text-center">{{ $leadInfo->id }}</td>
                    <td class="w-2/12 py-2 px-4 border-b text-center font-bold">
                        {{ $leadInfo->lead_surname }}, {{ $leadInfo->lead_given_name }}
                    </td>
                    <td class="w-2/12 py-2 px-4 border-b text-center">
                        {{ preg_replace('/(\d{4})(\d{3})(\d{4})/', '$1-$2-$3', $leadInfo->lead_mobile_number) }}
                    </td>
                    <td class="w-3/12 py-2 px-4 border-b text-center">{{ $leadInfo->lead_email }}</td>
                    <td class="w-3/12 py-2 px-4 border-b text-center font-bold">{{ $leadInfo->inquired_details }}</td>
                    <td class="w-3/12 py-2 px-4 border-b text-center">{{ $leadInfo->inquiry_submitted }}</td>
                    <td class="w-1/12 py-2 px-4 border-b text-center">{{ $leadInfo->inquiry_status }}</td>
                    <td class="w-1/12 py-2 px-4 border-b text-center">
                        <div class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-block">
                            <a href="{{ route('inquiry.show', $leadInfo->id) }}">View</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No inquiries found.</td>
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
        const userTable = document.getElementById("userTable");
        const sortIcon = document.getElementById("sortIcon");
        const sortDropdown = document.getElementById("sortDropdown");
        const sortOldNew = document.getElementById("sortOldNew");
        const sortNewOld = document.getElementById("sortNewOld");
        let sortOrder = "asc";

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
        sortNewOld.addEventListener("click"), () => {
            const rows = Array.from(userTable.querySelectorAll("tr"));
            rows.sort((a, b) => parseInt(b.children[0].textContent) - parseInt(a.children[0].textContent));
            rows.forEach(row => userTable.appendChild(row));
            sortDropdown.classList.add("hidden");
        }
    });
</script>
@endpush
@endsection