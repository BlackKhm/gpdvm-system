<?php

namespace App\Models\Product;

use App\Liberies\uploads\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait\BaseModelTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Traits\CreateUpdateByTrait\CreateUpdateByTrait;

class Product extends Model
{
    use CrudTrait;
    use UploadTrait;
    use CreateUpdateByTrait;
    use BaseModelTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'gallery',
        'description',
        'color',
        'size',
        'discounts',
        'category',
        'contact_id',
        'created_by',
        'updated_by'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'double',
        'image' => 'string',
        'gallery' => 'array',
        'description' => 'string',
        'color' => 'json',
        'size' => 'array',
        'discounts' => 'double',
        'category' => 'string',
        'contact_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    public static $backpack = [
        'name'  =>  'required|string',
        'price' =>  'required|numeric',
        // 'image' =>  'required|string'
    ];  

 

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            $disk = "uploads";
        });
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Types\Type', 'category', 'id');
    }
    public function contact()
    {
        return $this->belongsTo('App\Models\Contacts\Contact', 'created_by','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Types\Type', 'category')->where('name', 'Product categories');
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

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function mergeImageGalleryToArray()
    {
        $arr = [];
        if($this->image){
            $arr[] = $this->image;
        }
        if (is_array($this->gallery)) {
            foreach ($this->gallery as $image) {
                $arr[] = $image;
            }
        }
        return $arr;
       
    }
   

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "uploads/images/" . date('Ym');
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }
    public function setGalleryAttribute($value)
    {
        $disk = "uploads";
        $attribute_name = "gallery";
        $destination_path = "uploads/images/" . date('Ym');

        $this->myUploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
    public function getGalleryMergeImageAttribute()
    {
        $arr = [];
        $gallery = $this->mergeImageGalleryToArray();
        if (is_array($gallery) && count($gallery)) {
            foreach($gallery as $image){
                $arr[] = $this->myFileExist($image, 'uploads');
            }
        }
        return $arr;
    }

    public function mergeImageGalleryForApi($disk = 'uploads', $useDefaultImage = true)
    {
        $marge = [];
        $gallery = $this->mergeImageGalleryToArray();

        if (is_array($gallery) && count($gallery)) {
            foreach ($gallery as $g) {
                $marge[] = $this->myAllImageSize($g, $disk, $useDefaultImage);
            }
        }
        return $marge;
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
