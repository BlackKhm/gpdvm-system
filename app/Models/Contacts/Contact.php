<?php

namespace App\Models\Contacts;

use App\Traits\CreateUpdateByTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait\BaseModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Contact extends Model
{
    use CrudTrait;
    use CreateUpdateByTrait;
    use SoftDeletes;
    use BaseModelTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fillable = [
        'id',
        'user_id',
        'category',
        'type',
        'last_name',
        'first_name',
        'email',
        'phone',
        'phone_2',
        'phone_3',
        'phone_4',
        'street_no',
        'house_no',
        'address',
        'zip_postalcode',
        'latitude',
        'longitude'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id'   =>  'integer',
        'type'  => 'string',
        'last_name' => 'string',
        'first_name' => 'string',
        'email'   => 'string',
        'phone' => 'string',
        'phone_2' => 'string',
        'phone_3' => 'string',
        'phone_4'  => 'string',
        'street_no' => 'string',
        'house_no' => 'string',
        'address' => 'string',
        'zip_postalcode' => 'integer',
        'latitude' => 'string',
        'longitude' => 'string'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(config('backpack.base.user_model_fqn'));
    }

    public function products()
    {
        return $this->hasMany('App\Models\Products\Product');
    }
    public function addCart()
    {
        return $this->hasMany('App\Models\AddCarties\AddCart');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Types\Type', 'category', 'id');
    }

    // public function contactCreatedBy()
    // {
    //     return $this->belongsTo('App\Models\Contacts\Contact', 'created_by','id');
    // }

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
    public function getFullNameAttribute()
    {
        $implode = [];

        if ($this->first_name) {
            $implode[] = $this->first_name;
        }

        if ($this->last_name) {
            $implode[] = $this->last_name;
        }

        return implode(' ', $implode);
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
