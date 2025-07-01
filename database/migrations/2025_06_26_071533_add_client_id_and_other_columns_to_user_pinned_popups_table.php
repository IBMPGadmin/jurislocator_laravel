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
        Schema::table('user_pinned_popups', function (Blueprint $table) {
            // Add client_id column
            if (!Schema::hasColumn('user_pinned_popups', 'client_id')) {
                $table->unsignedBigInteger('client_id')->after('user_id');
                $table->index(['user_id', 'client_id']);
            }
            
            // Add part column
            if (!Schema::hasColumn('user_pinned_popups', 'part')) {
                $table->string('part')->nullable()->after('section_id');
            }
            
            // Add division column
            if (!Schema::hasColumn('user_pinned_popups', 'division')) {
                $table->string('division')->nullable()->after('part');
            }
            
            // Add popup_title column (different from section_title)
            if (!Schema::hasColumn('user_pinned_popups', 'popup_title')) {
                $table->string('popup_title')->nullable()->after('popup_content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_pinned_popups', function (Blueprint $table) {
            $table->dropColumn(['client_id', 'part', 'division', 'popup_title']);
            $table->dropIndex(['user_id', 'client_id']);
        });
    }
};
