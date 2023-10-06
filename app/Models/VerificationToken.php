<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'token',
        'expires_at',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setTokenAttribute($value)
    {
        // FIXME: do we need hashing at all?
        $this->attributes['token'] = md5($value);
    }
}
