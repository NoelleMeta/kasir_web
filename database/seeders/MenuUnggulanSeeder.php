<?php

namespace Database\Seeders;

use App\Models\MenuUnggulan;
use Illuminate\Database\Seeder;

class MenuUnggulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample menu unggulan items
        $menuItems = [
            [
                'urutan' => 1,
                'nama' => 'Gulai Kepala Kambing',
                'deskripsi' => 'Kepala kambing utuh dimasak dengan bumbu gulai kaya rempah, menghasilkan cita rasa otentik yang melegenda.',
                'gambar' => 'images/menu_unggulan_1.jpg',
            ],
            [
                'urutan' => 2,
                'nama' => 'Gulai Kambing',
                'deskripsi' => 'Potongan daging kambing empuk dalam kuah gulai kental yang gurih dan sedikit pedas, resep turun-temurun.',
                'gambar' => 'images/menu_unggulan_2.jpg',
            ],
            [
                'urutan' => 3,
                'nama' => 'Sop Kambing',
                'deskripsi' => 'Sop bening dengan kaldu kambing yang ringan namun kaya rasa, disajikan dengan potongan daging dan tulang.',
                'gambar' => 'images/menu_unggulan_3.jpg',
            ],
            [
                'urutan' => 4,
                'nama' => 'Tongseng Kambing',
                'deskripsi' => 'Daging kambing empuk ditumis dengan bumbu tongseng khas, kol, dan tomat, memberikan rasa manis, gurih, dan pedas.',
                'gambar' => 'images/menu_unggulan_4.jpg',
            ],
        ];

        // Use updateOrCreate to allow re-running seeder without duplicates
        foreach ($menuItems as $item) {
            MenuUnggulan::updateOrCreate(
                ['urutan' => $item['urutan']],
                [
                    'nama' => $item['nama'],
                    'deskripsi' => $item['deskripsi'],
                    'gambar' => $item['gambar'],
                ]
            );
        }
    }
}
