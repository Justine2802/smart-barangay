<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('fee', 8, 2)->default(0.00);
            $table->boolean('requires_approval')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert some default document types
        DB::table('document_types')->insert([
            [
                'name' => 'Barangay Clearance',
                'description' => 'General purpose clearance from the barangay',
                'fee' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Certificate of Residency',
                'description' => 'Certifies that you are a resident of the barangay',
                'fee' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Permit',
                'description' => 'Required for operating a business in the barangay',
                'fee' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};