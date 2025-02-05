<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $role = Role::create(['name' => 'super_admin']);
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
        ]);

        $user->syncRoles($role->name);
        Category::factory(4)->create();
    }
}
