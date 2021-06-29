<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable, \Illuminate\Auth\MustVerifyEmail, \Illuminate\Auth\Passwords\CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','student_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'division_unit' => 'float'
    ];
    public function quizzes(){
        return $this->hasMany(Quiz::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class, 'id');
    }
    public function completedQuizzes(){
        return $this->hasMany(UserQuiz::class);
    }
    public function getPathAttribute(){
        return route('user.profile', ['user' => $this->attributes['id']]);
    }

    public function getDivisionUnitAttribute()
    {
        return $this->attributes['division_unit'];
    }
}
