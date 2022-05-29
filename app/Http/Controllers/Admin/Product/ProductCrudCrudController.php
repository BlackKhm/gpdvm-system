<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\Product;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductCrudCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'Products');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addFilter([
            'type'  => 'text',
            'name'  => 'name',
            'label' => 'Name'
          ], 
          false, 
          function($value) { // if the filter is active
            $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
          });


        // CRUD::setFromDb(); // columns
        CRUD::addColumn([
            'name' => 'IdPrefix',
            'label' => "ProductID",
        ]);
        CRUD::addColumn([
            'name' => 'ThumbnailPath',
            'label' => "Image",
            'type' => 'image',
            'height' => '30px',
            'width' => '50px',
        ]);
        CRUD::addColumn([
            'name' => 'name',
            'label' => "name",
            'type' => 'text',
        ]);
        
        CRUD::addColumn([
            'name' => 'PriceFormat',
            'label' => "price",
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'DiscounFormat',
            'label' => "Price Discount",
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'color',
            'label' => "Color",
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'FullName',
            'label' => "Created By",
            'type' => 'text',
        ]);
    }
    protected function setupCreateOperation()
    {
        $colMd3 = ['class' => 'form-group col-md-3'];
        $colMd6 = ['class' => 'form-group col-md-6'];
        $colMd12 = ['class' => 'form-group col-md-12'];
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name',
            'wrapper' => $colMd6,
        ]);
        CRUD::addField([
            'name' => 'price',
            'type' => 'text',
            'label' => 'Price',
            'wrapper' => $colMd6,
        ]);
        CRUD::addField([
            'name' => 'discounts',
            'type' => 'text',
            'label' => 'Price Discounts',
            'wrapper' => $colMd6,
        ]);
       
        CRUD::addField([
            'label' => 'Size',
            'name' => 'size',
            'type' => 'text',
            'wrapper' => $colMd6
        ]);
       
        // CRUD::addField([
        //     'label' => 'Color',
        //     'name' => 'color',
        //     'type' => 'color_picker',
        //     'color_picker_options' => ['customClass' => 'custom-class'],
        //     'wrapper' => $colMd6
        // ]);
        
        CRUD::addField([
            'name'      => 'description',
            'type'      => 'summernote',
            'label'     => 'Descriptions',
            'attributes' => ['rows' => '10'],
            'options' => [
                'toolbar' => [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            ],
            'wrapper' => $colMd12,
        ]);
        CRUD::addField([
            'label' => "Image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 1
        ]);

        CRUD::addField([   // Upload
            'name'      => 'gallery',
            'label'     => 'Gallery',
            'type'      => 'upload_multiple',
            'upload'    => true,
        ],);
    }

  
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
	/**
	 */
}
