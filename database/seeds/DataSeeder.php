<?php

use App\Skill;
use App\Social;
use App\University;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        factory(App\University::class, 10)->create();
        factory(App\Skill::class, 10)->create();
        factory(App\Post::class, 10)->create();
    }
}
