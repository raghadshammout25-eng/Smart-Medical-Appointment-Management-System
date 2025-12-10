<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
     // لأن المفتاح الأساسي اسمه user_id مش id

    protected $fillable = ['name', 'email', 'password', 'phone', 'role'];
    
    // علاقة One-to-One مع جدول المرضى
    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id');
    }

    // علاقة One-to-One مع جدول الأطباء
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    // علاقة One-to-Many مع جدول الإشعارات
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
