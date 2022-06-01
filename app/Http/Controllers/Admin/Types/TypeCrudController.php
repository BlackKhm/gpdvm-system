<?php

namespace App\Http\Controllers\Admin\Types;

use App\Models\Types\Type;
use App\Http\Requests\TypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TypeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;


    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements 
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 4);
    }


    public function setup()
    {
        CRUD::setModel(Type::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/type');
        CRUD::setEntityNameStrings('type', 'types');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'IconPath',
            'label' => "Icon",
            'type' => 'image',
            'height' => '50px',
            'width' => '50px',
        ]);

        $this->crud->addColumn([
            'name' => 'code',
            'label' => trans('flexi.code'),
        ]);

        $this->crud->addColumn(
            [
                'label' => trans('flexi.name'),
                'type' => "closure",
                'function' => function ($entry) {
                    return '<a href="' . route('type.index') . '?parent_id=' . $entry->id .'">'.$entry->name.'</a>';
                },
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->SearchName($searchTerm);
                }
            ]
        );

        $this->crud->addColumn([
            'name' => 'name_khm',
            'label' => trans('flexi.name_khm'),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'label' => trans('flexi.parent'),
            'type' => "select",
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => "name",
            'model' => "App\Models\V1\Types\Type",
        ]);

        $this->crud->addColumn([
            'name' => 'order',
            'label' => trans('flexi.order'),
            'type' => 'number'
        ]);

        $this->crud->addColumn([
            'name' => 'ios_class',
            'label' => trans('flexi.ios_class'),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'android_class',
            'label' => trans('flexi.android_class'),
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'web_class',
            'label' => trans('flexi.web_class'),
            'type' => 'text'
        ]);

        // $this->crud->addColumn([
        //     'name' => 'category',
        //     'label' => 'catgory',
        //     'type' => 'check'
        // ]);

        $this->crud->addColumn([
            'name' => 'display_on_frontend',
            'label' => trans('flexi.display_on_frontend'),
            'type' => 'check'
        ]);

        $this->crud->addColumn([
            'name' => 'require_authentication',
            'label' => trans('flexi.require_authentication'),
            'type' => 'check'
        ]);

        $this->crud->addColumn([
            'name' => 'active',
            'label' => 'catgory',
            'type' => 'check'
        ]);

        $this->crud->addColumn([
            'name' => 'description',
            'label' => trans('flexi.description'),
        ]);

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TypeRequest::class);

        CRUD::setFromDb(); // fields

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
