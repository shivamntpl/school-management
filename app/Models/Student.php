<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $fillable = [
        'id','student_name','father_name','mother_name','local_guardian_name','photo',
        'village','post','ps','district','pin',
        'dob','age','bpl','religion',
        'mother_tongue','caste','sex',
        'class_id','disease','vehicle',
        'aadhaar_number','vehicle_number','details',
        'reg_no','sr_no',
        'admission_type','amount','date_of_admission','age_wise',
        'monthly','total_for_year','discount','after_discount','aadhaar_file',
        'birth_certificate',
    ];

    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function totalPaid()
    {
        return $this->payments()->sum('amount');
    }

    public function dueFees()
    {
        return $this->total_fees - $this->totalPaid();
    }

    
    public function fees()
    {
        return $this->hasMany(StudentFee::class);
    }


    public function classData()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    
}