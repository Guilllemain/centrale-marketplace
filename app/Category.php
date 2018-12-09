<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function __construct($data)
    {
    	$this->id = $data->id;
    	$this->parentId = $data->parentId;
    	$this->name = $data->name;
    	$this->description = $data->description;
    	$this->slug = $data->slug;
    	// $this->image = isset($data->image) ? new Image($data->image) : null;
    	$this->position = $data->position;
    	$this->productCount = $data->productCount;
    	$this->seoTitle = $data->seoData->title ?? '';
    	$this->seoDescription = $data->seoData->description ?? '';
    	// $this->categoryPath = array_map(static function ($path) : CategorySummary {
    	//     return new CategorySummary($path);
    	// }, $data->categoryPath ?? []);
    }
}
