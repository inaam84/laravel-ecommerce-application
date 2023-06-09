<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
    ];

    public function get($key)
    {
    $setting = new self();
        $entry = $setting->where('key', $key)->first();
        if(!$entry)
        {
            return;
        }

        return $entry->value;
    }

    public function set($key, $value = null)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        Config::set('key', $value);
        if(Config::get($key) == $value)
        {
            return true;
        }

        return false;
    }

}
