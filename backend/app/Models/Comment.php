<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'content',
        'account_id',
        'parent_comment_id',
        'post_id',
        'image',
        'like',
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }
}
