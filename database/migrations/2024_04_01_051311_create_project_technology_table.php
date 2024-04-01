<?php

use App\Models\Technology;
use App\Models\Project;
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
        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('project_id');
            // $table->unsignedBigInteger('technology_id');
            // $table->foreign('project_id')->references('id')->constrained()->onDelete('cascade');
            // $table->foreign('technology_id')->references('id')->constrained()->onDelete('cascade');
            
            $table->foreignIdFor(Project::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Technology::class)->constrained()->cascadeOnDelete();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
