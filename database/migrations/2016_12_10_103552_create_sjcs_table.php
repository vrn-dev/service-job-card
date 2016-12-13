<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSjcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sjcs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id')->unique();
            $table->string('company_id');
            $table->string('inventory_id');
            $table->string('assigned_to');
            $table->date('scheduled_date');
            $table->string('status');
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
        Schema::dropIfExists('sjcs');
    }
}
