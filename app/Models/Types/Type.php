<?php

namespace App\Models\Types;

use App\Models\Contacts\Contact;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait\BaseModelTrait;
use App\Traits\ReorderTraits\ParentDepthTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Type extends Model
{
    use CrudTrait;
    use BaseModelTrait;
    use ParentDepthTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'types';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $fillable = [
        'ref_id',
        'ref_resource',
        'salesforce_id',
        'last_sync_modify',
        'name',
        'code',
        'icon',
        'description',
        'active',
        'parent_id',
        'display_on_frontend',
        'display_on_backend',
        'require_authentication',
        'ios_class',
        'android_class',
        'web_class',
        'category',
        'option',
        'lft',
        'rgt',
        'depth',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ref_id' => 'string',
        'ref_resource' => 'string',
        'name' => 'string',
        'code' => 'string',
        'icon' => 'string',
        'description' => 'string',
        'active' => 'boolean',
        'parent_id' => 'integer',
        'display_on_frontend' => 'boolean',
        'display_on_backend' => 'boolean',
        'require_authentication' => 'boolean',
        'ios_class' => 'string',
        'android_class' => 'string',
        'web_class' => 'string',
        'category' => 'boolean',
        'option' => 'boolean',
        'lft' => 'integer',
        'rgt' => 'integer',
        'depth' => 'integer',
        'order',
        'name_khm',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function allQuery()
    {
        return $this->hasMany(self::class);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product\Product', 'category_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function category()
    {
        return $this->hasOne('App\Models\Product\Product', 'category_id');
    }

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
    public function scopeProductCategory($query)
    {
        return $query->where('name', 'Product categories');
    }
    public function scopeGetType($query)
    {
        return $query->with('children');
    }
    public function scopeIsActiveIsCategory($query)
    {
        return $query->where('active', true)->where('category', true);
    }
    public function scopeIsActiveIsOption($query)
    {
        return $query->where('active', true)->where('category', false);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }
    public function getIconPathAttribute()
    {
        return is_null($this->icon) ? "assets/default.png" : $this->icon;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
