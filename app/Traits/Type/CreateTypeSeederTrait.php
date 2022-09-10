<?php

namespace App\Traits\Type;

use App\Models\Types\Type;


trait CreateTypeSeederTrait
{
    private function formatStrPad($value){
        return str_pad($value, 3, '100', STR_PAD_LEFT);
    }

    private function checkIfHaveParentOrNot($arr){
        foreach($arr as $k => $val){
            $checkParent = Type::where('id', $k)->first();
            if(!$checkParent){
                Type::firstOrCreate(['id_code'=> $this->formatStrPad($k),'name' => $val,'option' => true,'category' => true]);
            }
        }
    }

    private function createType($idCode, $name, $parentId, $plus, $option)
    {
        $optionCheck    = $option == 'all' || $option == 'option' ? 1 : 0;
        $categoryCheck  = $option == 'all' || $option == 'category' ? 1 : 0;

        return  Type::create(['id_code' => $this->formatStrPad($idCode).(100 + $plus),
                            'parent_id_code' => $this->formatStrPad($idCode),
                            // 'code'           => $key,
                            'code'           => $name,
                            'name'           => $name,
                            'parent_id'      => $parentId,
                            'option'         => $optionCheck,
                            'category'       => $categoryCheck
                        ]);

    }

    private function runLoop($parentValue, $step2Childs = [], $option)
    {
        if (!$parentValue) {
            return false;
        }

        if (is_array($step2Childs) && count($step2Childs)) {
            $i      = 0;
            $ii     = 0;
            $iii    = 0;
            foreach ($step2Childs as $key2 => $step3Childs) :
                if (is_array($step3Childs) && count($step3Childs)) {
                    $grandChildren2 = $this->createType($parentValue, $key2, $key2, $parentValue, $i, $option);

                    foreach ($step3Childs as $key3 => $step4Childs):
                        if (is_array($step4Childs) && count($step4Childs)) {

                            $grandChildren3 = $this->createType($grandChildren2->id_code,$key3, $key3, $grandChildren2->id, $ii, $option);

                            foreach ($step4Childs as $step5Childs){

                                $this->createType($grandChildren3->id_code, $key3, $step5Childs, $grandChildren3->id, $iii, $option);

                            $iii++;
                            }
                        }else{
                            $this->createType($grandChildren2->id_code, $key3, $step4Childs, $grandChildren2->id, $ii, $option);
                        }
                    $ii++;
                    endforeach;
                } else {
                    $this->createType($parentValue, $key2, $step3Childs, $parentValue, $i, $option);
                }
                $i++;
            endforeach;
        }
    }

    // New Method for New Type Rework

    /**
     * @param array $arr
     */
    private function createMainType($arr)
    {
        if (is_array($arr) && count($arr)) {
            foreach($arr as $k => $val){
                Type::firstOrCreate(['id' => $k], [
                    'name' => $val,
                    'parent_id' => NULL,
                    'option' => true,
                    'category' => true
                ]);
            }
        }
    }

    protected function createChildrenType($value, $parentId, $option, $data = [])
    {
        $switchOption = $this->switchOption($option);

        $id = ['id' => $this->generateNewId($parentId)];

        $dataNew = array_merge(
            [
                'name' => $value,
                'parent_id' => $parentId
            ],
            $switchOption
        );

        return Type::firstOrCreate($id, $dataNew);
    }


    /**
     * @return \Model
     */
    protected function querySoftDelete()
    {
        $type = new Type;

        $query = $type->usesSoftDelete()
            ? $type::withTrashed()
            : $type::query();

            return $query;
    }

    /**
     * @param string $parentId
     *
     * @return \Model
     */
    protected function getLastCode($parentId)
    {
        return $this->querySoftDelete()
                ->where('id', 'like', $parentId.'__')
                ->orderBy('id', 'desc')
                ->first();
    }

    /**
     * @param string $lastId
     *
     * @return string
     */
    protected function findSuitableIdForChild($lastId = null)
    {
        $implode = [];

        $count = strlen($lastId);

        $divine = $count / 2;

        // force throw error when parent is not greater than or equal 4 lenth
        $this->throwCondition('parent_greater_than', ['parent_id' => $lastId]);

        if (is_integer($divine) && $divine) {
            for($i = 0; $i < $divine; $i++) {
                $strStartAt = $i == 0 ? 0 : $i * 2;

                if ($i == ($divine - 1)) {
                    $getFirstId = substr($lastId, $strStartAt, 2);
                    if ($getFirstId < 99) {
                        $implode[] = str_pad($getFirstId + 1, 2, '0', STR_PAD_LEFT);
                    } else {
                        $this->throwCondition('child_not_greater_than');
                    }
                } else {
                    $implode[] = substr($lastId, $strStartAt, 2);
                }
            }
        }

        return implode('', $implode);
    }

    /**
     * @param string $lastId
     *
     * @return string
     */
    protected function findSuitableIdForRoot()
    {

        $isRoot = $this->getLastCode('__');
        if ($isRoot) {
            $lastId = $isRoot->getKey();
        } else {
            return 'a101';
        }
        // force throw error when parent is not greater than or equal 4 lenth
        $this->throwCondition('parent_greater_than', ['parent_id' => $lastId]);
        // a101: firstTwoDigit is a1
        $firstTwoDigit = substr($lastId, 0, 2);
        // a101: nextNumber is 01
        $nextNumber = substr($lastId, 2, 2);

        if ($nextNumber < 99) {

            return $firstTwoDigit.str_pad($nextNumber + 1, 2, "0", STR_PAD_LEFT);

        }

        return $this->isNextRootLetter($lastId);
    }

    public function isNextRootLetter($lastId)
    {
        $firstStr = substr($lastId, 0, 1);
        $secondStr = substr($lastId, 1, 1);
        if (in_array($secondStr, $this->listRootAllowNumber()) && $secondStr < 9) {
            $newLetter = $firstStr.($secondStr + 1);
        } else {
            $nextLetter = $this->listRootAllowString($firstStr);
            if (!$nextLetter) {
                $this->throwCondition('root_exceed');
            } else {
                $newLetter = $nextLetter.'1';
            }
        }

        return $newLetter;
    }

    /**
     * @return array
     */
    public function listRootAllowNumber()
    {
        return [1, 2, 3, 4, 5, 6, 7, 8, 9];
    }

    /**
     * @param string $startLetter
     *
     * @return mixed
     */
    public function listRootAllowString($startLetter = false)
    {

        $aZ = collect([
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'q',
            'r',
            's',
            't',
            'u',
            'v',
            'w',
            'x',
            'y',
            'z',
        ]);

        $aZToArray = $aZ->toArray();

        if ($startLetter === false) {
            return $aZ;
        }

        if (!in_array($startLetter, $aZToArray)) {
            return false;
        }

        $aZ = $aZToArray[$aZ->search($startLetter) + 1] ?? false;

        return $aZ;
    }

    /**
     * @param string $parentId
     *
     * @return string
     */
    protected function generateNewId($parentId = null)
    {
        $id = null;

        if ($parentId) {
            // force throw error when parent is not greater than or equal 4 lenth
            $this->throwCondition('parent_greater_than', ['parent_id' => $parentId]);

            $isParent = $this->getLastCode($parentId);
            if ($isParent) {
                $id = $this->findSuitableIdForChild($isParent->getKey());
            } else {
                $id = $parentId.'01';
            }
        } else {
            $id = $this->findSuitableIdForRoot();
        }

        return $id;
    }

    protected function createDynamicChildrenType($parentId, $children = [], $option, $data = [])
    {
        $type = new Type;

        if (is_array($children) && count($children)) {
            foreach ($children as $key => $value) :
                if (is_array($value) && count($value)) {
                    $parent = $this->createChildrenType($key, $parentId, $option, $data);
                    // recursive when value is array
                    $this->createDynamicChildrenType($parent->id, $value, $option, $data);
                } else {
                    $parent = $this->createChildrenType($value, $parentId, $option, $data);
                }
            endforeach;
        }
    }

    /**
     * @param array $arr
     */
    private function ifRootParentNotFoundCreateAndDeleteChild($arr){
        $type = new Type;
        $arr = $type->depthOne($arr);

        $this->createMainType($arr);
        $onlyIds = collect($arr)->keys()->toArray();
        $this->querySoftDelete()->whereIn('parent_id', $onlyIds)->forceDelete();
    }

    /**
     * @param string $option
     *
     * @return array
     */
    public function switchOption($option = 'all')
    {
        $data = [
            'option' => 0,
            'category' => 0
        ];

        switch ($option) {
            case "all":
                $data = [
                    'option' => 1,
                    'category' => 1
                ];
            break;

            case "option":
                $data = [
                    'option' => 1,
                    'category' => 0
                ];
            break;

            default:
                $data = [
                    'option' => 0,
                    'category' => 1
                ];
            break;
        }

        return $data;
    }

    /**
     * @param string $operation
     * @param array $data
     *
     * @return throw
     */
    protected function throwCondition($operation = null, $data = [])
    {
        switch ($operation) {
            case "parent_greater_than":
                if (strlen($data['parent_id']) < 4) {
                    throw new \Exception("Type code not supported root less than 4 length");
                }
            break;

            case "child_not_greater_than":
                throw new \Exception("Type code not supported child greater than 99");
            break;

            case "root_exceed":
                throw new \Exception("Type code not supported exceed z9");
            break;
        }
    }

    protected function checkIfHaveParentAndCreate($arr){
        foreach($arr as $k => $val){
            $checkParent = Type::where('id', $k)->first();
            if(!$checkParent){
                Type::firstOrCreate([
                    'id' => $k,
                    'name' => $val['name'],
                    'name_khm' => $val['name_khm'] ? $val['name_khm'] : $val['name'],
                    'code' => $val['name'],
                    'parent_id' => 0,
                    'option' => true,
                    'category' => true
                ]);
            }
        }
    }

    protected function runLooping($parentValue, $children = [], $option)
    {
        if (!$parentValue) {
            return false;
        }

        $option_check = 0;
        $category_check = 0;

        if ($option == 'option') {
            $option_check = 1;
        } else {
            $category_check = 1;
        }

        if (is_array($children) && count($children)) {
            foreach ($children as $key => $value) :
                $this->checkChild($value, $parentValue, $option_check, $category_check);
            endforeach;
        }
    }

    protected function checkChild($value, $parentValue, $option_check, $category_check)
    {
        if (array_key_exists('child', $value) && is_array($value['child']) && count($value['child'])) {
            $pparent = $this->firstOrCreateType($value, $parentValue, $option_check, $category_check);

            foreach ($value['child'] as $kk => $vv) :
                $this->checkChild($vv, $pparent->id, $option_check, $category_check);
            endforeach;
        } else {
            $this->firstOrCreateType($value, $parentValue, $option_check, $category_check);
        }
    }

    protected function firstOrCreateType($value, $parentValue, $option_check, $category_check)
    {
        return Type::firstOrCreate([
            'name' => $value['name'],
            'name_khm' => $value['name_khm'] ? $value['name_khm'] : $value['name'],
            'code' => $value['code'] ? $value['code'] : $value['name'],
            'parent_id' => $parentValue,
            'option' => $option_check,
            'category' => $category_check
        ]);
    }

    protected function forceDeleteWhereParentId($parentIds)
    {
        Type::whereIn('parent_id', $parentIds)->forceDelete();
    }
}
