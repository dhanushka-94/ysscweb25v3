<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberApplication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberApplicationController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Join Us', 'url' => null]
        ];
        
        return view('member-application.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Join Us', 'url' => route('member-application.index')],
            ['title' => 'Application Form', 'url' => null]
        ];
        
        return view('member-application.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'contact_number_1' => 'required|string|regex:/^0[0-9]{9}$/',
            'contact_number_2' => 'nullable|string|regex:/^0[0-9]{9}$/',
            'email' => 'nullable|email|max:255',
            'nic' => ['required', 'string', 'regex:/^([0-9]{9}[VX]|[0-9]{12})$/'],
            'guardian_full_name' => 'nullable|string|max:255',
            'guardian_address' => 'nullable|string|max:1000',
            'guardian_contact_number_1' => 'nullable|string|regex:/^0[0-9]{9}$/',
            'guardian_contact_number_2' => 'nullable|string|regex:/^0[0-9]{9}$/',
            'guardian_nic' => ['nullable', 'string', 'regex:/^([0-9]{9}[VX]|[0-9]{12})$/'],
        ], [
            'contact_number_1.regex' => 'Contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'contact_number_2.regex' => 'Contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'guardian_contact_number_1.regex' => 'Guardian contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'guardian_contact_number_2.regex' => 'Guardian contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'nic.regex' => 'NIC must be 9 digits + V/X or 12 digits',
            'guardian_nic.regex' => 'Guardian NIC must be 9 digits + V/X or 12 digits',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'member_photos/' . time() . '_' . $file->getClientOriginalName();
            
            // Debug: Log the upload attempt
            \Log::info('Profile photo upload attempt', [
                'original_name' => $file->getClientOriginalName(),
                'filename' => $filename,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            $stored = $file->storeAs('', $filename, 'public');
            // Store the filename for database storage
            $data['profile_photo'] = $filename;
            
            // Debug: Log the storage result
            \Log::info('Profile photo storage result', [
                'stored_path' => $stored,
                'file_exists' => \Storage::disk('public')->exists($filename),
                'full_storage_path' => storage_path('app/public/' . $filename),
                'public_path' => public_path('storage/' . $filename)
            ]);
            
        }

        // Filter out empty guardian fields to prevent NULL constraint violations
        $guardianFields = [
            'guardian_full_name',
            'guardian_address', 
            'guardian_contact_number_1',
            'guardian_contact_number_2',
            'guardian_nic'
        ];
        
        foreach ($guardianFields as $field) {
            if (empty($data[$field])) {
                unset($data[$field]);
            }
        }

        $memberApplication = MemberApplication::create($data);

        return redirect()->route('member-application.complete', $memberApplication)
            ->with('success', 'Your membership application has been submitted successfully! We will review it and get back to you soon.');
    }

    public function show(MemberApplication $memberApplication)
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Join Us', 'url' => route('member-application.index')],
            ['title' => 'Application Details', 'url' => null]
        ];
        
        return view('member-application.show', compact('memberApplication', 'breadcrumbs'));
    }

    public function complete(MemberApplication $memberApplication)
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Join Us', 'url' => route('member-application.index')],
            ['title' => 'Application Submitted', 'url' => null]
        ];
        
        return view('member-application.complete', compact('memberApplication', 'breadcrumbs'));
    }

    public function pdf(MemberApplication $memberApplication)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member-application.pdf', compact('memberApplication'));
        
        $referenceNumber = $memberApplication->reference_number ?: 'YSSC-' . date('Y') . '-0001';
        // Replace forward slashes with hyphens for filename safety
        $safeReferenceNumber = str_replace('/', '-', $referenceNumber);
        $filename = 'membership-application-' . $safeReferenceNumber . '.pdf';
        
        return $pdf->download($filename);
    }
}