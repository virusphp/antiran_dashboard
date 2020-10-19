<?php

use App\Models\ProsesPekerjaan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersSeeder::class);
<<<<<<< HEAD
        $this->call(ProsesPekerjaan::class);
=======
>>>>>>> 52ef82d79eb0aedac536f9c09fd6d2aff57aa06c
    }
}
