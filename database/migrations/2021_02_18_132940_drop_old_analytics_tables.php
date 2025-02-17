<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropOldAnalyticsTables extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('post_analytics');
        Schema::dropIfExists('tip_analytics');
        Schema::dropIfExists('video_analytics');
    }

    public function down(): void
    {
        // intentionally left blank
    }
}
