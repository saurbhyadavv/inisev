<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'website_id'];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function sendLogs(): HasMany
    {
        return $this->hasMany(PostSendLog::class);
    }
};