<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('offline_methods', ['video_source', 'video'])) {
            Schema::table('offline_methods', function (Blueprint $table) {
                $table->string('video_source')->nullable()->after('image');
                $table->text('video')->nullable()->after('video_source');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_methods', function (Blueprint $table) {
            $table->dropColumn(['video_source', 'video']);
        });
    }
};
