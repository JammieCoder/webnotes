<?php

namespace App\Models;

use App\Observers\NoteObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([NoteObserver::class])]

class Note extends Model
{
    use HasFactory;

    protected $fillable = ["filename", "week", "module_id"];

    public function content(){
        return Storage::get($this->filename);
    }

    public function topics(): BelongsToMany{
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function module(): BelongsTo{
        return $this->belongsTo(Module::class);
    }
}
