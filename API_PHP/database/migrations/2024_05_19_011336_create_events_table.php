<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
  
    public function up(): void{
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('data');
            $table->string('location');
            $table->foreignId('organizador')->constrained('type_users');
            $table->integer('capacity');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('events');
    }
};
