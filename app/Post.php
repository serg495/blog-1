<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = $title;

        $this->slug = str_slug($title);
    }
}
