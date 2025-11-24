<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'label',
    ];

    /**
     * Get setting value by key
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Check if value is base64 image data
     */
    public static function isBase64Image($value)
    {
        return $value && strpos($value, 'data:image') === 0;
    }

    /**
     * Get image source (base64 or asset path)
     */
    public static function getImageSrc($value, $defaultPath = null)
    {
        if (self::isBase64Image($value)) {
            return $value; // Return base64 data URI directly
        }
        
        if (!$value) {
            return $defaultPath ? asset($defaultPath) : '';
        }
        
        // Jika path sudah dimulai dengan http:// atau https://, gunakan langsung
        if (strpos($value, 'http://') === 0 || strpos($value, 'https://') === 0) {
            return $value;
        }
        
        // Jika path sudah dimulai dengan storage/, gunakan asset langsung
        if (strpos($value, 'storage/') === 0) {
            return asset($value);
        }
        
        // Jika path dimulai dengan images/, tambahkan prefix storage/
        if (strpos($value, 'images/') === 0) {
            return asset('storage/' . $value);
        }
        
        // Default: gunakan asset dengan value langsung
        return asset($value);
    }

    /**
     * Set setting value by key
     */
    public static function setValue($key, $value, $type = 'text', $label = null)
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'label' => $label ?? ucfirst(str_replace('_', ' ', $key)),
            ]
        );
    }
}
