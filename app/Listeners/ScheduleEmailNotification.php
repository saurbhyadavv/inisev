<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendSubscriptionEmail;
use App\Models\Subscription;

class ScheduleEmailNotification
{
    public function handle(PostCreated $event)
    {
        $post = $event->post;
        
        // Get subscribers in chunks for memory efficiency
        Subscription::where('website_id', $post->website_id)
            ->chunk(1000, function ($subscribers) use ($post) {
                foreach ($subscribers as $subscription) {
                    SendSubscriptionEmail::dispatch($post, $subscription);
                }
            });
    }
}