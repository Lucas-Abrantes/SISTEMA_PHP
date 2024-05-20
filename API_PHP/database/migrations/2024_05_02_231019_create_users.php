<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
   
    public function up(): void{
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('type_user_id')->default(2);
            $table->foreign('type_user_id')->references('id')->on('type_users');
        });
    }

    public function down(): void{
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['type_user_id']);
            $table->dropColumn('type_user_id');
        });
        Schema::dropIfExists('users');
    }
};