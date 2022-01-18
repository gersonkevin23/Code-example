<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function students() {
        return $this->belongsToMany(Course::class);
    }

    public function courses($studentId) {
        return self::with('purchasedCourses')->findOrFail($studentId);
    }

    public function totalCourses($studentId) {
        $student = self::findOrFail($studentId);
        $data['totalCourses'] = $student->purchasedCourses()->count();
        $data['courses'] = $student->purchasedCourses;
        return $data;
    }
}
