<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->string('fcm_token')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('added_by_admin_user_id')->nullable();
            $table->string('added_by_agent_user_id')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('otp_verified')->default(0);
            $table->dateTime('otp_verified_at')->nullable();
            $table->boolean('is_active')->default(1);


            $table->string('user_type')->default('USR')->comment('ADM => Admin, USR => Customer, AGN => Agent');

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
        Schema::dropIfExists('users');
    }
}
