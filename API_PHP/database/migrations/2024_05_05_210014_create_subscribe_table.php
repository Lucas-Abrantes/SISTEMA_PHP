User
chat, faça o mesmo para a tabela de inscritos, o controller e o model


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
   
    public function up(): void
    {
        Schema::create('subscribe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->constrained('events');
            $table->timestamp('subscribe_data');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('subscribe');
    }
};