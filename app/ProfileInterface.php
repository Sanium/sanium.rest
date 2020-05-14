<?php


namespace App;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface ProfileInterface
{
    public function user(): BelongsTo;
}
