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
            $table->string('title_en');
            $table->string('slug_en')->nullable();
            $table->text('description_en');

            $table->renameColumn('title', 'title_pt');
            $table->renameColumn('slug', 'slug_pt');
            $table->renameColumn('description', 'description_pt');
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
            $table->dropColumn('title_en');
            $table->dropColumn('slug_en');
            $table->dropColumn('description_en');

            $table->renameColumn('title_en', 'title');
            $table->renameColumn('slug_en', 'slug');
            $table->renameColumn('description_en', 'description');
        });
    }
};
