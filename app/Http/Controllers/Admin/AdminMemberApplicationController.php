<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberApplication;
use Illuminate\Support\Facades\Storage;

class AdminMemberApplicationController extends Controller
{
    public function index()
    {
        $applications = MemberApplication::orderBy('created_at', 'desc')->paginate(15);
        
        $stats = [
            'total' => MemberApplication::count(),
            'pending' => MemberApplication::pending()->count(),
            'approved' => MemberApplication::approved()->count(),
            'rejected' => MemberApplication::rejected()->count(),
        ];
        
        return view('admin.member-applications.index', compact('applications', 'stats'));
    }

    public function show(MemberApplication $memberApplication)
    {
        return view('admin.member-applications.show', compact('memberApplication'));
    }

    public function edit(MemberApplication $memberApplication)
    {
        return view('admin.member-applications.edit', compact('memberApplication'));
    }

    public function update(Request $request, MemberApplication $memberApplication)
    {
        $request->validate([
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
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:1000',
            'rejection_reason' => 'nullable|string|max:1000',
        ], [
            'contact_number_1.regex' => 'Contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'contact_number_2.regex' => 'Contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'guardian_contact_number_1.regex' => 'Guardian contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'guardian_contact_number_2.regex' => 'Guardian contact number must be in Sri Lankan format (0XXXXXXXXX)',
            'nic.regex' => 'NIC must be 9 digits + V/X or 12 digits',
            'guardian_nic.regex' => 'Guardian NIC must be 9 digits + V/X or 12 digits',
        ]);

        $data = $request->all();
        
        // Clear rejection reason if status is not rejected
        if ($data['status'] !== 'rejected') {
            $data['rejection_reason'] = null;
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
                $data[$field] = null;
            }
        }

        $memberApplication->update($data);

        return redirect()->route('admin.member-applications.index')
            ->with('success', 'Member application updated successfully.');
    }

    public function destroy(MemberApplication $memberApplication)
    {
        // Delete profile photo if exists
        if ($memberApplication->profile_photo) {
            Storage::disk('public')->delete($memberApplication->profile_photo);
        }

        $memberApplication->delete();

        return redirect()->route('admin.member-applications.index')
            ->with('success', 'Member application deleted successfully.');
    }

    public function approve(MemberApplication $memberApplication)
    {
        $memberApplication->update([
            'status' => 'approved',
            'rejection_reason' => null
        ]);

        return redirect()->back()
            ->with('success', 'Member application approved successfully.');
    }

    public function reject(Request $request, MemberApplication $memberApplication)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        $memberApplication->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return redirect()->back()
            ->with('success', 'Member application rejected successfully.');
    }
}