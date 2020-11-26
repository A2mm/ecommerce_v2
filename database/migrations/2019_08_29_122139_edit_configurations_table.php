<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('configurations', function (Blueprint $table) {
         $table->string('is_visible')->default('1');
         $table->string('input_type')->nullable();
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('configurations', function (Blueprint $table) {
         $table->dropColumn('is_visible');
         $table->dropColumn('input_type');
       });
     }
}
