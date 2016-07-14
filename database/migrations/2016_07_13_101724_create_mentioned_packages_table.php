<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentionedPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentioned_packages', function(Blueprint $table) {
            $table->integer('version_id')->unsigned();

            $table->enum('type', ['required', 'excluded']);
            $table->string('identifier');
            $table->string('version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mentioned_packages');
    }
}
