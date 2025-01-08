@section('title', 'Inquiry | InnolabAMS')
@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Inquiries</h1>

    <div class="flex items-center space-x-4">
        <!-- Search Icon and Bar -->
        <div class="relative flex items-center">
            <button
                id="searchIcon"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input
                type="text"
                id="searchBar"
                placeholder="Search..."
                class="absolute top-0 right-12 hidden bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-md w-64 focus:outline-none">
        </div>

        <!-- Sort Icon and Dropdown -->
        <div class="relative">
            <button
                id="sortIcon"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div
                id="sortDropdown"
                class="absolute right-0 mt-2 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-40">
                <button
                    id="sortOldNew"
                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    Old - New
                </button>
                <button
                    id="sortNewOld"
                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    New - Old
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Inquiry table -->
<div class="container mt-5">
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">ID</th>
                <th class="py-2 px-4 border-b text-left">Name</th>
                <th class="py-2 px-4 border-b text-left">Email Address</th>
                <th class="py-2 px-4 border-b text-left">Contact No.</th>
                <th class="py-2 px-4 border-b text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
            <tr>
                <td class="py-2 px-4 border-b">{{ $inquiry->id }}</td>
                <td class="py-2 px-4 border-b">{{ $inquiry->lead_id }}</td> <!-- Replace with actual name if applicable -->
                <td class="py-2 px-4 border-b">{{ $inquiry->details_sent }}</td> <!-- Replace with actual email -->
                <td class="py-2 px-4 border-b">{{ $inquiry->response_date }}</td> <!-- Replace with actual contact number -->
                <td class="py-2 px-4 border-b"><a href="#" class="btn btn-primary">View</a></td>
                <td class="py-2 px-4 border-b">
                    <button
                        class=" text-red-600 py-1 px-2 rounded delete-button"
                        data-id="{{ $inquiry->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No inquiries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

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