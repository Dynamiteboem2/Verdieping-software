<?php

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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->onDelete('set null');
            $table->string('status')->default('voorlopig'); // voorlopig/definitief/geannuleerd
            $table->boolean('is_paid')->default(false);
            $table->string('duo_name')->nullable();
            $table->string('duo_email')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->boolean('cancellation_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
