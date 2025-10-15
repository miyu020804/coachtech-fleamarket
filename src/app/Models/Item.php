<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ItemImage;
use App\Models\User;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id',
        'category_id',
        'title',
        'brand',
        'description',
        'price',
        'condition',
        'status',
        'stock',
    ];

    // 数値 → 日本語ラベル
    public const CONDITION_GOOD = 1; //　良好
    public const CONDITION_NO_MAJOR_DAMAGE = 2; // 目立った傷や汚れなし
    public const CONDITION_SOME_WEAR = 3; // やや傷や汚れあり
    public const CONDITION_POOR = 4; // 状態が悪い
    public const CONDITIONS = [
        self::CONDITION_GOOD => '良好',
        self::CONDITION_NO_MAJOR_DAMAGE => '目立った傷や汚れなし',
        self::CONDITION_SOME_WEAR => 'やや傷や汚れあり',
        self::CONDITION_POOR => '状態が悪い',
    ];
    protected $appends = ['condition_label'];
    public function getConditionLabelAttribute(): string
    {
        return self::CONDITIONS[$this->condition] ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            \App\Models\Category::class,
            'category_item'
        )
            ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ItemImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(\App\Models\ItemImage::class)->orderBy('sort_order');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }
}
