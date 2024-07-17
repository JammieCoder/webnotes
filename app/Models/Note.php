<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Note extends Model
{
    use HasFactory;

    public function content(){
        return Storage::disk('local')->get($this->filename);
    }

    public function topics(): BelongsToMany{
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}
