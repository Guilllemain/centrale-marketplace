<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTree extends Model
{
    private $category;
    private $children;

    public function __construct($data)
    {
        $this->category = new Category($data['category']);
        $this->children = self::buildCollection($data['children']);
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public static function buildCollection($data)
    {
        $collection = array_map(static function ($category) {
            return new self($category);
        }, $data);

        // usort($collection, static function (CategoryTree $itemA, CategoryTree $itemB): int {
        //     return $itemA->getCategory()->getPosition() <=> $itemB->getCategory()->getPosition();
        // });

        return $collection;
    }
}
