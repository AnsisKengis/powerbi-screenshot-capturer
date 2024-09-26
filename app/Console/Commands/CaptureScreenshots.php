<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;
use App\Models\ScreenshotUrl;

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
        $storagePath = storage_path('app/public/screenshots');

        // Ensure the directory exists
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        } else {
            // Delete all existing screenshots
            $this->deleteExistingScreenshots($storagePath);
            $this->info('All existing screenshots deleted successfully!');
        }

        $urls = ScreenshotUrl::all();

        foreach ($urls as $urlEntry) {
            $filename = "{$urlEntry->name}.png";
            $filePath = $storagePath . '/' . $filename;

            Browsershot::url($urlEntry->url)
                ->waitUntilNetworkIdle()
                ->save($filePath);

            $this->info('Screenshot ' . $filename . ' captured successfully!');
        }

        $this->info('All screenshots captured successfully!');
    }

    private function deleteExistingScreenshots($directory)
    {
        // Get all PNG files in the directory
        $files = glob($directory . '/*.png');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete the file
            }
        }
    }
}
