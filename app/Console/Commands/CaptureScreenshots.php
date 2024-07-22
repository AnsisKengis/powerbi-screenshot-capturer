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
            "powerbi_pardota_produkcija" => "https://app.powerbi.com/view?r=eyJrIjoiODQ2ZDVlYTctNGYwNi00MzIxLTkyMmMtOGNjOTg5MDQ3OTE4IiwidCI6ImE2YzkwNzQ3LTFiOWYtNDkyYi1iYzE3LTQ3ZTkxNGMzMmJhNyIsImMiOjh9"
        ];

        $storagePath = storage_path('app/public/screenshots');

        // Create the directory if it doesn't exist
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        foreach ($urls as $fileName => $url) {
            $timestamp = now()->format('Ymd-His');
            $filename = "{$timestamp}_" . parse_url($url, PHP_URL_QUERY) . ".png";
            $filePath = $storagePath . '/' . $filename;

            Browsershot::url($url)
                ->waitUntilNetworkIdle()
                ->save($filePath);

            // Save to S3 if needed
            // Storage::disk('s3')->put("screenshots/{$filename}", file_get_contents($filePath));
        }

        $this->info('Screenshots captured successfully!');
    }
}
