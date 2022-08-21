<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('address')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('industry')->nullable();
            $table->string('rating')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();

            $table->integer('lft')->default('0');
            $table->integer('rgt')->default('0');
            $table->integer('depth')->default('0');


            $table->text('site')->nullable();
            $table->string('account_source')->nullable();
            $table->double('annual_revenue')->nullable();
            $table->string('clean_status')->nullable();
            $table->bigInteger('dandb_company')->unsigned()->nullable();
            $table->text('jigsaw')->nullable();
            $table->text('duns_number')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->string('fax')->nullable();
            $table->bigInteger('last_modified_by')->unsigned()->nullable();
            $table->text('naics_code')->nullable();
            $table->text('naics_desc')->nullable();
            $table->bigInteger('operating_hours')->unsigned()->nullable();
            $table->string('ownership')->nullable();
            $table->string('shipping_address')->nullable();
            $table->text('sic')->nullable();
            $table->text('sic_desc')->nullable();
            $table->string('ticker_symbol')->nullable();
            $table->text('tradestyle')->nullable();
            $table->string('type')->nullable();
            $table->text('Year_started')->nullable();
            $table->bigInteger('owner')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
