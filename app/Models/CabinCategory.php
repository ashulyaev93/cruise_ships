<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabinCategory extends Model
{
    protected $fillable = ['ship_id', 'vendor_code', 'title', 'type', 'description', 'photos', 'ordering', 'state'];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}
