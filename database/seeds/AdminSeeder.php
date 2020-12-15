<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();
      
        $user =  User::create([
                'name' => 'Admin',
                'phone' => null, 
                'email' => 'admin@example.com',
                'password'      => bcrypt('111111111'),
                'api_token'     => Str::random(30),
                'role'          => 'owner',
            ]);

      $role       = Role::create(['name' => 'Administrator']);
      $permission = Permission::create(['name' => 'Administer']);

      $role->givePermissionTo($permission);
      $user->assignRole($role);
    }
}
