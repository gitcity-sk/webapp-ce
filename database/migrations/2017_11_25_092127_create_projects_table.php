<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('namespace_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('private')->default(false);
            $table->boolean('created')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
