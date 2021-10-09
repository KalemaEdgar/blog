<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\NewsLetter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Add something for the NewsLetter to the Service Container
        // Key is Newsletter and it will create the Newsletter client and make it available
        // With this style, MailChimp is only defined here and if we want to swap it for ConvertKit, it all happens here only
        app()->bind(NewsLetter::class, function () {
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
