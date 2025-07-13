<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use DateTime;
use Exception;

class TimeCast implements CastsAttributes
{
    /**
     * Cast the given value from the database to a DateTime or formatted time string.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Cast the DB value (assumed string like "14:30:00") to a formatted time string (e.g. "14:30")
            $time = new DateTime($value);
            return $time->format('H:i'); // return only hours and minutes
        } catch (Exception $e) {
            // If error, return original value
            return $value;
        }
    }

    /**
     * Prepare the given value for storage in the database.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string|null
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Accept a string like "14:30" or "14:30:00" and format to "H:i:s" before saving
            $time = new DateTime($value);
            return $time->format('H:i:s');
        } catch (Exception $e) {
            // If error, return original value
            return $value;
        }
    }
}
