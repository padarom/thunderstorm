<?php

namespace Padarom\Thunderstorm\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;

    public $fillable = [
        'identifier', 'author', 'authorurl',
    ];
    
    public static function withIdentifier($identifier)
    {
        return self::where('identifier', $identifier)->first();
    }

    public function versions()
    {
        return $this->hasMany(PackageVersion::class);
    }

    public function localizedTags()
    {
        return $this->hasMany(LocalizedTag::class);
    }

    protected function localizedAttribute($attribute)
    {
        $locale = env('PREFERRED_LOCALE', 'en');
        $tags = $this->localizedTags()->where('tag', $attribute)->get();

        $sorted = $tags->sort(function ($a, $b) use ($locale) {
            // If element A is in our preferred locale, but B is not, sort it up.
            // Also sort it up, if A doesn't have a locale set and the locale of B is not the preferred one.
            if (
                ($a->language == $locale && $b->language != $locale)
                || (!$a->language && $b->language != $locale)
            ) {
                return -1;
            }

            if (
                ($b->language == $locale && $a->language != $locale)
                || (!$b->language && $a->language != $locale)
            ) {
                return 1;
            }

            return 0;
        });

        if (count($sorted)) {
            return $sorted->first();
        }

        return null;
    }

    public function getNameAttribute()
    {
        return $this->localizedAttribute('name');
    }

    public function getDescriptionAttribute()
    {
        return $this->localizedAttribute('description');
    }
}