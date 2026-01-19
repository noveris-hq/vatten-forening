<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Copy data from uploads to documents
        $uploads = DB::table('uploads')->get();

        foreach ($uploads as $upload) {
            DB::table('documents')->insert([
                'title' => $upload->filename,
                'filename' => $upload->filename,
                'path' => $upload->path,
                'category' => $upload->category,
                'description' => 'Migrated from uploads',
                'mime_type' => $upload->mime_type,
                'size' => $upload->size,
                'uploaded_by' => $upload->uploaded_by,
                'members_only' => true,
                'created_at' => $upload->created_at,
                'updated_at' => $upload->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove migrated documents
        DB::table('documents')->where('description', 'Migrated from uploads')->delete();
    }
};
