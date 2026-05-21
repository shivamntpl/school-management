<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        'student_id',
        'month',
        'amount',
        'fine',
        'total_paid',
        'payment_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}