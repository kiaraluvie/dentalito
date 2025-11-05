<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Add slug as nullable first to avoid issues with existing data
            $table->string('slug')->nullable()->after('id');
            $table->boolean('is_active')->default(true)->after('photo');
            $table->softDeletes();

            // Audit fields
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->text('deleted_description')->nullable();
        });

        // Populate slug for existing records to ensure data integrity
        $patients = DB::table('patients')->whereNull('slug')->get();
        foreach ($patients as $patient) {
            $slug = Str::slug($patient->name . ' ' . $patient->lastname . '-' . uniqid());
            DB::table('patients')->where('id', $patient->id)->update(['slug' => $slug]);
        }

        // Now that slugs are populated, make the column unique and not nullable
        Schema::table('patients', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('is_active');
            $table->dropSoftDeletes();
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by', 'deleted_description']);
        });
    }
};
