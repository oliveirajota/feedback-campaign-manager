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
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Internet($faker));

        $user = DB::table('users')->where('email', '=', 'jotaoliveira@gmail.com')->first();

        if (!$user) {

            $adminId = $faker->uuid();
                DB::table('users')->insert([
                'id' => $adminId,
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
                'id' => $faker->uuid(),
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
                'id' => $faker->uuid(),
                'owner_id' => $adminId,
                'question' => $this->getRandomQuestion(),
                'description' => $faker->sentence(10, true),
                'type' => $questionType[array_rand($questionType, 1)],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $questions = DB::table('base_question')->get()->toArray();

        // Create Users and Collaborators
        for ($i = 1; $i <= 10; $i++) {

            $name = $faker->name;

            $regularUserId = $faker->uuid();
            DB::table('users')->insert([
                'id' => $regularUserId,
                'name' => $name,
                'email' => $faker->email,
                'role' => 'regular',
                'password' => bcrypt('123456'),
            ]);


            DB::table('collaborator')->insert([
                'id' => $faker->uuid(),
                'name' => $name,
                'owner_id' => $adminId,
                'user_id' => $regularUserId,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $collaborators = DB::table('collaborator')->get()->toArray();

        $campaignIds = [];

        // Create Campaigns and Add Questions
        for ($i = 1; $i <= 5; $i++) {

            $campaignId = $faker->uuid();
            DB::table('campaign')->insert([
                'id' => $campaignId,
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
                    'id' => $faker->uuid(),
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
                    'id' => $faker->uuid(),
                    'campaign_id' => $campaignId,
                    'collaborator_id' => $collaborator->id,
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                unset($collaboratorsIds[$collaboratorId]);
            }

            $campaignIds[] = $campaignId;
        }

        // Publish Campaigns
        $campaignService = new \App\Services\Admin\CampaignService();
        foreach ($campaignIds as $campaignId) {
            $campaignService->publish($campaignId);
        }

        // Update Answers
        $campaignAnswers = DB::table('campaign_answer')->get();
        foreach ($campaignAnswers as $campaignAnswer) {
            DB::table('campaign_answer')
                ->where('id', $campaignAnswer->id)
                ->update([
                    'result' => rand(0, 6),
                    'comment' => $this->getRandonAnswer()
                ]
            );
        }

        $collaboratorAnswers = DB::table('campaign_collaborator_answer')->get();
        foreach ($collaboratorAnswers as $collaboratorAnswer) {
            DB::table('campaign_collaborator_answer')
                ->where('id', $collaboratorAnswer->id)
                ->update([
                    'result' => rand(0, 6),
                    'comment' => $faker->sentence(10, true)
                ]
            );
        }
    }

    private function getRandomQuestion()
    {
        $questions = [
            'O que especificamente posso fazer para apoiar o propósito da nossa equipe?',
            'Devo trabalhar mais de perto de quais pessoas da equipe?',
            'Quais habilidades são mais importantes para desenvolvermos nos projetos da equipe?',
            'Quais são os pontos positivos e negativos de minha relação com a equipe?',
            'Especificamente, o que preciso trabalhar para estar pronto para desempenhar (função de interesse) dentro de nossos projetos?',
            'Em quais momentos você considera que agi com maestria?',
            'Quais funções você considera mais relacionadas ao seu perfil?',
            'Que tipo de treinamento você considera que seja importante eu fazer nesse momento da carreira?',
            'Você acredita que demonstro os valores organizacionais?',
            'Eu contribuo para uma cultura de trabalho positiva?',
            'Qual é uma palavra que melhor descreve meu trabalho? Por que?',
            'Quanto tempo você acha que é importante que eu dedique ao projeto?',
            'O que objetivamente posso fazer para acelerarmos os resultados desse projeto?',
            'Qual você acha que é minha função mais importante nesse projeto?',
            'Qual você acredita que seja minha maior fraqueza e minha maior força do projeto?',
            'O que você acha que é um processo que podemos melhorar aqui?',
            'Com o que você precisa de ajuda? Esta semana? Este mês? (Pergunta que o líder pode fazer)',
            'Você considera minha comunicação efetiva?',
            'Quais você considera os melhores canais para eu me comunicar com você?',
            'Como podemos melhorar nossa comunicação?',
            'Com que frequência você prefere receber meus feedbacks?',
            'Você tem clareza do trabalho que está desenvolvendo?  Se não, quais aspectos da nossa comunicação não são claros?'
        ];

        $randIndex = array_rand($questions);

        return $questions[$randIndex];
    }

    private function getRandonAnswer()
    {
        $answers = [
            'Acho que deve melhorar',
            'Acho que está bom',
            'Acho que está péssimo',
            'Não sei opinar sobre isso'
        ];

        $randIndex = array_rand($answers);

        return $answers[$randIndex];
    }

}
