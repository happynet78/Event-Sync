<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

trait HandleTimezones
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getXCreateAtAttribute($value): Response
    {
        return $this->convertTimeZoneToUserTimezone($value);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected function convertTimeZoneToUserTimezone($value): response
    {
        $timezone = Auth::check() && Auth::user()->timezone ? Auth::user()->timezone : config('app.timezone');
        return Carbon::parse($value)->timezone($timezone)->format("Y-m-d H:i:s");
    }
}
