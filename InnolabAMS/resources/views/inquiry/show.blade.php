@extends('application')
@section('title', 'Inquiry Details | InnolabAMS')

@section('content')
<div class="flex justify-between items-center mb-4">

    <h1 class="text-2xl font-semibold mx-4 my-4">Inquiries</h1>
    <div class="flex items-center space-x-4">
        <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back
        </a>
        <div flex items-center space-x-4">
            <!-- maybe add the button for status here -->
        </div>
    </div>

</div>
<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-black-600">
        <tbody>
            <!-- Inquiry ID and Date -->
            <tr>
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
            <tr>
                <td class="border px-4 py-2 font-semibold">Message:</td>
                <td colspan="3" class="border px-4 py-2">{{ $leadInfo->lead_message }}</td>
            </tr>
            <tr class="min-h-[80px]">
                <td>:</td>
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
            @if(!empty($leadInfo->other_skills_lead))
            <tr>
                <td class="border px-4 py-2 font-semibold">Other Skills:</td>
                <td colspan="3" class="border px-4 py-2">{{ $leadInfo->other_skills_lead }}</td>
            </tr>
            @endif

            <!-- Desired Career -->
            <tr>
                <td class="border px-4 py-2 font-semibold">Desired Career:</td>
                <td colspan="3" class="border px-4 py-2">{{ $leadInfo->desired_career }}</td>
            </tr>

            @if(!empty($leadInfo->source))
            @php
            $sources = json_decode($leadInfo->source, true);
            if (!is_array($sources)) {
            // If not valid JSON, assume it's a comma-separated string
            $sources = explode(',', $leadInfo->source);
            }
            @endphp
            <tr>
                <td class="border px-4 py-2 font-semibold">How Did You Learn About Us?</td>
                <td colspan="3" class="border px-4 py-2">
                    @foreach($sources as $source)
                    {{ trim($source) }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endif
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