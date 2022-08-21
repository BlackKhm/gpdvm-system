<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitCaseSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitcases_shares', function (Blueprint $table) {
            $table->id();
            $table->string('access_level')->nullable();
            $table->unsignedBigInteger('row_id')->index();
            $table->morphs('sharable');
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
        Schema::dropIfExists('submitcases_shares');
    }
}
