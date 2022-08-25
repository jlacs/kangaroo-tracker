<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKangaroosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('kangaroos');
        Schema::create('kangaroos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()
                ->nullable(false)
                ->unsigned()
                ->unique();
            $table->string('name', 255);
            $table->string('nickname', 255)
                ->nullable()
                ->default('');
            $table->float('weight', 5, 2);
            $table->float('height', 5, 2);
            $table->string('gender', 255);
            $table->string('color', 255)
                ->nullable()
                ->default('');
            $table->string('friendliness', 255)
                ->nullable()
                ->default('');
            $table->date('birthday', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kangaroos');
    }
}
