@extends('application')
@section('title', 'Inquiry Details | InnolabAMS')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Inquiry Details</h1>
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
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-black-600">
            <tbody>
                <!-- Inquiry ID and Date -->
                <tr >
                    <td class="border px-4 py-2 font-semibold" style="width: 20%;">Inquiry ID :</td>
                    <td class="border px-4 py-2 w-1/3" style="width: 35%;">{{ $leadInfo->id }}</td>
                    <td class="border px-4 py-2 font-semibold" style="width: 5%;">Date :</td>
                    <td class="border px-4 py-2">{{ $leadInfo->inquiry_submitted }}</td>
                </tr>

                <!-- Name -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Name :</td>
                    <td colspan="3" class="border px-4 py-2">
                        {{ $leadInfo->lead_surname }}, {{ $leadInfo->lead_given_name }} {{ $leadInfo->middle_name }} {{ $leadInfo->lead_extension }}
                    </td>
                </tr>

                <!-- Mobile Number -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Mobile No. :</td>
                    <td colspan="3" class="border px-4 py-2">
                        {{ preg_replace('/(\d{4})(\d{3})(\d{4})/', '$1-$2-$3', $leadInfo->lead_mobile_number) }}
                    </td>
                </tr>

                <!-- Email -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Email :</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->lead_email }}</td>
                </tr>

                <!-- Inquired Details -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">What details would you like to know?</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->inquired_details }}</td>
                </tr>

                <!-- Message -->
                <tr >
                    <td class="border px-4 py-2 font-semibold">Message:</td>
                </tr>
                <tr class="min-h-[80px]">
                    <td></td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->lead_message }}</td>
                </tr>

                <!-- City -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">City:</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->lead_address_city }}</td>
                </tr>

                <!-- Extracurricular Interests -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Extracurricular Interest:</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->extracurricular_interest_lead }}</td>
                </tr>

                <!-- Skills -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Skills:</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->skills_lead }}</td>
                </tr>

                <!-- Desired Career -->
                <tr>
                    <td class="border px-4 py-2 font-semibold">Desired Career:</td>
                    <td colspan="3" class="border px-4 py-2">{{ $leadInfo->desired_career }}</td>
                </tr>
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
        const sortdropdown = document.getElementById("sortdropdown");
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
            const rows = userTable.querySelectorAll("td");

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
            sortdropdown.classList.toggle("hidden");
        });

        // Sort Old - New
        sortOldNew.addEventListener("click", () => {
            const rows = Array.from(userTable.querySelectorAll("td"));
            rows.sort((a, b) => parseInt(a.children[0].textContent) - parseInt(b.children[0].textContent));
            rows.forEach(row => userTable.appendChild(row));
            sortdropdown.classList.add("hidden");
        });

        // Sort New - Old
        sortNewOld.addEventListener("click"), () => {
            const rows = Array.from(userTable.querySelectorAll("td"));
            rows.sort((a, b) => parseInt(b.children[0].textContent) - parseInt(a.children[0].textContent));
            rows.forEach(row => userTable.appendChild(row));
            sortdropdown.classList.add("hidden");
        }
    });
</script>
@endpush
@endsection