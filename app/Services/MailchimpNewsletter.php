<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements NewsLetter
{
    public function __construct(protected ApiClient $client)
    {
        // Using promoted properties in PHP8
        // https://stitcher.io/blog/constructor-promotion-in-php-8
        // https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscibers');

        // The client {$this->client} is coming from the service container initialised within the constructor
        // Service Container holds the client under AppServiceProvider.php
        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }
}
