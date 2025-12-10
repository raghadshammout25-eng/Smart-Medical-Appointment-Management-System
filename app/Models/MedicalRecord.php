<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
   


    use HasFactory;

    protected $primaryKey = 'medical_record_id';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'diagnosis',
        'treatment',
        'visit_date',
        'attachments'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }


}
