<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;

class ApplicantInfoController extends Controller
{
    public function index()
    {
        $query = ApplicantInfo::with('user')
            ->select(
                'id',
                'user_id',
                'applicant_surname',
                'applicant_given_name',
                'applicant_middle_name',
                'applicant_extension',
                'gender',
                'apply_program',
                'applicant_mobile_number',
                'status'
            );

        // Handle sorting
        $sortField = request('sort', 'id');
        $sortDirection = request('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Handle search
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('applicant_surname', 'like', "%{$search}%")
                    ->orWhere('applicant_given_name', 'like', "%{$search}%")
                    ->orWhere('apply_program', 'like', "%{$search}%")
                    ->orWhere('applicant_mobile_number', 'like', "%{$search}%");
            });
        }

        $applicants = $query->get();

        if (request()->wantsJson()) {
            return response()->json($applicants);
        }

        return view('admission.index', compact('applicants'));
    }

    public function new()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'new')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.new', compact('applicants'));
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'accepted')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.accepted', compact('applicants'));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'rejected')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.rejected', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with('user')->findOrFail($id);
        return view('admission.show', compact('applicant'));
    }

    public function create()
    {
        return view('admission.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'apply_program' => 'required|in:Kindergarten,Elementary,High School,Senior High School',
                'apply_grade_level' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
                'apply_strand' => 'nullable|required_if:apply_program,Senior High School|in:STEM,ABM,TECHVOC,HUMSS,GAS',
                'applicant_surname' => 'required|max:40',
                'applicant_given_name' => 'required|max:40',
                'applicant_middle_name' => 'nullable|max:40',
                'applicant_extension' => 'nullable|max:10',
                'applicant_date_birth' => 'required|date',
                'applicant_place_birth' => 'required|max:255',
                'gender' => 'required|in:Male,Female',
                'applicant_address_street' => 'required|max:255',
                'applicant_address_province' => 'required|max:255',
                'applicant_address_city' => 'required|max:255',
                'applicant_nationality' => 'required|max:255',
                'applicant_religion' => 'nullable|max:255',
                'applicant_mobile_number' => 'required|max:12',
                'applicant_photo' => 'nullable|image|max:2048',
            ]);

            // Debug log
            \Log::info('Validated data:', $validated);

            // Ensure user_id is set
            $validated['user_id'] = auth()->id() ?? 1; // Fallback to ID 1 if no auth user
            $validated['status'] = 'new';

            if ($request->hasFile('applicant_photo')) {
                $path = $request->file('applicant_photo')->store('applicant-photos', 'public');
                $validated['applicant_photo'] = $path;
            }

            $applicant = ApplicantInfo::create($validated);

            // Debug log
            \Log::info('Application created:', ['id' => $applicant->id]);

            return redirect()
                ->route('admission.index') // Changed to redirect to index instead of show
                ->with('success', 'Application created successfully');

        } catch (\Exception $e) {
            // Debug log
            \Log::error('Application creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create application: ' . $e->getMessage());
        }


    }
    //Personal Information Form
    public function showForm()
    {
        return view('personal_information.create');
    }
}
