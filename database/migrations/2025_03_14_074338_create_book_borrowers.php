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
        Schema::create('book_borrowers', function (Blueprint $table) {
            $table->id('borrower_id');
            $table->integer('book_id');
            $table->string('name');
            $table->string('contact_info');
            $table->string('checkout_date');
            $table->string('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_borrowers');
    }
};
