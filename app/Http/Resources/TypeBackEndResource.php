<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeBackEndResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'value'  => $this->code ?? $this->name,
            'text'  => $this->name, //should use name text or Lable
            'parent_id' => $this->parent_id,
            'ios_class' => $this->ios_class,
            'android_class' => $this->android_class,
            'web_class' => $this->web_class,
            'description' => $this->description,
            'icon'  => $this->RealImage,
            'active'  => $this->active = 0 ? false : true,
            'display_on_frontend' => $this->display_on_frontend = 0 ? false : true,
            'require_authentication' => $this->require_authentication = 0 ? false : true,
            // 'children' => $this->data($this->children)
        ];
    }
}
