<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
    ];

    public function gradeActivities()
    {
        return $this->hasMany(GradeActivity::class);
    }
}
