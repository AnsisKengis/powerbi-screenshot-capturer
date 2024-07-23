<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class CaptureScreenshots extends Command
{
    protected $signature = 'screenshots:capture';
    protected $description = 'Capture screenshots of Power BI dashboards';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $urls = [
            "powerbi_vardadienas" => "https://app.powerbi.com/view?r=eyJrIjoiNTkzNDUwOTItMjM2OS00YWZlLWExMzctYmRjYWU2YmE3ZWJkIiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_pardota_produkcija_menesis" => "https://app.powerbi.com/view?r=eyJrIjoiODQ2ZDVlYTctNGYwNi00MzIxLTkyMmMtOGNjOTg5MDQ3OTE4IiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_pardota_produkcija_nedela" => "https://app.powerbi.com/view?r=eyJrIjoiOTdiZWQ4ZWUtNDNhMC00ZDUwLThkODgtZmJiMWFhNTQxNjdhIiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_pardota_produkcija_diena" => "https://app.powerbi.com/view?r=eyJrIjoiNGEzNjk1ZTUtZmQ2NS00YTVlLTljODAtMjE1OWVkNmE0MWFlIiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_pardota_produkcija_mebelu_cehs" => "https://app.powerbi.com/view?r=eyJrIjoiYWMzOWNmNzMtZDlhYy00YWMwLWI0ZjMtZjc5M2QzOTQzZDU5IiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_saimnieciska_darbiba" => "https://app.powerbi.com/view?r=eyJrIjoiOGViMmE2YTktMjkwNi00ODE4LWJlMzktMDg4MzVlNTZhZTNkIiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
            "powerbi_sarazota_produkcija_pa_mainam" => "https://app.powerbi.com/view?r=eyJrIjoiNDg4MmMxZjItNTdjNy00ZjIwLWJlYTctNjgyZDM0YWEyOTQ5IiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9",
        ];

        $storagePath = storage_path('app/public/screenshots');

        // Create the directory if it doesn't exist
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        foreach ($urls as $fileName => $url) {
            $filename = "{$fileName}.png";
            $filePath = $storagePath . '/' . $filename;

            Browsershot::url($url)
                ->waitUntilNetworkIdle()
                ->save($filePath);
        }

        $this->info('Screenshots captured successfully!');
    }
}
