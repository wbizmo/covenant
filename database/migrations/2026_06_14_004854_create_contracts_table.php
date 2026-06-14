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
        Schema::create('contracts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

    $table->string('title');
    $table->string('counterparty');

    $table->decimal('value', 15, 2)->nullable();

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->date('renewal_date')->nullable();

    $table->enum('status', [
        'draft',
        'active',
        'expiring',
        'expired'
    ])->default('active');

    $table->string('document_path')->nullable();

    $table->longText('description')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
