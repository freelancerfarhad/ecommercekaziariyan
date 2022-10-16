<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function favorite_to_user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(comment::class);
    }
    public function scopeApproved($query)
    {
       return $query->where('is_approved',1);
    }
    public function scopePublisted($query)
    {
       return $query->where('status',1);
    }
}
