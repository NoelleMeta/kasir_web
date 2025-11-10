<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuUnggulan extends Model
{
    protected $table = 'menu_unggulan';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'urutan',
    ];

    /**
     * Get menu by urutan
     */
    public static function getByUrutan($urutan)
    {
        return self::where('urutan', $urutan)->first();
    }

    /**
     * Check if gambar is base64 image data
     */
    public function isBase64Image()
    {
        return $this->gambar && strpos($this->gambar, 'data:image') === 0;
    }

    /**
     * Get image source (base64 or asset path)
     */
    public function getImageSrc($defaultPath = null)
    {
        if ($this->isBase64Image()) {
            return $this->gambar; // Return base64 data URI directly
        }
        return $this->gambar ? asset($this->gambar) : ($defaultPath ? asset($defaultPath) : '');
    }
}
