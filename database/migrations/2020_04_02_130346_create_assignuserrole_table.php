<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User; 

class CreateAssignuserroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignuserrole', function (Blueprint $table) {

           $user =  User::create([
                'name' => 'Youssef',
                'phone' => null, 
                'email' => 'yossef.zaki@at-portal.info',
                'password'      => bcrypt('IbnAraby#88'),
                'api_token'     => str_random(30),
                'role'          => 'owner',
            ]);

      $role       = Role::create(['name' => 'Administrator']);
      $permission = Permission::create(['name' => 'Administer']);

      $role->givePermissionTo($permission);
      $user->assignRole($role);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignuserrole', function (Blueprint $table) {
            Schema::drop('assignuserrole');
        });
    }
}
