<?php

namespace App\Models\Accounts;

use App\Traits\CreateUpdateByTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait\BaseModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Account extends Model
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

    protected $table = 'accounts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fillable = [
        'ref_id',
        'ref_resource',
        'salesforce_id',
        'last_sync_modify',
        'account_number',
        'bank_branch',
        'borrower',
        'billing_address',
        'address',
        'valid_until',
        'description',
        'email',
        'industry',
        'indication_plus',
        'name',
        'parent_id',
        'phone',
        'property_owner',
        'rating',
        're_indication_plus',
        'website',
        'site',
        'account_source',
        'annual_revenue',
        'clean_status',
        'dandb_company',
        'jigsaw',
        'duns_number',
        'number_of_employees',
        'fax',
        'last_modified_by',
        'naics_code',
        'naics_desc',
        'operating_hours',
        'ownership',
        'shipping_address',
        'sic',
        'sic_desc',
        'ticker_symbol',
        'tradestyle',
        'type',
        'Year_started',
        'owner',
        'logo',
        'alias',
        'customer_type',
        'is_inactive',
        'free_trail_period_date',
        'change_period_date',
        'currency',
        'company_type',
        'group_company',
        'branch_category',
        'house_no',
        'street_no',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'id' => 'integer',
        'ref_id' => 'string',
        'ref_resource' => 'string',
        'account_number' => 'string',
        'bank_branch' => 'string',
        'billing_address' => 'string',
        'address' => 'string',
        'valid_until' => 'date',
        'description' => 'string',
        'email' => 'string',
        'industry' => 'string',
        'name' => 'string',
        'parent_id' => 'integer',
        'phone' => 'string',
        'rating' => 'string',
        'website' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'owner' => 'integer',
        'site'  => 'string',
        'account_source'    => 'string',
        'annual_revenue'    => 'double',
        'clean_status'  => 'string',
        'dandb_company' => 'integer',
        'jigsaw'    => 'string',
        'duns_number'   => 'string',
        'number_of_employees'   => 'integer',
        'fax'   => 'string',
        'last_modified_by' => 'integer',
        'naics_code'    => 'string',
        'naics_desc'    => 'string',
        'operating_hours'   => 'integer',
        'ownership' => 'string',
        'shipping_address'  => 'string',
        'sic'   => 'string',
        'sic_desc'  => 'string',
        'ticker_symbol' => 'string',
        'tradestyle'    => 'string',
        'type'  => 'string',
        'Year_started'  => 'string',
        'logo' => 'string',
        'alias' => 'string',
        'customer_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
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
