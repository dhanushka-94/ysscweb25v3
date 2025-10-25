<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_photo',
        'full_name',
        'address',
        'contact_number_1',
        'contact_number_2',
        'email',
        'nic',
        'guardian_full_name',
        'guardian_address',
        'guardian_contact_number_1',
        'guardian_contact_number_2',
        'guardian_nic',
        'status',
        'notes',
        'rejection_reason',
        'reference_number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor for formatted NIC
    public function getFormattedNicAttribute()
    {
        $nic = $this->nic;
        if (strlen($nic) == 12) {
            return substr($nic, 0, 5) . ' ' . substr($nic, 5, 7) . ' ' . substr($nic, 11, 1);
        }
        return $nic;
    }

    // Accessor for formatted Guardian NIC
    public function getFormattedGuardianNicAttribute()
    {
        $nic = $this->guardian_nic;
        if (strlen($nic) == 12) {
            return substr($nic, 0, 5) . ' ' . substr($nic, 5, 7) . ' ' . substr($nic, 11, 1);
        }
        return $nic;
    }

    // Accessor for formatted phone numbers
    public function getFormattedContactNumber1Attribute()
    {
        $number = $this->contact_number_1;
        if (strlen($number) == 10 && substr($number, 0, 1) == '0') {
            return '+94 ' . substr($number, 1, 2) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6, 4);
        }
        return $number;
    }

    public function getFormattedGuardianContactNumber1Attribute()
    {
        $number = $this->guardian_contact_number_1;
        if (strlen($number) == 10 && substr($number, 0, 1) == '0') {
            return '+94 ' . substr($number, 1, 2) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6, 4);
        }
        return $number;
    }

    // Scope for filtering by status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Generate reference number
    public static function generateReferenceNumber()
    {
        $currentYear = date('Y');
        
        // Get the last application for this year
        $lastApplication = self::where('reference_number', 'like', 'YSSC/' . $currentYear . '/%')
            ->orderBy('reference_number', 'desc')
            ->first();
        
        if ($lastApplication) {
            // Extract the number from the last reference
            $lastNumber = (int) substr($lastApplication->reference_number, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return 'YSSC/' . $currentYear . '/' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    // Boot method to auto-generate reference number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->reference_number)) {
                $model->reference_number = self::generateReferenceNumber();
            }
        });
    }
}