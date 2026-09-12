<?php

use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::where('is_active', true)->withCount('services')->get();
    $popularServices = Service::where('is_active', true)->with('category')->take(6)->get();
    return view('welcome', compact('categories', 'popularServices'));
});
