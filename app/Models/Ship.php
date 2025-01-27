<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'spec', 'description', 'ordering', 'state'];
    protected $casts = [
        'spec' => 'array'
    ];

    public function getDescriptionAttribute($value)
    {
        return html_entity_decode($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function cabinCategories()
    {
        return $this->hasMany(CabinCategory::class);
    }

    public function gallery()
    {
        return $this->hasMany(ShipGallery::class)->orderBy('ordering');
    }
}
