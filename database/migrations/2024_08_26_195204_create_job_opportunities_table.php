<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('scope_work_id');
            $table->integer('job_title_id');
            $table->integer('city_id');

            $table->string('gender');

            $table->string('from_age')->nullable();
            $table->string('to_age')->nullable();

            $table->string('educational_level');
            $table->string('career_level');
            $table->string('years_experience');
            $table->string('type_job');
            $table->integer('number_vacancies');
            $table->string('address')->nullable();
            $table->string('rang_salary');
            $table->longtext('job_description');
            $table->longtext('requirements');
            $table->longtext('requirements_for_trainees')->nullable();
            $table->string('status');
            $table->integer('subscription_id')->nullable();
            $table->integer('filter')->default(0);
            $table->integer('company_id');
            $table->text('question')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_opportunities');
    }
};
