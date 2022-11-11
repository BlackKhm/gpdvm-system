<?php

namespace App\Http\Controllers\Admin\Submitcases;

use App\Models\Submitcases\Submitcase;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class SubmitcaseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(Submitcase::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/submitcase');
        CRUD::setEntityNameStrings('submitcase', 'submitcases');
    }

    protected function setupListOperation()
    {

    }
    
    protected function setupCreateOperation()
    {
        // CRUD::setValidation(PropertyRequest::class);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
