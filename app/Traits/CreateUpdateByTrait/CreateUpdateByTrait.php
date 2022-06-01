<?php

namespace App\Traits\CreateUpdateByTrait;

use App\Models\Contacts\Contact;
use App\Traits\GetUserLoginTrait;

trait CreateUpdateByTrait
{
    use GetUserLoginTrait;

    /*
    |--------------------------------------------------------------------------
    | CONFIG
    |--------------------------------------------------------------------------
    */

    public function createUpdateByConfig()
    {
        return (object)[
            'lang_ai' => $this->createUpdateByLangAi ?? trans('flexi.ai'),
            'attribute' => $this->createUpdateByAttribute ?? 'FullName',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    
    /**
     * @param \Model $model
     * @param string $type
     * 
     * @return \Model
     */
    public function createUpdateBy($model, $type)
    {
        $model->{$type} = request()->{$type}
            ? request()->{$type}
            : $this->getLoginContactOrUser();

        return $model;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function createdBy()
    {
        return $this->belongsTo(Contact::class, 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo(Contact::class, 'updated_by');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getCreatedByOrAiAttribute()
    {
        $config = $this->createUpdateByConfig();

        return $this->CreatedByOrNull ?? $config->lang_id;
    }

    public function getUpdatedByOrAiAttribute()
    {
        $config = $this->createUpdateByConfig();

        return $this->UpdatedByOrNull ?? $config->lang_id;
    }

    public function getCreatedByOrNullAttribute()
    {
        $config = $this->createUpdateByConfig();

        return optional($this->createdBy)->{$config->attribute} ?? NULL;
    }

    public function getUpdatedByOrNullAttribute()
    {
        $config = $this->createUpdateByConfig();

        return optional($this->updatedBy)->{$config->attribute} ??  NULL;
    }
}