<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTitleDeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_title_deeds', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->string('title_deed_type')->nullable();
            $table->string('title_deed_no')->nullable();
            $table->string('issued_year')->nullable();
            $table->string('parcel_no')->nullable();
            $table->double('total_size_by_title_deed', 18, 2)->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_title_deeds');
    }
}
