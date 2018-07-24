<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{

    protected $fillable = ['title', 'summary', 'body'];

    use HasMediaTrait;

    protected $perPage = 10;

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function views(): HasMany
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

    public function isViewedByUser(User $user): bool
    {
        return $this->views()->where('user_id', $user->id)->exists();
    }

    public function isViewedByIp(string $ip): bool
    {
        return $this->views()->where('user_ip', $ip)->exists();
    }

    public function viewsCount(): int
    {
        return $this->views()->count();
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }

    public function registerMediaCollections(): void
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
