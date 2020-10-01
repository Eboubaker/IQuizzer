<?php


namespace App;


use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(static function ($model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), (string) Str::random(static::$keyLength));
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}