<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
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
        User::factory()->has(Question::factory()->has(Answer::factory()->count(rand(1,5), 'answers'))->count(rand(1,5)), 'questions')->count(3)->create();
    }
}
