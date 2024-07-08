<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessment_aspect';
    protected $guarded = [];

    public function performAchievement()
    {
        return $this->hasMany(PerformAchievement::class, 'aspect_id', 'id');
    }
}
