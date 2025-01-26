<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ships_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')
                  ->constrained('ships')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('title');
            $table->string('url', 1000);
            $table->smallInteger('ordering')->default(999);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ships_gallery');
    }
};
