<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformAchievement extends Model
{
    use HasFactory;

    protected $table = 'perform_achievement';
    protected $guarded = [];

    public function assessment()
    {
        return $this->hasOne(Assessment::class, 'id', 'aspect_id');
    }

    public function assessmentBelongs()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }
}
