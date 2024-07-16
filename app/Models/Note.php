<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    public function module(): BelongsTo{
        return $this->belongsTo(Module::class);
    }

    public function topics(): BelongsToMany{
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}
