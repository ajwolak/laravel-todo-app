<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->enum('status', ['to-do', 'in progress', 'done'])->default('to-do');
            $table->date('due_date');
            $table->string('access_token')->nullable();
            $table->dateTime('token_expiration')->nullable();
            $table->timestamps();
        });

        DB::table('tasks')->insert([
            'user_id' => 1,
            'name' => 'Task number 1',
            'description' => 'Sample task added during migration',
            'priority' => 'low',
            'status' => 'done',
            'due_date' => Carbon::tomorrow()->format('Y-m-d'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
