<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telefone');
            $table->foreignId('event_id')->constrained();
            $table->timestamp('subscribe_date');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('subscribers');
    }
};
