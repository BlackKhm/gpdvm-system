<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->text('icon')->nullable();
            $table->boolean('option')->default(0)->nullable();
            $table->boolean('category')->default(0)->nullable();
            $table->string('web_class')->nullable();
            $table->string('android_class')->nullable();
            $table->string('ios_class')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->boolean('require_authentication')->default(0)->nullable();
            $table->boolean('display_on_frontend')->default(1)->nullable();
            $table->boolean('display_on_backend')->default(1)->nullable();
            $table->integer('order')->nullable();
            $table->string('name_khm')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
