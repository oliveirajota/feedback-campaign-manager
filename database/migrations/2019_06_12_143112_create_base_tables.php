<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->enum('role', ['regular', 'admin']);
        });

        // Represents a Company
        Schema::create('company', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('owner_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
        });

        // Represents a Collaborator
        Schema::create('collaborator', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('owner_id');
            $table->uuid('user_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Represents a Base Question to add on Campaigns
        Schema::create('base_question', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('owner_id');
            $table->string('question');
            $table->string('description')->nullable();
            $table->enum('type', ['campaign', 'collaborator']);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
        });

        // Represents a Feedback Campaign
        Schema::create('campaign', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('owner_id');
            $table->string('name');
            $table->string('description');
            $table->dateTime('start_at');
            $table->dateTime('expire_at');
            $table->enum('status', ['planning', 'ready', 'started', 'finished']);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
        });

        // Represents a Relation of Collaborators in a Campaign
        Schema::create('campaign_collaborator', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->uuid('collaborator_id');
            $table->enum('status', ['pending', 'started', 'finished', 'refused']);
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaign');
            $table->foreign('collaborator_id')->references('id')->on('collaborator');
        });

        // Represents a Relation of Questions in a Campaign
        Schema::create('campaign_question', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->string('question');
            $table->string('description')->nullable();
            $table->enum('type', ['campaign', 'collaborator']);
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaign');
        });

        // Represents an Answer for a Campaign Question
        Schema::create('campaign_answer', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->uuid('collaborator_id');
            $table->uuid('campaign_question_id');
            $table->unsignedInteger('result')->default(0);
            $table->text('comment')->nullable();
            $table->boolean('private')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaign');
            $table->foreign('collaborator_id')->references('id')->on('collaborator');
            $table->foreign('campaign_question_id')->references('id')->on('campaign_question');
        });

        // Represents an Answer for a Collaborator Question
        Schema::create('campaign_collaborator_answer', function (Blueprint $table) {
//            $table->increments('id');
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->uuid('collaborator_id');
            $table->uuid('subject_id');
            $table->uuid('campaign_question_id');
            $table->unsignedInteger('result')->default(0);
            $table->text('comment')->nullable();
            $table->boolean('private')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaign');
            $table->foreign('collaborator_id')->references('id')->on('collaborator');
            $table->foreign('subject_id')->references('id')->on('collaborator');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('users', function($table) {
            $table->dropColumn('role');
        });

        Schema::dropIfExists('company');
        Schema::dropIfExists('collaborator');
        Schema::dropIfExists('base_question');
        Schema::dropIfExists('campaign');
        Schema::dropIfExists('campaign_collaborator');
        Schema::dropIfExists('campaign_question');
        Schema::dropIfExists('campaign_answer');
        Schema::dropIfExists('campaign_collaborator_answer');

        Schema::enableForeignKeyConstraints();
    }
}
