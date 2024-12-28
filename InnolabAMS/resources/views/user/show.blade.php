@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Users</h1>
    <button
        id="addUserButton"
        class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
        + Add User
    </button>
</div>

<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="py-2 px-4 border-b">{{ $user->id }}</td>
            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div
    id="addUserModal"
    class="fixed z-10 inset-0 hidden overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="px-4 py-3 border-b flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">User Credentials</h3>
                <button
                    id="closeModalButton"
                    class="text-gray-400 hover:text-gray-500">
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

        addUserButton.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        closeModalButton.addEventListener("click", () => {
            modal.classList.add("hidden");
        });
    });
</script>