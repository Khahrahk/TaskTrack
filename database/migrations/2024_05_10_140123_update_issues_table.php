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
        Schema::table('issues', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Status::class,'status_id')->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Priority::class,'priority_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropForeign('status_id');
            $table->dropForeign('priority_id');
        });
    }
};
