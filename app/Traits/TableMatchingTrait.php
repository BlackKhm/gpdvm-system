<?php

namespace App\Traits;

use App\Models\Products\Product;

trait TableMatchingTrait
{
    public function tableMatchingOrModelNamespace($value, $enbleFlip = false)
    {
        $data = [
            'product' => Product::class
        ];

        $data = collect($data);

        if ($enbleFlip){
            $data = $data->flip();
        }

        $data = $data->toArray();

        return $data[$value] ?? null;
    }
}