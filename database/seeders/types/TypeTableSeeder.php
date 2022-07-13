<?php

namespace Database\Seeders\types;

use App\Models\Types\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=TypeTableSeeder
     * @return void
     */
    public function run()
    {
        Type::truncate();
        $arrParents = [
            '1'     =>  'Product categories',
        ];
        $this->arrForCreate($arrParents);
        $this->runLoop( 1, [
            'Man' => ['Nike', 'Adidas', 'Petro']
        ],'category');
    }


    private function arrForCreate($arr)
    {
        foreach($arr as $k => $val){
            Type::firstOrCreate(['id'=>$k,'name' => $val, 'parent_id' => 0,'option' => true,'category' => true]);
        }
    }

    private function runLoop($parentValue, $children = [], $option)
    {

        if (!$parentValue) {
            return false;
        }
        $option_check = 0;
        $category_check = 0;

        if($option == 'all'){
            $option_check = 1;
            $category_check = 1;
        }elseif($option == 'option') {
            $option_check = 1;
        }else{
            $category_check = 1;
        }

        if (is_array($children) && count($children)) {
            foreach ($children as $key => $value) :
                if (is_array($value) && count($value)) {
                    $grand_children = Type::firstOrCreate(['name' => $key, 'parent_id' => $parentValue,'option' => $option_check,'category' => $category_check]);
                    foreach ($value as $kk => $vv) :
                        Type::firstOrCreate(['name' => $vv, 'parent_id' => $grand_children->id,'option' => $option_check,'category' => $category_check]);
                    endforeach;
                } else {
                    Type::firstOrCreate(['name' => $value, 'parent_id' => $parentValue,'option' => $option_check,'category' => $category_check]);
                }
            endforeach;
        }
    }
}
