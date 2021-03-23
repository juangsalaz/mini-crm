<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        DB::table('users')->truncate();
        DB::table('users')->insert(
            ['name' => "Admin", 'email' => "admin@admin.com", 'password' => bcrypt('password'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
    }
}
