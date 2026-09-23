<?php
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', [WeatherController::class, 'index']);
Route::get('/city/{cityName}', [WeatherController::class, 'show']);

Route::get('/generate-sitemap', function () {
    $sitemap = Sitemap::create();

    // 1. Add the homepage
    $sitemap->add(Url::create('/')->setPriority(1.0));

    // 2. Add your weather cities manually
    $cities = ['dublin', 'cork', 'galway', 'limerick', 'waterford', 'donegal', 'kerry'];

    foreach ($cities as $cityName) {
        $sitemap->add(
            Url::create("/city/{$cityName}")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8)
        );
    }

    // Write to public folder
    $sitemap->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated successfully! You can find it at /sitemap.xml';
});