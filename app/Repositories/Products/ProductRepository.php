<?php

namespace App\Repositories\Products;

use GuzzleHttp\Psr7\Request;
use App\Models\Products\Product;
use App\Traits\GetUserLoginTrait;
use App\Models\AddCarties\AddCart;
use App\Models\OrderProducts\OrderProduct;
use App\Models\Orders\Order;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    use GetUserLoginTrait;
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function getProduct($request){
        $category = $request->type; 
        $search = $request->search; 
        $query = $this->model->query();
        if($category){
            $query->orWhere('category', $category);
        }
        if($search){
            $query->orWhere('name', 'like','%'.$search.'%');
        }
        return Product::paginate(10);
    }
    public function createProduct($request){
        $product = $this->model->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'color' => $request->color,
            'size' => $request->size,
            'discounts' => $request->discounts,
            'created_by' => $this->getLoginContactOrUser()
        ]);
        return $product;
    }

    public function realetedProduct($request){
        return Product::ShortByRenewDate()->paginate(4);
    }

    public function addItem($request){
        $order = $this->model->orders();
        dd($order);
        if($request->id){
            $product = $this->model->where('id', $request->id)->first();
            return $order->create([
                'product_id' => $product->id ?? null,
                'name' => $product->name ?? '',
                'quantity' => $request->quantity,
                'total' => $request->total,
                'created_by' => $this->getLoginContactOrUser()
            ]);
        }
        return false;
    }
}
