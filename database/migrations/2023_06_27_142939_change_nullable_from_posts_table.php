<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->change();
            $table->string('slug_en')->nullable()->change();
            $table->text('description_en')->nullable()->change();
            $table->string('title_es')->nullable()->change();
            $table->string('slug_es')->nullable()->change();
            $table->text('description_es')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->unsigned()->nullable(false)->change();
            $table->string('slug_en')->unsigned()->nullable(false)->change();
            $table->text('description_en')->unsigned()->nullable(false)->change();
            $table->string('title_es')->unsigned()->nullable(false)->change();
            $table->string('slug_es')->unsigned()->nullable(false)->change();
            $table->text('description_es')->unsigned()->nullable(false)->change();
        });
    }
};
