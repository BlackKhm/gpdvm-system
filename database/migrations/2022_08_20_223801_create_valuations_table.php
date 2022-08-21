<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuations', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->string('record_type')->nullable();
            $table->bigInteger('property_feature_id')->unsigned()->nullable();
            $table->bigInteger('submit_case_id')->unsigned()->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->bigInteger('certified_appraiser_director')->unsigned()->nullable();
            $table->bigInteger('certified_appraiser')->unsigned()->nullable();
            $table->bigInteger('mobile_contact')->unsigned()->nullable();
            $table->bigInteger('senior_appraiser_supervisor')->unsigned()->nullable();
            $table->bigInteger('surveyor_1')->unsigned()->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_instructor_name')->nullable();
            $table->string('bank_instructor_phone')->nullable();
            $table->string('bank')->nullable();

            $table->text('identity_of_client')->nullable();
            $table->text('current_use')->nullable();
            $table->text('conclusion_of_value')->nullable();
            $table->string('case')->nullable();
            $table->text('general_comments')->nullable();
            $table->text('display_sell_rent_price')->nullable();
            $table->text('intented_user_text')->nullable();
            $table->text('restriction_encumbrances')->nullable();
            $table->longText('property_transfer_history')->nullable();
            $table->string('valuation_methodology')->nullable();
            $table->string('valuation_validity')->nullable();
            $table->date('date_of_data_receipt')->nullable();
            $table->date('report_date')->nullable();
            $table->date('date_of_inspection')->nullable();
            $table->date('transaction_date')->nullable();
            $table->date('indication_date')->nullable();
            $table->date('valuation_date')->nullable();
            $table->date('valuation_validity_from')->nullable();
            $table->date('valuation_validity_to')->nullable();
            $table->double('adjusted_land_value_per_sqm', 18, 2)->nullable();
            $table->double('adjustment', 18, 2)->nullable();
            $table->double('cost_estimate_new_per_sqm', 18, 2)->nullable();
            $table->double('current_value_of_improvement', 18, 2)->nullable();
            $table->double('fire_depreciated_replacement_cost', 18, 2)->nullable();
            $table->double('fire_insurable_value', 18, 2)->nullable();
            $table->double('fire_less_underground_percentage', 18, 2)->nullable();
            $table->double('fire_less_underground_value', 18, 2)->nullable();
            $table->double('fire_plus_demolition_percentage', 18, 2)->nullable();
            $table->double('fire_plus_demolition_value', 18, 2)->nullable();

            $table->double('forced_sale_convert_to_percent', 18, 2)->nullable();
            $table->double('forced_sale_less_discount_value', 18, 2)->nullable();
            $table->double('forced_sale_value', 18, 2)->nullable();
            $table->double('gross_building_value', 18, 2)->nullable();
            $table->double('gross_land_price_estimate', 18, 2)->nullable();
            $table->double('gross_land_value', 18, 2)->nullable();
            $table->double('gross_land_value_per_sqm', 18, 2)->nullable();
            $table->double('gross_building_size', 18, 2)->nullable();
            $table->double('land_area', 18, 2)->nullable();
            $table->double('length', 18, 2)->nullable();
            $table->double('less_sale_discount_for_the_subject', 18, 2)->nullable();
            $table->double('list_price', 18, 2)->nullable();
            $table->double('location_adjust', 18, 2)->nullable();
            $table->double('market_value', 18, 2)->nullable();
            $table->double('max_rate_building', 18, 2)->nullable();
            $table->double('max_rate_land', 18, 2)->nullable();
            $table->double('min_rate_building', 18, 2)->nullable();
            $table->double('min_rate_land', 18, 2)->nullable();
            $table->double('proximity_subject', 18, 2)->nullable();
            $table->double('rent_income_per_month', 18, 2)->nullable();
            $table->string('rented_price_unit')->nullable()->comment('per month, per year, per sq/month');
            $table->double('rented_price', 18, 2)->nullable();
            $table->double('site_improvements_adjust', 18, 2)->nullable();
            $table->double('site_shape_adjust', 18, 2)->nullable();
            $table->double('site_size', 18, 2)->nullable();
            $table->double('site_size_adjust', 18, 2)->nullable();
            $table->double('sold_price', 18, 2)->nullable();
            $table->double('topography_adjust', 18, 2)->nullable();
            $table->double('total_appraised_value', 18, 2)->nullable();
            $table->double('total_average_price', 18, 2)->nullable();
            $table->double('total_max_price_value', 18, 2)->nullable();
            $table->double('total_min_price_value', 18, 2)->nullable();
            $table->double('total_fire_insurable_value', 18, 2)->nullable();
            $table->double('total_force_sale_value', 18, 2)->nullable();
            $table->double('total_replacement_cost_new', 18, 2)->nullable();
            $table->double('total_value_of_the_subject_land', 18, 2)->nullable();
            $table->double('total_depreciation_obsolescence', 18, 2)->nullable();
            $table->double('total_net_adjustment', 18, 2)->nullable();

            $table->double('indicated_value_for_subject_sqm', 18, 2)->nullable();
            $table->double('weighting', 18, 2)->nullable();
            $table->boolean('is_private')->default(0)->nullable();
            $table->boolean('show_force_sale_value')->default(0)->nullable();
            $table->boolean('show_insurable_value')->default(0)->nullable();
            $table->boolean('show_valuation_date_validity')->default(0)->nullable();
            $table->string('basis_of_value_option_id')->nullable();
            $table->string('current_use_valuation_option_id')->nullable();
            $table->string('data_source_verification_option_id')->nullable();
            $table->string('financing_type_option_id')->nullable();
            $table->string('forced_sale_less_discount_percentage_option_id')->nullable();
            $table->string('intended_use_option_id')->nullable();
            $table->string('intended_user_option_id')->nullable();
            $table->string('location_option_id')->nullable();
            $table->string('methodology_option_id')->nullable();
            $table->string('property_inspection_option_id')->nullable();
            $table->string('property_interest_appraised_option_id')->nullable();
            $table->string('purpose_of_valuation_option_id')->nullable();
            $table->string('purpose_of_property')->nullable()->comment('Rent, Sale, Purchase, Loan Security, Asset Management, Cooperate Real Estate, Compensation, Insurance, Tax Assessment, Internal Management, Court Proceedings, Other');

            $table->string('site_improvements_option_id')->nullable();
            $table->string('site_shape_option_id')->nullable();
            $table->string('sold_price_unit_option_id')->nullable();
            $table->string('special_assumptions_option_id')->nullable();
            $table->string('status_of_valuer_option_id')->nullable();
            $table->string('status_of_transaction')->nullable()->comment('Available, Transaced, Inactive');
            $table->string('transaction_type_option_id')->nullable();
            $table->string('zoning_classification_option_id')->nullable();
            $table->string('valuation_standards_option_id')->nullable();
            $table->string('valuation_step_option_id')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('pdf_link')->nullable();

            $table->string('old_org_id')->nullable();
            $table->string('original_import_id')->nullable();
            $table->double('origin_total_value_of_the_subject_land', 18, 2)->nullable();
            $table->bigInteger('comparable_1')->unsigned()->nullable();
            $table->bigInteger('comparable_2')->unsigned()->nullable();
            $table->bigInteger('comparable_3')->unsigned()->nullable();
            $table->bigInteger('comparable_4')->unsigned()->nullable();
            $table->bigInteger('comparable_5')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valuations');
    }
}
