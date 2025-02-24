@extends('application')

@section('content')
<div class="container">
    <h1 class="text-2xl font-semibold mb-6">Scholarship Applications</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        APPLICANT NAME
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        CURRENT SCHOLARSHIP
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        HOUSEHOLD INCOME
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        SCHOLARSHIP TYPE
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        DISCOUNT
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        STATUS
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ACTION
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($scholarships as $scholarship)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $scholarship->applicant_info->applicant_surname }},
                            {{ $scholarship->applicant_info->applicant_given_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $scholarship->current_scholarship }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $scholarship->annual_household_income }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $scholarship->scholarship_type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $scholarship->discount_awarded }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $scholarship->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($scholarship->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($scholarship->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-blue-600">
                            <a href="#" class="hover:text-blue-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            No scholarship applications found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
