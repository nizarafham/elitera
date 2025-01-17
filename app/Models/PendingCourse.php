<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingCourse extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'pending_courses';

    // Define the fillable attributes
    protected $fillable = [
        'mentor_id',
        'name',
        'description',
        'sub_description',
        'price',
        'image_url',
        'level',
        'is_free',
        'material_title',
        'material_description',
        'material_file_path',
        'video_data',
    ];

    // Define the cast for video_data attribute to automatically decode JSON
    protected $casts = [
        'video_data' => 'array',
    ];

    // Define the relationship with the Mentor (assuming Mentor is a User)
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
