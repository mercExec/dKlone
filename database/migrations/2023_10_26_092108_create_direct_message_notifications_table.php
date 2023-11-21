<?php

use App\Models\Conversation;
use App\Models\User;
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
        Schema::create('direct_message_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Conversation::class)->onDelete('cascade');
            $table->foreignIdFor(User::class, 'sender_id');
            $table->foreignIdFor(User::class, 'recipient_id');
            $table->integer('counter')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_message_notifications');
    }
};
