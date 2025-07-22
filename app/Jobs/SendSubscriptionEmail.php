<?php
namespace App\Jobs;

use App\Models\Post;
use App\Models\PostSendLog;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $subscription;

    public function __construct(Post $post, Subscription $subscription)
    {
        $this->post = $post;
        $this->subscription = $subscription;
    }

    public function handle()
    {
        // Check if email already sent to prevent duplicates
        $alreadySent = PostSendLog::where('post_id', $this->post->id)
            ->where('subscription_id', $this->subscription->id)
            ->exists();
            
        if ($alreadySent) {
            return;
        }

        // Send email
        Mail::raw($this->getEmailContent(), function ($message) {
            $message->to($this->subscription->email)
                    ->subject('New Post: ' . $this->post->title);
        });

        // Log the email send
        PostSendLog::create([
            'post_id' => $this->post->id,
            'subscription_id' => $this->subscription->id,
            'sent_at' => now(),
        ]);
    }

    protected function getEmailContent(): string
    {
        return "New post on {$this->post->website->name}:\n\n" .
               "Title: {$this->post->title}\n\n" .
               "Description: {$this->post->description}\n\n" .
               "Visit: {$this->post->website->url}";
    }
}