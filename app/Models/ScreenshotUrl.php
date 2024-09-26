<?php

// app/Models/ScreenshotUrl.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenshotUrl extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];
}
