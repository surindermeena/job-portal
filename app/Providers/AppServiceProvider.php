<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $address = DB::table('settings')->where('key', 'address')->value('value') ?? 'Default address';
        $phone = DB::table('settings')->where('key', 'phone')->value('value') ?? 'Default phone';
        $email = DB::table('settings')->where('key', 'email')->value('value') ?? 'default@example.com';
        $googleMap = DB::table('settings')->where('key', 'map')->value('value');

        // Decode JSON social links
        $socialLinksJson = DB::table('settings')->where('key', 'social_links')->value('value');
        $socialLinks = json_decode($socialLinksJson, true) ?? [];

        View::share([
            'footerAddress' => $address,
            'footerPhone' => $phone,
            'footerEmail' => $email,
            'footerSocialLinks' => $socialLinks,
            'googleMap' => $googleMap,
        ]);
    }
}
