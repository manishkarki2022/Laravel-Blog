<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','excerpt','description','status','user_id','category_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tag');
    }
}
