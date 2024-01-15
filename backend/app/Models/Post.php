<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'headline',
        'content',
        'status',
        'view',
        'like',
        'unlike',
        'share',
        'except',
        'featured_image',
        'category_id',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
