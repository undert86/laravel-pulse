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
    const TYPE_STUDENT = 0;
    const TYPE_TEACHER = 1;
    const TYPE_ADMIN = 2;

    public function getFullNameAttribute()
    {
        return trim($this->LASTNAME . ' ' . $this->FIRSTNAME . ' ' . $this->MIDDLENAME);
    }

    public function isAdmin()
    {
        return $this->type == self::TYPE_ADMIN;
    }

    public function isTeacher()
    {
        return $this->type == self::TYPE_TEACHER;
    }

    public function isStudent()
    {
        return $this->type == self::TYPE_STUDENT;
    }
}
