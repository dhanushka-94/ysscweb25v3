<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            
            // Profile Photo
            $table->string('profile_photo')->nullable();
            
            // Personal Details
            $table->string('full_name');
            $table->text('address');
            $table->string('contact_number_1');
            $table->string('contact_number_2')->nullable();
            $table->string('email');
            $table->string('nic');
            
            // Guardian/Parent Details
            $table->string('guardian_full_name');
            $table->text('guardian_address');
            $table->string('guardian_contact_number_1');
            $table->string('guardian_contact_number_2')->nullable();
            $table->string('guardian_nic');
            
            // Application Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_applications');
    }
};