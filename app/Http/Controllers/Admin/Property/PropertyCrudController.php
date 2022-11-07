<?php

namespace App\Http\Controllers\Admin\Property;

use App\Models\Property\Property;
use App\Http\Requests\PropertyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PropertyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(Property::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/property');
        CRUD::setEntityNameStrings('property', 'properties');
    }

    protected function setupListOperation()
    {
    }
    
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PropertyRequest::class);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
