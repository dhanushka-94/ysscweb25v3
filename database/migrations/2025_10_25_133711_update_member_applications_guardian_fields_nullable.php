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
        Schema::table('member_applications', function (Blueprint $table) {
            // Make guardian fields nullable since they are optional
            $table->string('guardian_full_name')->nullable()->change();
            $table->text('guardian_address')->nullable()->change();
            $table->string('guardian_contact_number_1')->nullable()->change();
            $table->string('guardian_nic')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_applications', function (Blueprint $table) {
            // Revert guardian fields to NOT NULL
            $table->string('guardian_full_name')->nullable(false)->change();
            $table->text('guardian_address')->nullable(false)->change();
            $table->string('guardian_contact_number_1')->nullable(false)->change();
            $table->string('guardian_nic')->nullable(false)->change();
        });
    }
};
