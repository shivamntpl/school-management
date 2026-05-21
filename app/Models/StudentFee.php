<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $fillable = [
        'student_id',
        'session',
        'fee_type',
        'amount',
        'fee_date',
        'remarks'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
