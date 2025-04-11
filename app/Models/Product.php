<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, Sluggable;
    
    protected $fillable = [
        'name', 'slug', 'image', 'base_price', 'override_price',
        'override_start_date', 'override_end_date',
        'stock_quantity', 'description_en', 'description_es', 'tags',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getCurrentPriceAttribute()
{
    $today = Carbon::today();
    if (
        $this->override_price &&
        $this->override_start_date &&
        $this->override_end_date &&
        $today->between($this->override_start_date, $this->override_end_date)
    ) {
        return $this->override_price;
    }

    return $this->base_price;
}
}
