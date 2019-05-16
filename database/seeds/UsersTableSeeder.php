<?php

use App\Modules\Companies\Models\Company;
use App\Modules\Roles\Models\Role;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'demo@site.com.br',
            'password' => 'sitedemo',
            'remember_token' => str_random(10),
            'active' => true,
            'role_id' => Role::first()->id
        ]);
    }
}
