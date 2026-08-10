<?php

use App\Models\SubjectLanguage;
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
        Schema::create('subject_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('lang', 10)->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
        $now  = now();

        $data = [
            [
                'title'            => 'Programming',
                'lang'             => 'en',
                'subject_id'       => 1,
                'meta_title'       => 'Programming',
                'meta_keywords'    => 'programming, coding',
                'meta_description' => 'Programming courses and tutorials.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Marketing',
                'lang'             => 'en',
                'subject_id'       => 2,
                'meta_title'       => 'Marketing',
                'meta_keywords'    => 'marketing, business',
                'meta_description' => 'Marketing strategies and principles.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Machine Learning',
                'lang'             => 'en',
                'subject_id'       => 3,
                'meta_title'       => 'Machine Learning',
                'meta_keywords'    => 'machine learning, ai',
                'meta_description' => 'Artificial intelligence and machine learning.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Mathematics',
                'lang'             => 'en',
                'subject_id'       => 4,
                'meta_title'       => 'Mathematics',
                'meta_keywords'    => 'mathematics, algebra',
                'meta_description' => 'Mathematics and algebra courses.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];
        SubjectLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_languages');
    }
};
