<?php

use App\Models\Module;
use App\Models\Note;
use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->unique();
            $table->unsignedTinyInteger('week');
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('note_topic', function(Blueprint $table){
            $table->foreignIdFor(Topic::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Note::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['topic_id', 'note_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_topics');
        Schema::dropIfExists('notes');
    }
};
