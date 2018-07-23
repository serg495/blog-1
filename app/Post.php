<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Auth;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = ['thumbnail'];

    protected $perPage = 10;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = $title;

        $this->slug = str_slug($title);
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isViewedBy(User $user)
    {
        return $this->views()->where('user_id', $user->id)->exists();
    }

    public function viewsCount()
    {
        return $this->views->count();
    }

    public function likesCount()
    {
        return $this->likes->count();
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('images')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                    ->width(900);
                $this->addMediaConversion('thumb')
                    ->width(200);
            });
    }
}
