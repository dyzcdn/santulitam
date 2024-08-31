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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('theme_id');
            $table->unsignedBigInteger('peleton_id');
            $table->timestamp('check_in')->useCurrent();
            // $table->timestamp('check_out')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            // Menambahkan foreign key (opsional, sesuaikan dengan skema database Anda)
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->foreign('peleton_id')->references('id')->on('peletons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
