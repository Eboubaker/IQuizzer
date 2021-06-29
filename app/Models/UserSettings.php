<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;
    protected $table = "users_settings";
    public $timestamps = false;
    public $guarded = [];
    /*--------PointsConversionUnit--------*/

    public function getPointsConversionUnitAttribute()
    {
        return floatval($this->attributes['points_conversion_unit']);
    }
    public function setPointsConversionUnitAttribute($value)
    {
        $this->attributes['points_conversion_unit'] = $value;
        $this->save();
    }

    /*--------PointsMultiplication--------*/

    public function getPointsMultiplicationAttribute()
    {
        return floatval($this->attributes['points_multiplication']);
    }
    public function setPointsMultiplicationAttribute($value)
    {
        $this->attributes['points_multiplication'] = $value;
        $this->save();
    }

    /*-------EmailNotificationsEnabled---------*/

    public function getEmailNotificationsEnabledAttribute()
    {
        return floatval($this->attributes['email_notifications']);
    }
    public function setEmailNotificationsEnabledAttribute($value)
    {
        $this->attributes['email_notifications'] = $value;
        $this->save();
    }

    /*----------------*/

    /*-------EmailNotificationsEnabled---------*/

    public function getProfileLockedAttribute()
    {
        return floatval($this->attributes['profile_locked']);
    }
    public function setProfileLockedAttribute($value)
    {
        $this->attributes['profile_locked'] = $value;
        $this->save();
    }

    /*----------------*/

}
