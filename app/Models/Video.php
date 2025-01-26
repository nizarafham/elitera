<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'material_id', 'course_id', 'video_url', 'title',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class); // Relasi banyak ke satu dengan Material
    }

    public function videoProgress()
    {
        return $this->hasMany(VideoProgress::class);
    }

    public function quiz()
{
    return $this->hasOne(Quiz::class);  // Assuming the foreign key is 'video_id' in the quizzes table
}

    public function getEmbedUrlAttribute()
{
    $url = $this->video_url; // Gunakan video_url
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
        $videoId = $matches[1];
        return "https://www.youtube.com/embed/" . $videoId;
    }
    return $url;
}

public function getVideoIdFromUrl()
{
    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
    return $matches[1] ?? null; // Gunakan video_url
}


}
