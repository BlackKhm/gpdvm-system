<?php

namespace Database\Seeders\types;

use App\Models\Types\Type;
use Illuminate\Database\Seeder;
use App\Traits\Type\CreateTypeSeederTrait;

class TypeTableSeeder extends Seeder
{
    use CreateTypeSeederTrait;
    /**
     * Run the database seeds.
     * 
     * php artisan db:seed --class="Database\Seeders\types\TypeTableSeeder"
     * @return void
     */
    public function run()
    {
        request()->merge(['disableParentChildrenEvent' => true]);

        $arr = [
            1 => [
                "name"      => "Product categories", // Name of parent
                "name_khm"  => "",
                "code"      => "",
                "auto_code" => true
            ]
        ];

        $this->checkIfHaveParentAndCreate($arr);
        $this->forceDeleteWhereParentId([1]); // optional place with other

        $arrMaintenanceStatus = [
            [
                "name"      => "Already maintenace",
                "name_khm"  => "",
                "code"      => "",
                "auto_code" => true
            ],
            [
                "name"      => "Plan from maintenance",
                "name_khm"  => "",
                "code"      => "",
                "auto_code" => true
            ],
            [
                "name"      => "Under maintenance",
                "name_khm"  => "",
                "code"      => "",
                "auto_code" => true
            ]
        ];

        $this->runLooping(1 , $arrMaintenanceStatus , 'option');
    }
}
