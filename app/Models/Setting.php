<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'key', 'value', 'group'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeWhereCompany($query)
    {
        return $query->where('company_id', request()->header('company'));
    }

    public static function setSettings($settings, $company_id, $group = 'general')
    {
        foreach ($settings as $key => $value) {
            self::updateOrCreate(
                [
                    'key' => $key,
                    'company_id' => $company_id,
                ],
                [
                    'key' => $key,
                    'company_id' => $company_id,
                    'value' => $value,
                    'group' => $group,
                ]
            );
        }
    }

    public static function getAllSettings($company_id)
    {
        return static::whereCompany($company_id)->get()->mapWithKeys(function ($item) {
            return [$item['key'] => $item['value']];
        });
    }

    public static function getSettings($settings, $company_id)
    {
        return static::whereIn('key', $settings)->whereCompany($company_id)
            ->get()->mapWithKeys(function ($item) {
                return [$item['key'] => $item['value']];
            });
    }

    public static function getSetting($key, $company_id)
    {
        $setting = static::whereKey($key)->whereCompany($company_id)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }

    public static function getSettingByGroup($group, $company_id)
    {
        $setting = static::whereGroup($group)->whereCompany($company_id)->get();

        if ($setting) {
            return $setting;
        } else {
            return null;
        }
    }
}
