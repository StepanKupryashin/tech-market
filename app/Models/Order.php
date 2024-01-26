<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // protected $fillable = ['user_id'];

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getAttributeTotalPrice()
    {
        return $this->products()->get()->sum('price');
    }

    public function scopeOrders(Builder $builder, int $userId)
    {
        $result = $builder->where(function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('products')->get();
        $result = $result->each(fn($i) => $i->price = collect($i->products)->sum('price'));
        return $result;
    }



}
