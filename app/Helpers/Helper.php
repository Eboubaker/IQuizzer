<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function topoint(float $point, float $maxpoint)
    {
        return round((Auth::user()->settings->pointsMultiplication ?? 1)
                            * (Auth::user()->settings->pointsConversionUnit ?? 20)
                            * ($point / $maxpoint)
                                , 1);
    }

    public static function mpointval()
    {
        return Auth::user()->settings->pointsConversionUnit;
    }
}