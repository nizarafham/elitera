<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $materials = Material::with('course')->get();
        foreach ($materials as $material) {
            Video::where('material_id', $material->id)->update([
                'course_id' => $material->course_id,
            ]);
        }
    }
}

