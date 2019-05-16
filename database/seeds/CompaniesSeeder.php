<?php

use App\Modules\Companies\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Company::where('name', '=', 'Master')->first()) {
            Company::create([
                'id' => 1,
                'name'    => 'Master',
                'website' => 'https://master.com.br',
                'active'  => true,
            ]);
        }
    }
}
