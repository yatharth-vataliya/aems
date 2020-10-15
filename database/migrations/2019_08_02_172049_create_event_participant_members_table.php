<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventParticipantMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participant_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->integer('event_participant_id')->references('id')->on('event_participants')->onDelete('cascade');
            $table->string('unique_id');
            $table->string('member_name');
            $table->string('member_mobile');
            $table->string('member_email',100);
            $table->string('member_college',150);
            $table->string('member_department',150);
            $table->string('member_course',100);
            $table->string('member_fee',10)->default('pendding');
            $table->string('member_certificate',20)->default('notgenerated');
            $table->string('status',20)->default('active');
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('event_participant_id')->references('id')->on('event_participants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participant_members');
    }
}
