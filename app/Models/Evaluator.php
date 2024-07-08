<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;

    protected $table = 'evaluator';
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    }
}
