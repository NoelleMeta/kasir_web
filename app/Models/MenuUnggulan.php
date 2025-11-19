<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

        if ($this->gambar) {
            // Jika path sudah dimulai dengan http, gunakan langsung
            if (strpos($this->gambar, 'http') === 0) {
                return $this->gambar;
            }
            // Jika path sudah dimulai dengan storage/, gunakan asset langsung
            if (strpos($this->gambar, 'storage/') === 0) {
                return asset($this->gambar);
            }
            // Jika path dimulai dengan images/, tambahkan prefix storage/
            if (strpos($this->gambar, 'images/') === 0) {
                return asset('storage/' . $this->gambar);
            }
            // Default: gunakan Storage::url untuk path dari storage/app/public
            return Storage::url($this->gambar);
        }

        return $defaultPath ? asset($defaultPath) : '';
    }
}
