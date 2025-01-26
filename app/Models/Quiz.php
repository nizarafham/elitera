<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'video_id',
        'question',
        'options',
        'correct_answer',
        ];
        
        protected $casts = [
        'options' => 'array',
        ];
        
        public function video()
{
    return $this->belongsTo(Video::class);
}
}
