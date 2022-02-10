<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 100);
            $table->text('description');
            $table->string('location', 100);
            $table->string('address', 100);
            $table->string('city', 50);
            $table->string('state', 2);
            $table->string('postal_code', 10);
            $table->string('cost', 10)->nullable();
            $table->string('image', 2048)->nullable();
            $table->timestamp('when');
            $table->timestamp('published')->nullable(); // Null (default) = Not Published
            $table->string('privacy')->default('F'); // F = friends only (default), I = invite only, P = public
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
        Schema::dropIfExists('plans');
    }
}
