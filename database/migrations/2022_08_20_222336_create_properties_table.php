<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('last_property_price_history_id')->unsigned()->nullable()->index();
            $table->bigInteger('property_feature_id')->unsigned()->nullable()->index();
            $table->bigInteger('listing_id')->unsigned()->nullable()->index();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->string('project_building')->nullable();
            $table->text('name')->nullable();
            $table->double('sale_price_asking', 18, 2)->nullable();
            $table->double('sale_asking_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('sale_price_asking_date')->nullable();
            $table->bigInteger('sale_price_asking_updated_by')->unsigned()->nullable();
            $table->double('sale_price', 18, 2)->nullable();
            $table->double('sale_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('sale_price_date')->nullable();
            $table->bigInteger('sale_price_updated_by')->unsigned()->nullable();
            $table->double('sale_list_price', 18, 2)->nullable();
            $table->double('sale_listing_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('sale_list_price_date')->nullable();
            $table->bigInteger('sale_list_price_updated_by')->unsigned()->nullable();
            $table->double('sold_price', 18, 2)->nullable();
            $table->double('sold_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('sold_price_date')->nullable();
            $table->bigInteger('sold_price_updated_by')->unsigned()->nullable();

            $table->double('rent_price_asking', 18, 2)->nullable();
            $table->double('rent_asking_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('rent_price_asking_date')->nullable();
		    $table->bigInteger('rent_price_asking_updated_by')->unsigned()->nullable();
            $table->double('rent_price', 18, 2)->nullable();
            $table->double('rent_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('rent_price_date')->nullable();
            $table->bigInteger('rent_price_updated_by')->unsigned()->nullable();
            $table->double('rent_list_price', 18, 2)->nullable();
            $table->double('rent_listing_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('rent_list_price_date')->nullable();
            $table->bigInteger('rent_list_price_updated_by')->unsigned()->nullable();
            $table->double('rented_price', 18, 2)->nullable();
            $table->double('rented_price_per_sqm', 18, 2)->nullable();
            $table->timestamp('rented_price_date')->nullable();
            $table->bigInteger('rented_price_updated_by')->unsigned()->nullable();
            $table->string('street_no')->nullable();
            $table->string('house_no')->nullable();
            $table->string('address')->nullable();
            $table->string('full_address')->nullable();
            $table->string('zip_postalcode')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->datetime('published_at')->nullable();
            $table->bigInteger('published_by')->unsigned()->nullable();

            $table->integer('unit_total_bedroom')->nullable();
            $table->integer('unit_total_bathroom')->nullable();
            $table->integer('unit_total_livingroom')->nullable();
            $table->integer('unit_total_floor')->nullable();
            $table->integer('unit_total_parking')->nullable();
            $table->integer('unit_total_car_parking')->nullable();
            $table->integer('unit_total_motor_parking')->nullable();
            $table->integer('unit_total_diningroom')->nullable();
            $table->integer('unit_total_doors')->nullable();
            $table->double('land_width', 18, 2)->nullable();
            $table->double('land_length', 18, 2)->nullable();
            $table->double('land_area', 18, 2)->nullable();
            $table->double('land_area_by_title_deed', 18, 2)->nullable();
            $table->string('title_deed_no')->nullable();
            $table->string('parcel_no')->nullable();
            $table->double('total_size_by_title_deed', 18, 2)->nullable();
            $table->double('issued_year', 18, 2)->nullable();
            $table->longText('description')->nullable();
            $table->text('note')->nullable();

            $table->string('location_grade')->nullable();
            $table->string('title_deed_type')->nullable();
            $table->string('record_type')->nullable();
            $table->string('data_source_type')->nullable();
            $table->string('zone_type')->nullable();
            $table->string('land_shape_type')->nullable();
            $table->string('site_position')->nullable();
            $table->string('facing_type')->nullable();
            $table->string('tenure_type')->nullable();
            $table->string('label_type')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->double('building_width', 18, 2)->nullable();
            $table->double('building_length', 18, 2)->nullable();
            $table->double('building_height', 18, 2)->nullable();
            $table->double('building_area', 18, 2)->nullable();
            $table->text('image')->nullable();
            $table->text('image_left_side')->nullable();
            $table->text('image_right_side')->nullable();
            $table->text('image_back_side')->nullable();
            $table->text('image_opposite')->nullable();
            $table->text('gallery')->nullable();
            $table->text('land_document')->nullable();
            $table->text('title_deed_photos')->nullable();
            $table->integer('stories')->nullable();
            $table->boolean('is_rent')->default(0)->nullable();
            $table->boolean('is_sale')->default(0)->nullable();
            $table->boolean('is_appraisal')->default(0)->nullable();
            $table->boolean('request_indication_for_listing')->default(0)->nullable();
            $table->double('indication_min_price', 18, 2)->nullable();
            $table->datetime('indication_price_date')->nullable();
            $table->bigInteger('indication_price_updated_by')->unsigned()->nullable();
            $table->double('indication_max_price', 18, 2)->nullable();
            $table->string('prefix')->nullable();
            $table->string('sale_commission')->nullable();
            $table->string('rental_commission')->nullable();
            $table->string('exclusive_listing')->nullable();
            $table->string('shape')->nullable();
            $table->string('current_use')->nullable();
            $table->string('topography')->nullable();
            $table->string('functional_utilities')->nullable();
            $table->string('main_street')->nullable();
            $table->double('price_per_sqm', 18, 2)->nullable();
            $table->bigInteger('manager_id')->unsigned()->nullable();

            $table->text('video_embadded')->nullable();
            $table->json('surrounding')->nullable();
            $table->string('property_code')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable();
            $table->double('rating', 18, 2)->nullable();
            $table->string('agreement_type')->nullable();
            $table->text('agreement_file')->nullable();
            $table->date('agreement_sign_date')->nullable();
            $table->date('agreement_expired_date')->nullable();
            $table->json('polygon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
