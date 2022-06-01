<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->double('price')->nullable();
            $table->text('image')->nullable();
            $table->text('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->double('discounts')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}
