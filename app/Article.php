<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function path()
    {
        return route('articles.show', $this);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); //user_id
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}

// an article has many tags 
// tag belongs to an article 

//learn laravel
//php, laravel, work, education
