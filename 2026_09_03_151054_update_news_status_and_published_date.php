<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE news
            MODIFY status ENUM(
                'draft',
                'pending',
                'published',
                'rejected'
            ) NOT NULL DEFAULT 'draft'
        ");

        DB::statement("
            ALTER TABLE news
            MODIFY published_date DATE NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE news
            MODIFY status ENUM(
                'draft',
                'published'
            ) NOT NULL DEFAULT 'draft'
        ");

        DB::statement("
            ALTER TABLE news
            MODIFY published_date DATE NOT NULL
        ");
    }
};