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
        Schema::create('cabin_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')
                  ->constrained('ships')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('vendor_code', 10);
            $table->string('title');
            $table->enum('type', ['Inside', 'Ocean view', 'Balcony', 'Suite'])->nullable();
            $table->text('description');
            $table->json('photos')->nullable();
            $table->integer('ordering')->default(9999);
            $table->boolean('state')->default(false);

            $table->unique(['ship_id', 'vendor_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cabin_categories');
    }
};
