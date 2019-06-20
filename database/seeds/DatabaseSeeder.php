<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = DB::table('users')->where('email', '=', 'jotaoliveira@gmail.com')->first();

        if (!$user) {
            $adminId = DB::table('users')->insertGetId([
                'uuid' => $faker->uuid(),
                'name' => 'Jota Oliveira',
                'email' => 'jotaoliveira@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ]);
        } else {
            $adminId = $user->id;
        }

        for ($i = 1; $i <= 3; $i++) {

            DB::table('company')->insert([
                'uuid' => $faker->uuid(),
                'owner_id' => $adminId,
                'name' => $faker->company,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $questionType = ['campaign', 'collaborator'];

        // Create Base Questions
        for ($i = 1; $i <= 15; $i++) {
            DB::table('base_question')->insert([
                'uuid' => $faker->uuid(),
                'owner_id' => $adminId,
                'question' => $faker->sentence(6, true),
                'description' => $faker->sentence(10, true),
                'type' => $questionType[array_rand($questionType, 1)],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $questions = DB::table('base_question')->get()->toArray();

        // Create Users and Collaborators
        for ($i = 1; $i <= 10; $i++) {

            $regularUserId = DB::table('users')->insertGetId([
                'uuid' => $faker->uuid(),
                'name' => $faker->name,
                'email' => $faker->email,
                'role' => 'regular',
                'password' => bcrypt('123456'),
            ]);

            DB::table('collaborator')->insert([
                'uuid' => $faker->uuid(),
                'name' => $faker->name,
                'owner_id' => $adminId,
                'user_id' => $regularUserId,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $collaborators = DB::table('collaborator')->get()->toArray();

        // Create Campaigns and Add Questions
        for ($i = 1; $i <= 5; $i++) {

            $campaignId = DB::table('campaign')->insertGetId([
                'uuid' => $faker->uuid(),
                'owner_id' => $adminId,
                'name' => $faker->sentence(3, true),
                'description' => $faker->sentence(15, true),
                'start_at' => date('Y-m-d H:i:s', time() + 60*60*24*rand(1,3)),
                'expire_at' => date('Y-m-d H:i:s', time() + 60*60*24*rand(5,10)),
                'status' => 'planning',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            // Add Questions to this Campaign
            $questionsQtd = rand(5, 10);
            $questionsIds = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
            for ($j = 1; $j <= $questionsQtd; $j++) {

                $questionId = array_rand($questionsIds, 1);
                $question =  $questions[$questionId];

                DB::table('campaign_question')->insert([
                    'uuid' => $faker->uuid(),
                    'campaign_id' => $campaignId,
                    'question' => $question->question,
                    'description' => $question->description,
                    'type' => $question->type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                unset($questionsIds[$questionId]);
            }

            // Add Collaborators to this Campaign
            $collaboratorsQtd = rand(5, 10);
            $collaboratorsIds = [1,2,3,4,5,6,7,8,9,10];
            for ($j = 1; $j <= $collaboratorsQtd; $j++) {

                $collaboratorId = array_rand($collaboratorsIds, 1);
                $collaborator =  $collaborators[$collaboratorId];

                DB::table('campaign_collaborator')->insert([
                    'uuid' => $faker->uuid(),
                    'campaign_id' => $campaignId,
                    'collaborator_id' => $collaborator->id,
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                unset($collaboratorsIds[$collaboratorId]);
            }
        }
    }
}
