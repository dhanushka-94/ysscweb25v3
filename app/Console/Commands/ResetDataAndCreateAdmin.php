<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class ResetDataAndCreateAdmin extends Command
{
    protected $signature = 'db:reset-and-create-admin {--force : Force the operation without confirmation}';
    protected $description = 'Reset all data except site settings and create new admin user';

    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will delete ALL data except site settings and create a new admin user. Are you sure?')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info('Starting database reset and admin user creation...');

        try {
            // Clear all data except settings
            $this->clearDataExceptSettings();
            
            // Create new admin user
            $this->createAdminUser();
            
            $this->info('Database reset and admin user creation completed successfully!');
            $this->info('New admin user created with the specified credentials.');
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }

    private function clearDataExceptSettings()
    {
        $this->info('Clearing existing data...');
        
        // Clear all tables except settings and users
        DB::table('sliders')->truncate();
        DB::table('news')->truncate();
        DB::table('fixtures')->truncate();
        DB::table('sponsors')->truncate();
        DB::table('gallery_images')->truncate();
        DB::table('office_bearers')->truncate();
        DB::table('member_applications')->truncate();
        DB::table('products')->truncate();
        
        // Clear all users
        DB::table('users')->truncate();
        
        $this->info('✓ Data cleared (settings preserved)');
    }

    private function createAdminUser()
    {
        $this->info('Creating new admin user...');
        
        // Create the admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'info@youngsilversportsclub.com',
            'password' => Hash::make('Yssc@569874123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        
        $this->info('✓ Admin user created successfully');
        $this->info('Username: info@youngsilversportsclub.com');
        $this->info('Password: Yssc@569874123');
        $this->info('User ID: ' . $adminUser->id);
    }
}