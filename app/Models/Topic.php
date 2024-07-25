<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'module_id'];

    public function module(): BelongsTo{
        return $this->belongsTo(Module::class);
    }

    public function notes(): BelongsToMany{
        return $this->belongsToMany(Note::class)->withTimestamps();
    }
}
