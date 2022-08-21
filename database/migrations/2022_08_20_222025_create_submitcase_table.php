<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_cases', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 36)->nullable()->index();
            $table->string('ref_resource')->nullable();
            $table->string('salesforce_id', 36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('account_id')->unsigned()->nullable()->index();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->bigInteger('reporter')->unsigned()->nullable();
            $table->bigInteger('surveyor')->unsigned()->nullable();
            $table->bigInteger('assign_to_group_id')->unsigned()->nullable();
            $table->datetime('assign_to_group_at')->nullable();
            $table->unsignedBigInteger('account_bm_sharing')->nullable();
            $table->unsignedBigInteger('account_hq_sharing')->nullable();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('cooperate_partner_name')->nullable();
            $table->string('currency_iso_code')->nullable();
            $table->string('case_pending_reason')->nullable();
            $table->string('case_status')->nullable();
            $table->string('case_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_user')->nullable();
            $table->string('code')->nullable();
            $table->timestamp('closed_date')->nullable();

            $table->bigInteger('source_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->string('supplied_company')->nullable();
            $table->string('supplied_email')->nullable();
            $table->string('supplied_name')->nullable();
            $table->string('supplied_phone')->nullable();
            $table->string('status_image')->nullable();
            $table->string('sf4twitter_twitter_username')->nullable();
            $table->string('sf4twitter__author_external_id')->nullable();
            $table->string('sf4twitter_twitter_id')->nullable();

            $table->boolean('is_closed_on_create')->default(0)->nullable();
            $table->boolean('is_escalated')->default(0)->nullable();
            $table->boolean('is_private')->default(0)->nullable();
            $table->boolean('is_late_case')->default(0)->nullable();
            $table->boolean('is_late_than_due_date')->default(0)->nullable();
            $table->string('instructor_name')->nullable();
            $table->text('identity_card_photos')->nullable();
            $table->string('name')->nullable();
            $table->double('market_value', 18, 2)->nullable();
            $table->unsignedBigInteger('mobile_contact')->nullable();

            $table->string('attachment')->nullable();
            $table->string('bank_instructor_name')->nullable();
            $table->string('bank_instructor_phone')->nullable();
            $table->unsignedBigInteger('business_hours_id')->nullable();
            $table->longText('body')->nullable();
            $table->string('comments')->nullable();
            $table->date('due_date')->nullable();
            $table->longText('description')->nullable();
            $table->text('note')->nullable();
            $table->string('email_to_case_from')->nullable();

            $table->string('priority')->nullable();
            $table->text('property_photo')->nullable();
            $table->string('text_closed_reason')->nullable();
            $table->text('title_deed_photos')->nullable();
            $table->string('reason')->nullable();
            $table->text('reason_pending_case')->nullable();

            $table->string('old_org_id')->nullable();
            $table->string('original_import_id')->nullable();

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
        Schema::dropIfExists('submit_cases');
    }
}
