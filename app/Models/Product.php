<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
    ];



    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


    public function scopeProducts(Builder $builder, array $products)
    {
        // return Product::whereIn('id', $products)->with('categories')->get();
        $result = [];
        foreach ($products as $i) {
            $product = Product::find($i);
            $product->categories;
            if (empty($product->conut)) {
                $product->count = 1;
            }
            if ($r = collect($result)->first(fn($j) => $j->id == $i)) {
                collect($result)->first(fn($j) => $j->id == $i)->count = $r->count ? $r->count + 1 : 1;
                continue;
            }
            $result[] = $product;
        }
        return $result;
    }
}
