<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinCategory extends Model
{
    protected $fillable = ['ship_id', 'vendor_code', 'title', 'type', 'description', 'photos', 'ordering', 'state'];

    public function getDescriptionAttribute($value)
    {
        return html_entity_decode($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}
