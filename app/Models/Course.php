<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sub_description',
        'price',
        'image_url',
        'mentor_id',  // This will refer to the user_id of a mentor
        'level', 
        'status', 
        // 'rejection_reason'
    ];

    /**
     * The mentor (user) associated with the course.
     * This assumes 'mentor_id' refers to a user with 'usertype' as 'mentor'.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id')->where('usertype', 'mentor');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    /**
     * The transactions for the course.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'course_id');
    }

    /**
     * Get the top courses based on the number of transactions.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTopCourses($limit = 3)
    {
        // Eager load mentor and count transactions for sorting
        return Course::with('mentor')
        ->withCount('transactions')
        ->orderByRaw('transactions_count DESC, created_at DESC')
        ->limit($limit)
        ->get();

    }

    /**
     * Get the materials associated with the course.
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    

}
