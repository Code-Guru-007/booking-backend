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
        Schema::create('widget_gift', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('widget_flow_id');
            $table->foreign('widget_flow_id')->references('id')->on('widget_flow')->onDelete('cascade');
            $table->index('widget_flow_id');

            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_show')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widget_gift');
    }
};
