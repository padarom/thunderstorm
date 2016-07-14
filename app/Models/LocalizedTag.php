<?php

namespace Padarom\Thunderstorm\Models;

use Illuminate\Database\Eloquent\Model;

class LocalizedTag extends Model
{
    public $timestamps = false;

    public $fillable = [
        'tag', 'text', 'language',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function __toString()
    {
        return $this->text;
    }
}