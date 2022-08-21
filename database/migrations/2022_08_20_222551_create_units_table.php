<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->bigInteger('property_feature_id')->unsigned()->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->double('width', 18, 2)->nullable();
            $table->double('length', 18, 2)->nullable();
            $table->double('area', 18, 2)->nullable();
            $table->integer('completion_year')->nullable();
            $table->integer('useful_life')->nullable();
            $table->integer('effective_age')->nullable();
            $table->integer('cost_estimate')->nullable();
            $table->integer('stories')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('livingroom')->nullable();
            $table->integer('diningroom')->nullable();
            $table->integer('door')->nullable();
            $table->integer('floor')->nullable();

            $table->integer('parking')->nullable();
            $table->integer('car_parking')->nullable();
            $table->integer('motor_parking')->nullable();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->string('design_appeal_type')->nullable();
            $table->string('quality_type')->nullable();
            $table->string('roofing_type')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('code')->nullable();
            $table->string('building_type')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->text('gallery')->nullable();
            $table->string('style')->nullable();
            $table->string('current_use')->nullable();
            $table->double('gross_floor_area', 18, 2)->nullable();
            $table->double('net_floor_area', 18, 2)->nullable();
            $table->string('main_walls')->nullable();
            $table->string('ceiling')->nullable();
            $table->string('flooring_materials')->nullable();
            $table->string('window_frames')->nullable();

            $table->boolean('balcony')->default(0)->nullable();
            $table->boolean('kitchen')->default(0)->nullable();
            $table->boolean('swimming_pool')->default(0)->nullable();
            $table->boolean('security')->default(0)->nullable();
            $table->boolean('fitness_gym')->default(0)->nullable();
            $table->boolean('lift')->default(0)->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('other_facilities')->nullable();
            $table->text('floor_plan')->nullable();
            $table->double('rent_income_per_month_if_any', 18, 2)->nullable();
            $table->double('price_per_sqm', 18, 2)->nullable();
            $table->string('project_building')->nullable();
            $table->string('project_name')->nullable();

            $table->text('building_additional_notes')->nullable();
            $table->integer('building_height')->nullable();
            $table->string('construction_status')->nullable();
            $table->double('cost_estimate_new_per_sqm', 18, 2)->nullable();
            $table->string('date_of_construction')->nullable();
            $table->double('depreciated_cost', 10, 2)->nullable();
            $table->double('depreciated_formula', 18, 2)->nullable();
            $table->double('depreciation', 10, 2)->nullable();
            $table->double('depreciation_obsolescense_formula', 18, 2)->nullable();
            $table->double('gross_building_area', 18, 2)->nullable();
            $table->double('gross_building_size', 12, 2)->nullable();
            $table->double('gross_building_value', 12, 2)->nullable();
            $table->double('max_rate_multiple_building', 12, 2)->nullable();
            $table->double('min_rate_bultiple_building', 12, 2)->nullable();
            $table->integer('no_of_kitchen')->nullable();
            $table->integer('of_storey')->nullable();
            $table->string('old_org_id')->nullable();
            $table->string('property')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
