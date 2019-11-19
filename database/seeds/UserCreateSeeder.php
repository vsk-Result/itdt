<?php

use Illuminate\Database\Seeder;
use App\Permission;

class UserCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::pluck('id');
        factory(App\User::class, 1)->create()->each(function($user) use ($permissions) {
            $user->permissions()->sync($permissions);
        });
    }
}
