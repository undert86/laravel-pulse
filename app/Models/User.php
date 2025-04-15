<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'LASTNAME', 'FIRSTNAME', 'MIDDLENAME',
        'type', 'username', 'password',
        'phone', 'group_name'
    ];

    protected $hidden = [
        'password'
    ];

    // Типы пользователей

    const TYPE_TEACHER = 1;
    const TYPE_ADMIN = 2;



    public function isAdmin()
    {
        return $this->type == self::TYPE_ADMIN;
    }





    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id', 'ID');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'ID');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id', 'ID');
    }

}
