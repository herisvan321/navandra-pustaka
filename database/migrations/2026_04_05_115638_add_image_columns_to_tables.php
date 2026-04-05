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
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('status');
            }
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('company_profiles', 'logo_path')) {
                $table->string('logo_path')->nullable()->after('email');
            }
            if (!Schema::hasColumn('company_profiles', 'instagram_url')) {
                $table->string('instagram_url')->nullable()->after('logo_path');
            }
            if (!Schema::hasColumn('company_profiles', 'facebook_url')) {
                $table->string('facebook_url')->nullable()->after('instagram_url');
            }
            if (!Schema::hasColumn('company_profiles', 'twitter_url')) {
                $table->string('twitter_url')->nullable()->after('facebook_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['cover_image']);
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn(['logo_path', 'instagram_url', 'facebook_url', 'twitter_url']);
        });
    }
};
