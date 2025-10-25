<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixAdminUsers extends Command
{
    protected $signature = 'admin:fix-users';
    protected $description = 'Fix admin users by setting is_admin flag to true';

    public function handle()
    {
        $this->info('Fixing admin users...');
        
        // Get all users
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->info('No users found.');
            return;
        }
        
        foreach ($users as $user) {
            if (!$user->is_admin) {
                $user->update(['is_admin' => true]);
                $this->info("✓ Updated user: {$user->email} (ID: {$user->id})");
            } else {
                $this->info("✓ User already admin: {$user->email} (ID: {$user->id})");
            }
        }
        
        $this->info('All users are now admin users.');
    }
}