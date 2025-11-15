<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->json('selected_services'); // ['toolkits', 'diagnostico']
            $table->json('service_details');   // Detalles específicos por servicio (JSON)
            $table->decimal('total_cost', 15, 2);
            $table->string('email')->nullable(); // Opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotations');
    }
};