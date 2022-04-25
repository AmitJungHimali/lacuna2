<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
            role::create([
                'role'=>$i
            ]);
        }
        
    }
}
