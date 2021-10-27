<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_data', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->string('desired_person_name');
            $table->string('contact_no');
            $table->foreignId('gender_id')->constrained();
            $table->foreignId('relation_id')->constrained();
            $table->integer('province_id');
            $table->integer('municipality_id');
            $table->integer('ward_id');
            $table->string('gps_latitude');
            $table->string('gps_longitude');
            $table->string('toll_name');
            $table->boolean('remark')->default(false);
            $table->string('group_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_data');
    }
}
