<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizedTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localized_tags', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned();

            $table->enum('tag', ['name', 'description']);
            $table->string('text');
            $table->string('language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('localized_tags');
    }
}
