<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationHistory extends Model
{
    use HasFactory;

    protected $table = 'evaluation_history';
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'employee_id', 'employee_id')
            ->join('perform_achievement', 'perform_achievement.id', '=', 'evaluation.perform_achieve_id');
    }
}
