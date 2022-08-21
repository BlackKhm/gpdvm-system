<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->bigInteger('property_price_history_id')->unsigned()->nullable()->index();
            $table->bigInteger('submitcase_id')->unsigned()->nullable()->index();
            $table->date('exclusive_date')->nullable();
            $table->date('exclusive_expires_date')->nullable();
            $table->string('agreement_type')->nullable();
            $table->text('agreement_file')->nullable();
            $table->string('sale_commission')->nullable();
            $table->string('rental_commission')->nullable();
            $table->string('exclusive_listing')->nullable();
            $table->datetime('published_at')->nullable();
            $table->bigInteger('published_by')->unsigned()->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('sale_land_specialist_id')->unsigned()->nullable();

            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->double('sale_list_price', 18, 2)->nullable();
            $table->double('sold_price')->nullable();
            $table->timestamp('sold_price_date')->nullable();
            $table->double('rent_list_price', 18, 2)->nullable();
            $table->double('rented_price')->nullable();
            $table->timestamp('rented_price_date')->nullable();
            $table->boolean('show_on_map')->default(0)->nullable();
            $table->boolean('display_on_first_page')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->boolean('show_agent_on_website')->default(0)->nullable();
            $table->boolean('show_price_per_square_meter')->default(0)->nullable();
            $table->longText('additional_items')->nullable();
            $table->timestamp('renew_date')->nullable();
            $table->boolean('is_rent')->default(0)->nullable();
            $table->boolean('is_sale')->default(0)->nullable();
            $table->boolean('is_close')->default(0)->nullable();
            $table->string('close_reason')->nullable();
            $table->integer('views')->default('0')->nullable();
            $table->string('code')->nullable();
            $table->bigInteger('total_rates')->default('0')->nullable();
            $table->bigInteger('total_user_rates')->default('0')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
