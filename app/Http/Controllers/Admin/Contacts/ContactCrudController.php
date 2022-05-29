<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\Models\Contacts\Contact;
use App\Http\Requests\Contacts\ContactRequest;
use App\Repositories\Contacts\ContactRepository;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ContactCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation{
        update as traitUpdate; 
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */

    protected $contactRepository;


    public function setup()
    {
        CRUD::setModel(Contact::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact');
        CRUD::setEntityNameStrings('contact', 'contacts');
        $this->contactRepository = resolve(ContactRepository::class);
    }


    protected function setupListOperation()
    {
        // CRUD::addFilter([
        //     'type'  => 'text',
        //     'name'  => 'FullName',
        //     'label' => 'FullName'
        //   ], 
        //   false, 
        //   function($value) { // if the filter is active
        //     $this->crud->addClause('where', 'first_name', 'LIKE', "%$value%");
        //   });


        // CRUD::addColumn([
        //     'name' => 'IdPrefix', // The db column name
        //     'label' => trans('translate.contactId'), // Table column heading
        //     'orderable' => true,
        //     'orderLogic' => function ($query, $column, $columnDirection) {
        //         return $query->OrderByIdPrefix($columnDirection);
        //     }
        // ]);
        // CRUD::addColumn([
        //     'name' => 'FullName', // The db column name
        //     'label' => "Name", // Table column heading
        //     'type' => 'Text'
        // ]);
        // Crud::addColumn([
        //     'name' => 'user_id',
        //     'label' => 'user',
        //     'type' => 'check'
        // ]);
        // CRUD::addColumn([
        //     'name' => 'email', // The db column name
        //     'label' => "Email", // Table column heading
        //     'type' => 'Text'
        // ]);
        // CRUD::addColumn([
        //     'name' => 'Address', // The db column name
        //     'label' => "Address", // Table column heading
        //     'type' => 'Text'
        // ]);
        // CRUD::addColumn([
        //     'name' => 'contact_type', // The db column name
        //     'label' => "Contact Type", // Table column heading
        //     'type' => 'Text'
        // ]);
        // CRUD::addColumn([
        //     'name' => 'create_by',
        //     'label' => 'Created By',
        //     'type' => "select",
        //     'entity' => 'contactCreatedBy',
        //     'attribute' => "Fullname",
        // ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContactRequest::class);

        $colMd3 = ['class' => 'form-group col-md-3'];
        $colMd6 = ['class' => 'form-group col-md-6'];
        $colMd12 = ['class' => 'form-group col-md-12'];

        CRUD::addField([
            'name'    => 'first_name',
            'label'         => 'First Name',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'last_name',
            'label'         => 'Last Name',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'email',
            'label'         => 'Email',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'phone',
            'label'         => 'Phone',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'phone1',
            'label'         => 'Phone1',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'phone2',
            'label'         => 'Phone2',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'phone3',
            'label'         => 'Phone3',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
        CRUD::addField([
            'name'    => 'street_no',
            'label'         => 'Street No',
            'type'          => 'text',
            'wrapper'        => $colMd6,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
