<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportPhoto::whereNotNull('id')->delete();

        $report = Report::first();

        $reportPhotos = [
            ['caption' => "Photo de l'incident depuis la rue principale"],
            ['caption' => "Vue rapprochée de la zone touchée"],
            ['caption' => "Image montrant l'étendue des dégâts"],
        ];

        foreach ($reportPhotos as $photo) {
            ReportPhoto::create([
                'caption' => $photo['caption'],
                'report_uuid' => $report?->uuid,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}
