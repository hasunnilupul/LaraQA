<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        
        User::factory()->has(
            Question::factory()
                ->has(Answer::factory()->count(rand(1, 5), 'answers'))
                    ->count(rand(1, 5)), 'questions')
                        ->count(3)->create();
    }
}
