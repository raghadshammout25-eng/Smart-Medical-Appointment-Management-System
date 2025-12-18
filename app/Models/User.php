<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $primaryKey = 'id';
     // لأن المفتاح الأساسي اسمه user_id مش id

    protected $fillable = ['name', 'email', 'password', 'phone', 'role'];


    protected $hidden = ['password','remember_token'];
    // علاقة One-to-One مع جدول المرضى
    public function patient()
    {
        return $this->hasOne(Patient::class);
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
