<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingEditCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'course_id',
        'name',
        'description',
        'sub_description',
        'price',
        'image_url',
        'level',
        'material_title',
        'material_description',
        'material_file_path',
        'video_data',
        'quiz_data',
    ];
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}