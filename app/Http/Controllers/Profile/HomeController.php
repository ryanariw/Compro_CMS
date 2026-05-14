<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('profile.home', [
            'setting' => Setting::first(),

            'services' => Service::where('is_active', true)
                ->latest()
                ->take(6)
                ->get(),

            'projects' => Project::where('is_active', true)
                ->latest()
                ->take(6)
                ->get(),

            'galleries' => Gallery::where('is_active', true)
                ->latest()
                ->take(6)
                ->get(),

            'products' => Product::where('is_active', true)
                ->with('images')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }
}