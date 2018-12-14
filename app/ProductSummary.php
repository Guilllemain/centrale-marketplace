<?php

namespace App;

use App\Services\AbstractService;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;

class ProductSummary extends Model
{
    public function setMainImageAttribute($value)
    {
        $this->attributes['mainImage'] = $value['id'];
    }

    protected $guarded = [];
}
