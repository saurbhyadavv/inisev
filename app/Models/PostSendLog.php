<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostSendLog extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'subscription_id', 'sent_at'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
