<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeActivity extends Model
{
    protected $fillable = [
        'subject_id',
        'type',
        'grade',
        'date',
    ];

    protected $casts = [
        'subject_id' => 'integer',
        'grade' => 'decimal:2',
        'date' => 'date',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
