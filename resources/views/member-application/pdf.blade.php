<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application - {{ $memberApplication->full_name }}</title>
    <style>
        @page {
            size: A4;
            margin: 0.4in;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #fbbf24;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }
        .header-left {
            flex: 1;
        }
        .header-right {
            flex: 1;
            text-align: right;
        }
        .header h1 {
            color: #fbbf24;
            font-size: 22px;
            margin: 0 0 6px 0;
        }
        .header p {
            color: #666;
            margin: 3px 0;
            font-size: 11px;
        }
        .profile-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .profile-info {
            flex: 1;
        }
        .profile-photo-container {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 80px;
            height: 80px;
        }
        .profile-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid #fbbf24;
        }
        .profile-info h2 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }
        .profile-info p {
            margin: 0;
            color: #666;
            font-size: 11px;
        }
        .section {
            margin-bottom: 10px;
        }
        .section h3 {
            color: #fbbf24;
            font-size: 15px;
            border-bottom: 2px solid #fbbf24;
            padding-bottom: 4px;
            margin-bottom: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .info-item {
            margin-bottom: 6px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            font-size: 11px;
        }
        .info-value {
            color: #333;
            font-size: 11px;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: #fbbf24;
            color: white;
            border-radius: 8px;
            font-size: 10px;
            font-weight: bold;
        }
        .application-id {
            background-color: #f3f4f6;
            padding: 8px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 10px;
            font-size: 11px;
        }
        .logo {
            max-width: 80px;
            max-height: 60px;
            object-fit: contain;
        }
        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .guardian-section {
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 6px;
            border-left: 4px solid #fbbf24;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            @if($siteLogo = \App\Models\Setting::where('key', 'site_logo')->first()?->value)
                <img src="{{ public_path('storage/' . $siteLogo) }}" alt="Young Silver Sports Club" class="logo">
            @endif
            <h1>Young Silver Sports Club</h1>
            <p>27, Vincent Lane, Wellawatte, Colombo 06</p>
            <p>+94 714 813 981 | info@youngsilversportsclub.com</p>
            <p>Building Champions of Tomorrow</p>
        </div>
        <div class="header-right">
            <div class="application-id">
                <strong>Application Reference: {{ $memberApplication->reference_number ?: 'YSSC/' . date('Y') . '/0001' }}</strong><br>
                <strong>Submitted: {{ $memberApplication->created_at->format('F j, Y \a\t g:i A') }}</strong><br>
                <span class="status-badge">Under Review</span>
            </div>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="profile-section" style="position: relative;">
        <div class="profile-info">
            <h2>{{ $memberApplication->full_name }}</h2>
        </div>
        <div class="profile-photo-container">
            @if($memberApplication->profile_photo && file_exists(public_path('storage/' . $memberApplication->profile_photo)))
                <img src="{{ public_path('storage/' . $memberApplication->profile_photo) }}" alt="{{ $memberApplication->full_name }}" class="profile-photo">
            @else
                <div class="profile-photo" style="background-color: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: bold;">
                    {{ substr($memberApplication->full_name, 0, 1) }}
                </div>
            @endif
        </div>
    </div>

    <!-- Personal Details -->
    <div class="two-column">
        <div class="section">
            <h3>Personal Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">NIC Number:</div>
                    <div class="info-value">{{ $memberApplication->nic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email Address:</div>
                    <div class="info-value">{{ $memberApplication->email ?: 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Contact Number 1:</div>
                    <div class="info-value">{{ $memberApplication->contact_number_1 }}</div>
                </div>
                @if($memberApplication->contact_number_2)
                <div class="info-item">
                    <div class="info-label">Contact Number 2:</div>
                    <div class="info-value">{{ $memberApplication->contact_number_2 }}</div>
                </div>
                @endif
                <div class="info-item full-width">
                    <div class="info-label">Address:</div>
                    <div class="info-value">{{ $memberApplication->address }}</div>
                </div>
            </div>
        </div>

        <!-- Guardian/Parent Details -->
        @if($memberApplication->guardian_full_name)
        <div class="section">
            <div class="guardian-section">
                <h3>Guardian/Parent Details</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Guardian Name:</div>
                        <div class="info-value">{{ $memberApplication->guardian_full_name }}</div>
                    </div>
                    @if($memberApplication->guardian_nic)
                    <div class="info-item">
                        <div class="info-label">Guardian NIC:</div>
                        <div class="info-value">{{ $memberApplication->guardian_nic }}</div>
                    </div>
                    @endif
                    @if($memberApplication->guardian_contact_number_1)
                    <div class="info-item">
                        <div class="info-label">Guardian Contact:</div>
                        <div class="info-value">{{ $memberApplication->guardian_contact_number_1 }}</div>
                    </div>
                    @endif
                    @if($memberApplication->guardian_contact_number_2)
                    <div class="info-item">
                        <div class="info-label">Guardian Contact 2:</div>
                        <div class="info-value">{{ $memberApplication->guardian_contact_number_2 }}</div>
                    </div>
                    @endif
                    @if($memberApplication->guardian_address)
                    <div class="info-item full-width">
                        <div class="info-label">Guardian Address:</div>
                        <div class="info-value">{{ $memberApplication->guardian_address }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="section">
            <div class="guardian-section">
                <h3>Guardian/Parent Details</h3>
                <p style="color: #666; font-style: italic; margin: 0;">No guardian/parent information provided</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Application Status -->
    <div class="section">
        <h3>Application Status</h3>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="status-badge">Under Review</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Application Date:</div>
                <div class="info-value">{{ $memberApplication->created_at->format('F j, Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Reference Number:</div>
                <div class="info-value">{{ $memberApplication->reference_number ?: 'YSSC/' . date('Y') . '/0001' }}</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Young Silver Sports Club</strong> - Building Champions of Tomorrow</p>
        <p>This is a computer-generated document. No signature is required.</p>
        <p>Generated on {{ now()->format('F j, Y \a\t g:i A') }} | Reference: {{ $memberApplication->reference_number ?: 'YSSC/' . date('Y') . '/0001' }}</p>
    </div>
</body>
</html>
