<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    // cast
    protected $casts = [
        'value' => 'array',
    ];


    // get setting by key
    public static function getByKey($key)
    {
        $setting = self::where('key', $key)->first();

        if ($setting) {
            return $setting->value;
        }

        return null;
    }

    // set setting by key
    public static function set($key, $value)
    {
        $setting = self::where('key', $key)->first();

        if ($setting) {
            $setting->value = $value;
            $setting->save();
        } else {
            self::create([
                'key' => $key,
                'value' => $value,
            ]);
        }
    }

    // get all settings

    public static function getAll()
    {
        $settings = self::all();

        $data = [];

        foreach ($settings as $setting) {
            $data[$setting->key] = $setting->value;
        }

        return $data;
    }

    // get all settings by group

    public static function getAllByGroup($group)
    {
        $settings = self::where('group', $group)->get();

        $data = [];

        foreach ($settings as $setting) {
            $data[$setting->key] = $setting->value;
        }

        return $data;
    }

    // get all settings by group

    public static function getAllByGroupAndKey($group, $key)
    {
        $settings = self::where('group', $group)->where('key', $key)->get();

        $data = [];

        foreach ($settings as $setting) {
            $data[$setting->key] = $setting->value;
        }

        return $data;
    }
}
