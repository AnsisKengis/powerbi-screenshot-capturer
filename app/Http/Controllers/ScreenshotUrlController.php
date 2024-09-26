<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenshotUrl;

class ScreenshotUrlController extends Controller
{
    public function index()
    {
        $urls = ScreenshotUrl::all();
        return view('screenshot_urls.index', compact('urls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:screenshot_urls,name',
            'url' => 'required|url',
        ]);

        ScreenshotUrl::create($request->only('name', 'url'));

        return redirect()->route('screenshot_urls.index')->with('success', 'URL added successfully!');
    }

    public function destroy($id)
    {
        $urlEntry = ScreenshotUrl::findOrFail($id);
        $urlEntry->delete();

        return redirect()->route('screenshot_urls.index')->with('success', 'URL deleted successfully!');
    }
}
