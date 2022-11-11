<?php

namespace App\Models\Submitcases;

use App\Traits\CreateUpdateByTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait\BaseModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Submitcase extends Model
{
    use CrudTrait;
    /* A trait that is used to create and update the created_by and updated_by fields in the database. */
    // use CreateUpdateByTrait;
    use SoftDeletes;
    use BaseModelTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'submit_cases';
 
    protected $guarded = ['id'];
   
    public $fillable = [
        'ref_id',
        //'ref_resource',
        'salesforce_id',
        'last_sync_modify',
        'property_id',
        'assign_to_group_id',
        'assign_to_group_at',
        'parent_id',
        'account_id',
        'approved_by',
        'contact_email',
        'contact_fax',
        'contact_id',
        'contact_mobile',
        'contact_phone',
        'owner_id',
        'contact_request_by',
        'account_request_by',
        'supplied_company',
        'supplied_email',
        'supplied_name',
        'supplied_phone',
        'reporter',
        'surveyor',
        'cooperate_partner_name',
        'is_closed_on_create',
        'is_escalated',
        'is_private',
        'is_late_case',
        'market_value',
        'closed_date',
        'due_date',
        'name',
        'currency_iso_code',
        'email_to_case_from',
        'instructor_name',
        'subject',
        'description',
        'comments',
        'text_closed_reason',
        'sf4twitter_author_external_id',
        'sf4twitter_twitter_username',
        'sf4twitter_twitter_id',
        'priority',
        'reason',
        'case_pending_reason',
        'source_id',
        'case_status',
        'status_image',
        'case_type',
        'property_photo',
        'title_deed_photos',
        'identity_card_photos',
        'code',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'canceled_by',
        'canceled_at',
        'account_bm_sharing',
        'account_hq_sharing',
        'asset_id',
        'attachment',
        'bank_instructor_name',
        'bank_instructor_phone',
        'body',
        'business_hours_id',
        'company_name',
        'company_user',
        'is_late_than_due_date',
        'mobile_contact',
        'old_org_id',
        'original_import_id',
        'reason_pending_case',
        'reason_cancel_case',
        'sf4twitter_author_external_id',
        'data_json',
        'deleted_at',
        'renew_term_date',
        'renew_term',
        'send_seven_day',
        'send_today',
        'send_notification',
        'approved_rate_manually',
        'approved_rate_manually_by',
        'approved_rate_manually_reason',
        'request_rate_manually',
        'request_rate_manually_by',
        'request_rate_manually_reason',
        'payment_status',
        'first_download_report',
        'is_last_case',
        'contact_2',
        'json_store',
        'z1_pdf_link',
        'archived_at',
        'case_updated_at',
        'borrow_by_id',
        'borrow_by_parent_id',
        'property_owner_by_parent_id',
        'is_mobile_read'
    ];

    protected $casts = [
        'ref_id' => 'string',
        'ref_resource' => 'string',
        'property_id' => 'integer',
        'assign_to_group_id' => 'integer',
        'assign_to_group_at' => 'datetime',
        'parent_id' => 'integer',
        'account_id' => 'integer',
        'approved_by' => 'integer',
        'contact_email' => 'string',
        'contact_fax' => 'string',
        'contact_id' => 'integer',
        'contact_mobile' => 'string',
        'contact_phone' => 'string',
        'contact_request_by' => 'integer',
        'account_request_by' => 'integer',
        'owner_id' => 'integer',
        'supplied_company' => 'string',
        'supplied_email' => 'string',
        'supplied_name' => 'string',
        'supplied_phone' => 'string',
        'reporter' => 'integer',
        'surveyor' => 'integer',
        'cooperate_partner_name' => 'string',
        'is_closed_on_create' => 'boolean',
        'is_escalated' => 'boolean',
        'is_private' => 'boolean',
        'is_late_case' => 'boolean',
        'market_value' => 'double',
        'closed_date' => 'date',
        'due_date' => 'datetime',
        'name' => 'string',
        'currency_iso_code' => 'string',
        'email_to_case_from' => 'string',
        'instructor_name' => 'string',
        'subject' => 'string',
        'comments' => 'string',
        'text_closed_reason' => 'string',
        'sf4twitter_author_external_id' => 'string',
        'sf4twitter_twitter_username' => 'string',
        'sf4twitter_twitter_id' => 'string',
        'priority' => 'string',
        'reason' => 'string',
        'case_pending_reason' => 'string',
        'reason_cancel_cases' => 'string',
        'source_id' => 'integer',
        'case_status' => 'string',
        'status_image' => 'string',
        'case_type' => 'string',
        'property_photos' => 'string',
        'title_deed_photos' => 'array',
        'identity_card_photos' => 'array',
        'code' => 'string',
        'note' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'account_bm_sharing' => 'integer',
        'account_hq_sharing' => 'integer',
        'asset_id' => 'integer',
        'attachment' => 'string',
        'bank_instructor_name' => 'string',
        'bank_instructor_phone' => 'string',
        'body' => 'string',
        'business_hours_id' => 'integer',
        'company_name' => 'string',
        'company_user' => 'string',
        'is_late_than_due_date' => 'boolean',
        'mobile_contact' => 'boolean',
        'old_org_id' => 'string',
        'original_import_id' => 'string',
        'reason_pending_case' => 'string',
        'sf4twitter_author_external_id' => 'string',
        'data_json' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'renew_term_date'  => 'datetime',
        'renew_term' => 'integer',
        'send_seven_day' => 'datetime',
        'send_today' => 'datetime',
        'send_notification' => 'datetime',
        'approved_rate_manually' => 'boolean',
        'approved_rate_manually_by' => 'integer',
        'approved_rate_manually_reason' => 'string',
        'request_rate_manually' => 'boolean',
        'request_rate_manually_by' => 'integer',
        'request_rate_manually_reason' => 'string',
        'first_download_report' => 'datetime',
        'is_last_case' => 'boolean',
        'contact_2' => 'integer',
        'json_store' => 'string',
        'z1_pdf_link' => 'string',
        'archived_at'  => 'datetime',
        'case_updated_at' => 'datetime',
        'borrow_by_id' => 'integer',
        'borrow_by_parent_id' => 'integer',
        'property_owner_by_parent_id' => 'integer',
        'is_mobile_read' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
   

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
  
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
