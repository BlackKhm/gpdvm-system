<?php

namespace App\Repositories\Types;

// use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Types\Type;
use App\Http\Resources\TypeResource;
use App\Repositories\BaseRepository;
use App\Http\Resources\TypeBackEndResource;

//use Your Model

class TypeRepository extends BaseRepository
{
    
    protected $fieldSearchable = [
        'ref_id',
        'ref_resource',
        'name',
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'created_by',
        'updated_by'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Type::class;
    }



    

    public function getTypesByParentIDs($arr, $resource = true, $except = [])
    {   
        $types = $this->model->whereIn('parent_id', $arr)->where(function ($q) use ($except) {
            if (is_array($except) && count($except)) {
                $q->where($except);
            }
        })->where('active', 1)->get();
        if($resource){
            TypeResource::withoutWrapping();
            return TypeResource::collection($types);
        }
        TypeBackEndResource::withoutWrapping();
        return TypeBackEndResource::collection($types);
    }
}
