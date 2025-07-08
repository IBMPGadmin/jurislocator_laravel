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
        // Add client_id to user_pinned_popups table if it doesn't exist
        if (Schema::hasTable('user_pinned_popups')) {
            Schema::table('user_pinned_popups', function (Blueprint $table) {
                if (!Schema::hasColumn('user_pinned_popups', 'client_id')) {
                    $table->foreignId('client_id')->nullable()->constrained('client_table')->onDelete('cascade')->after('user_id');
                }
                if (!Schema::hasColumn('user_pinned_popups', 'part')) {
                    $table->string('part', 100)->nullable()->after('section_id');
                }
                if (!Schema::hasColumn('user_pinned_popups', 'division')) {
                    $table->string('division', 100)->nullable()->after('part');
                }
                if (!Schema::hasColumn('user_pinned_popups', 'popup_title')) {
                    $table->string('popup_title', 255)->nullable()->after('section_title');
                }
            });
        }

        // Create user_personal_popups table for user-only popup records
        Schema::create('user_personal_popups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('category_id');
            $table->string('section_id', 100);
            $table->string('part', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('section_title', 255)->nullable();
            $table->string('popup_title', 255)->nullable();
            $table->text('popup_content')->nullable();
            $table->string('table_name', 100)->nullable();
            $table->timestamp('pinned_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('category_id');
            $table->index('section_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop user_personal_popups table
        Schema::dropIfExists('user_personal_popups');
        
        // Remove added columns from user_pinned_popups
        if (Schema::hasTable('user_pinned_popups')) {
            Schema::table('user_pinned_popups', function (Blueprint $table) {
                if (Schema::hasColumn('user_pinned_popups', 'client_id')) {
                    $table->dropForeign(['client_id']);
                    $table->dropColumn('client_id');
                }
                if (Schema::hasColumn('user_pinned_popups', 'part')) {
                    $table->dropColumn('part');
                }
                if (Schema::hasColumn('user_pinned_popups', 'division')) {
                    $table->dropColumn('division');
                }
                if (Schema::hasColumn('user_pinned_popups', 'popup_title')) {
                    $table->dropColumn('popup_title');
                }
            });
        }
    }
};
