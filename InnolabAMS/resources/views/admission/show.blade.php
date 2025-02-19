@extends('dashboard')
@section('title', 'Application Details | InnolabAMS')

@section('content')
<div class="container mx-auto px-6">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admission.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white px-4 py-1 rounded-lg hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- Application Info Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <span class="text-gray-600">Application ID: {{ $applicant->id }}</span>
            <span class="text-gray-600 ml-6">Date Submitted: {{ $applicant->created_at->format('F d, Y') }}</span>
        </div>
        <div class="flex space-x-4">
            <form method="POST" action="{{ route('admission.update-status', $applicant->id) }}" class="flex space-x-4" id="statusForm">
                @csrf
                @method('PATCH')
                <button type="submit" name="status" value="accepted"
                    style="background-color: #4CAF50;"
                    class="inline-flex items-center px-6 py-2 text-white font-bold rounded-lg hover:opacity-90">
                    Accept
                </button>
                <button type="submit" name="status" value="rejected"
                    onclick="confirmReject(event)"
                    class="inline-flex items-center px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg">
                    Reject
                </button>
            </form>
        </div>
    </div>

    <!-- Main Form -->
    <div class="border rounded">
        <!-- Applying For Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Applying For</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Grade/Level:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_grade_level }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Academic Program:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_program }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Type:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->full_name }}</td>
                </tr>
                                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Type:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->student_type }}</td>
                </tr>
            </table>
        </div>

        <!-- Student Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Student Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->full_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Sex:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->gender }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Age:</td>
                    <td class="px-4 py-2">{{ $applicant->age }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Date of Birth:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->applicant_date_birth->format('F d, Y') }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Place of Birth:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_place_birth }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Nationality:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->applicant_nationality }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Religion:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_religion }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Address:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->applicant_address_street, $applicant->applicant_address_city, $applicant->applicant_address_province, $applicant->applicant_barangay])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_tel_no }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Mobile No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_mobile_number }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Email:</td>
                    <td class="px-4 py-2">{{ $applicant->user->email }}</td>
                </tr>
            </table>
        </div>

        <!-- Educational Background Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Educational Background</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">LRN:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->lrn }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">School Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">School Address:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Academic Program:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->previous_program }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Year of Graduation:</td>
                    <td class="px-4 py-2">{{ $applicant->year_of_graduation }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Awards/Honors:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->awards_honors }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">GWA:</td>
                    <td class="px-4 py-2">{{ $applicant->gwa }}</td>
                </tr>
            </table>
        </div>

        <!-- Family Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Family Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Father's Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->father_given_name, $applicant->father_middle_name, $applicant->father_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->father_contact }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Mother's Name:</td>
                    <td class="w-1/3 px-4 py-2">{{ implode(', ', array_filter([$applicant->mother_given_name, $applicant->mother_middle_name, $applicant->mother_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->mother_contact }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Guardian's Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->guardian_given_name, $applicant->guardian_middle_name, $applicant->guardian_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->guardian_contact_num }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Siblings:</td>
                    <td class="px-4 py-2" colspan="3">
                        <table class="w-full border, text-center">
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Full Name</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Date of Birth</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Age</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Grade Level</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600">School Attended</th>
                            </tr>
                            @if(isset($applicant->siblings))
                                @foreach(json_decode($applicant->siblings) as $sibling)
                                    <tr class="border-b">
                                        <td class="px-4 py-2 border-r">{{ $sibling->full_name }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->date_of_birth }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->age }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->grade_level }}</td>
                                        <td class="px-4 py-2">{{ $sibling->school_attended }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Emergency Contacts Section -->
        <div>
            <div class="bg-gray-200 px-4 py-2 font-semibold">Emergency Contacts</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Complete Name:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Complete Address:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->emergency_contact_tel }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Mobile No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->emergency_contact_mobile }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Email:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_email }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- File Attachments Section -->
    <div class="border rounded mt-6">
        <div class="bg-gray-200 px-4 py-2 font-semibold">File Attachments</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
            <!-- Birth Certificate - Show for Transferee and Returning Student -->
            @if($applicant->student_type == 'Transferee' || $applicant->student_type == 'Returning Student')
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">Birth Certificate</h3>
                    @if($applicant->birth_certificate_path)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                {{ basename($applicant->birth_certificate_path) }}
                            </span>
                            <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => 'birth_certificate']) }}"
                               class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                <i class="fas fa-download mr-2"></i>View
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No file uploaded</p>
                    @endif
                </div>
            @endif

            <!-- Form 137 - Show for Transferee only -->
            @if($applicant->student_type == 'Transferee')
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">Form 137</h3>
                    @if($applicant->form_137_path)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                {{ basename($applicant->form_137_path) }}
                            </span>
                            <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => 'form_137']) }}"
                               class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                <i class="fas fa-download mr-2"></i>View
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No file uploaded</p>
                    @endif
                </div>
            @endif

            <!-- Form 138 - Show for all student types -->
            <div class="border rounded p-4">
                <h3 class="font-semibold mb-2">Form 138 (Report Card)</h3>
                @if($applicant->form_138_path)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            {{ basename($applicant->form_138_path) }}
                        </span>
                        <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => 'form_138']) }}"
                           class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            <i class="fas fa-download mr-2"></i>View
                        </a>
                    </div>
                @else
                    <p class="text-sm text-gray-500">No file uploaded</p>
                @endif
            </div>

            <!-- 2x2 ID Picture - Show for all student types -->
            <div class="border rounded p-4">
                <h3 class="font-semibold mb-2">2x2 ID Picture</h3>
                @if($applicant->id_picture_path)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            {{ basename($applicant->id_picture_path) }}
                        </span>
                        <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => 'id_picture']) }}"
                           class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            <i class="fas fa-download mr-2"></i>View
                        </a>
                    </div>
                @else
                    <p class="text-sm text-gray-500">No file uploaded</p>
                @endif
            </div>

            <!-- Good Moral Certificate - Show for Transferee and Returning Student -->
            @if($applicant->student_type == 'Transferee' || $applicant->student_type == 'Returning Student')
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">Good Moral Certificate</h3>
                    @if($applicant->good_moral_path)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                {{ basename($applicant->good_moral_path) }}
                            </span>
                            <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => 'good_moral']) }}"
                               class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                <i class="fas fa-download mr-2"></i>View
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No file uploaded</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div id="rejectModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                            <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Confirm Application Rejection</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to reject this application? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="submitReject()" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Confirm Rejection</button>
                    <button type="button" onclick="closeRejectModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let rejectForm = null;

function confirmReject(event) {
    event.preventDefault();
    rejectForm = event.target.closest('form');
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

function submitReject() {
    if (rejectForm) {
        let statusInput = rejectForm.querySelector('input[name="status"]');
        if (!statusInput) {
            statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            rejectForm.appendChild(statusInput);
        }
        statusInput.value = 'rejected';
        rejectForm.submit();
        closeRejectModal();
    }
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection
