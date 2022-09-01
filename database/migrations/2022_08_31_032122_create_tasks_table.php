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
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('taskName');
            $table->float('laborTotal')->default('0');
            $table->float('partsTotal')->default('0');
            $table->float('taskTotal')->default('0');
        });
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('task_id')->constrained('tasks');
            $table->string('workerName');
            $table->float('workHours')->default('0');
            $table->float('workRate')->default('0');
            $table->float('workersTotal')->default('0');
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('workers');
    }
};
