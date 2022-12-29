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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_pt')->nullable()->change();
            $table->string('slug_pt')->nullable()->change();
            $table->text('description_pt')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_pt')->unsigned()->nullable(false)->change();
            $table->string('slug_pt')->unsigned()->nullable(false)->change();
            $table->text('description_pt')->unsigned()->nullable(false)->change();
        });
    }
};
