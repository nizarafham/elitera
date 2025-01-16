<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'material_id',
        'video_url',
        'title',
    ];
    
    public function material()
    {
        return $this->belongsTo(Material::class); // Relasi banyak ke satu dengan Material
    }
}
