<?php

namespace App\Traits;

use App\Traits\CreateUpdateByTrait\CreateUpdateByTrait as CreateUpdateByCloneTrait;

trait CreateUpdateByTrait
{
    // use \App\Traits\GetUserLoginTrait;
    use CreateUpdateByCloneTrait;
    /**
     * How to use
     * use \App\Traits\CreateUpdateByTrait;
     * 
     * *** NOTE: THIS TRAIT NOT SUPPORT MULTIPLE AUTH GUARD
     * *** SUPPORT SINGLE AUTH BOTH LARAVEL | BACKPACK MUST USE SAME GUARD
     */
    public static function BootCreateUpdateByTrait()
    {
        static::creating(function ($obj) {
            $obj = $obj->createUpdateBy($obj, 'created_by');
            // $obj->created_by = request()->created_by
            // ? request()->created_by
            // : $obj->getLoginContactOrUser();
        });

        static::updating(function ($obj) {
            $obj = $obj->createUpdateBy($obj, 'updated_by');
            // $obj->updated_by = request()->updated_by
            // ? request()->updated_by
            // : $obj->getLoginContactOrUser();

            // \Log::info(self::class . ' has request: '. (request()->updated_by
            // ? request()->updated_by
            // : $obj->getCurrentUserId()));
            // \Log::info(((string)!empty(request()->updated_by)));
        });
    }

    // public function getCurrentUserId()
    // {
    //     $id = null;

    //     // Web auth or auth with middleware auth|auth:api
    //     $auth = optional(\Auth::user());
        
    //     if (!$auth->id) { // auth without inside middleware auth:api but has bearer token
    //         $auth = optional(\Auth::guard('api')->user());
    //     }

    //     if (!$auth->id) { // if default or guard api false get fallback to check backpack
    //         $auth = optional(backpack_user());
    //     }

    //     if ($auth->id) { // $auth fall to find contact fallback to $id = null
    //         return optional($auth->contact)->id ?? $id;
    //     }

    //     // $auth = optional(\Auth::user())->contact;
    //     // if ($auth) {
    //     //     return $auth->id ?? $id;
    //     // }

    //     // $backpack = optional(backpack_user())->contact;
    //     // if ($backpack) {
    //     //     return $backpack->id ?? $id;
    //     // } 

    //     return $id;
    // }

    // public function createdBy()
    // {
    //     return $this->belongsTo(\App\User::class, 'created_by');
    // }
    // public function updatedBy()
    // {
    //     return $this->belongsTo(\App\User::class, 'updated_by');
    // }

    // public function getCreatedByOrAiAttribute()
    // {
    //     return $this->CreatedByOrNull ?? trans('flexi.ai');
    // }

    // public function getUpdatedByOrAiAttribute()
    // {
    //     return $this->UpdatedByOrNull ?? trans('flexi.ai');
    // }

    // public function getCreatedByOrNullAttribute()
    // {
    //     return optional($this->createdBy)->NameOrId;
    // }

    // public function getUpdatedByOrNullAttribute()
    // {
    //     return optional($this->updatedBy)->NameOrId;
    // }
}