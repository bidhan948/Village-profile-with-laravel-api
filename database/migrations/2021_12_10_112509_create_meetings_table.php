<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string("baithak_id",150);
            $table->string('group_code',150);
            $table->text('subject')->nullable();
            $table->string('dateBs',150);
            $table->string('time',150);
            $table->string('venue');
            $table->integer('status');
            $table->integer('meeting_count')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('survey_data_id')->nullable();
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
        Schema::dropIfExists('meetings');
    }
}
