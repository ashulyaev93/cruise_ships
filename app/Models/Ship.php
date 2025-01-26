<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'spec', 'description', 'ordering', 'state'];

    public function cabinCategories()
    {
        return $this->hasMany(CabinCategory::class);
    }

    public function gallery()
    {
        return $this->hasMany(ShipGallery::class)->orderBy('ordering');
    }
}
