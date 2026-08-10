<?php

use App\Models\Subject;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('image')->nullable();
            $table->text('image_media_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->string('type')->default('course');
            $table->timestamps();
        });
        $now  = now();

        $data = [
            [
                'title'            => 'Programming',
                'slug'             => 'programming',
                'meta_title'       => 'Programming',
                'meta_keywords'    => 'programming, coding',
                'meta_description' => 'Programming courses and tutorials.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Marketing',
                'slug'             => 'marketing',
                'meta_title'       => 'Marketing',
                'meta_keywords'    => 'marketing, business',
                'meta_description' => 'Marketing strategies and principles.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Machine Learning',
                'slug'             => 'machine-learning',
                'meta_title'       => 'Machine Learning',
                'meta_keywords'    => 'machine learning, ai',
                'meta_description' => 'Artificial intelligence and machine learning.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Mathematics',
                'slug'             => 'mathematics',
                'meta_title'       => 'Mathematics',
                'meta_keywords'    => 'mathematics, algebra',
                'meta_description' => 'Mathematics and algebra courses.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];
        Subject::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
