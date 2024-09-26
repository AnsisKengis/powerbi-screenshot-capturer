<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenshotUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('screenshot_urls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screenshot_urls');
    }
}
