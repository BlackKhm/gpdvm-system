<?php

namespace App\Traits\ReorderTraits;

trait ReorderDepthTrait
{
    /**
     * @param \Model $model
     * @param string $type
     * 
     * @return \Model
     */
    public function reorderDepth($model, $type)
    {
        switch($type) {
            case "creating":
                if ($model->parent_id) {
                    try {
                        $parent = $model::withTrashed()->find($model->parent_id);
                    } catch (\Throwable $th) {
                        $parent = $model::find($model->parent_id);
                    }
                    
                    if ($parent) {
                        $model->depth = $parent->depth + 1;
                    }
                } else {
                    $model->depth = 1;
                }
            break;

            case "updating":
                if ($model->parent_id != $model->getOriginal('parent_id')) {
                    // $parent = $model::find($model->parent_id);
                    try {
                        $parent = $model::withTrashed()->find($model->parent_id);
                        // $parent = $model::withTrashed()->find($model->parent_id);
                    } catch (\Throwable $th) {
                        $parent = $model::find($model->parent_id);
                    }
                    
                    if ($parent) {
                        $model->depth = $parent->depth + 1;
                    }
                }
            break;
        }

        return $model;
    }
}