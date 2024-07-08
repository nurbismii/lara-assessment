<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluation';
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function performAchieve()
    {
        return $this->hasOne(PerformAchievement::class, 'id', 'perform_achieve_id');
    }

    public function performAchieveWithAssessment()
    {
        return $this->performAchieve()->with('assessmentBelongs');
    }
}
