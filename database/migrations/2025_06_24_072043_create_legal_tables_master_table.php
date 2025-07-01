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
        Schema::create('legal_tables_master', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('law_id')->nullable();
            $table->string('act_id')->nullable();
            $table->string('act_name')->nullable();
            $table->unsignedBigInteger('jurisdiction_id')->nullable();
            $table->string('act_name_1')->nullable();
            $table->string('act_name_2')->nullable();
            $table->string('act_name_3')->nullable();
            $table->string('legaldocument_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_tables_master');
    }
};
