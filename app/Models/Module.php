<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function topics(): HasMany {
        return $this->hasMany(Topic::class);
    }

    public function notes(): HasMany {
        return $this->hasMany(Note::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
