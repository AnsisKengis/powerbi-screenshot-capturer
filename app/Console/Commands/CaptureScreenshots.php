<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

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

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $filePath = storage_path('app/urls.txt');
        $urls = $this->parseUrlsFromFile($filePath);

        foreach ($urls as $filename => $url) {
            $filename = "{$filename}.png";
            $filePath = $storagePath . '/' . $filename;

            Browsershot::url($url)
                ->waitUntilNetworkIdle()
                ->save($filePath);

            $this->info('Screenshot ' . $filename . ' captured successfully!');
        }

        $this->info('Screenshots captured successfully!');
    }

    private function parseUrlsFromFile($filePath)
    {
        $urls = [];
        $fileLines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($fileLines as $line) {
            [$key, $url] = explode('=', $line, 2);
            $urls[$key] = $url;
        }
        return $urls;
    }
}
