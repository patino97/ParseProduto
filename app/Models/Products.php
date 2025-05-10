<?php

namespace App\Models;

use App\Filters\ProductsFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Products extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    protected string $default_filters = ProductsFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'status', 
        'imported_t',
        'url',
        'creator',
        'created_t',
        'last_modified_t',
        'product_name',
        'quantity',
        'brands',
        'categories',
        'labels',
        'cities',
        'purchase_places',
        'stores',
        'ingredients_text',
        'traces',
        'serving_size',
        'serving_quantity',
        'nutriscore_score',
        'nutriscore_grade',
        'main_category',
        'image_url',
    ];

}
