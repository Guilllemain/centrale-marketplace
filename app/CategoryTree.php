<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTree extends Model
{
	private $category;
	private $children;
	protected $guarded = [];

	public function __construct($data = [])
    {
    	parent::__construct($data);
        $this->category = new Category((array) $data['category']);
        $this->children = self::buildCollection((array) $data['children']);
    }

    public static function buildCollection($categories)
    {
        $collection = array_map(static function ($category) {
            return new self((array) $category);
        }, $categories);

        // usort($collection, static function (CategoryTree $itemA, CategoryTree $itemB): int {
        //     return $itemA->getCategory()->getPosition() <=> $itemB->getCategory()->getPosition();
        // });

        // return $collection;
    }
}
