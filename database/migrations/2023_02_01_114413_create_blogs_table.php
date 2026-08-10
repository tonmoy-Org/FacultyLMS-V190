<?php

use App\Models\Blog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('blog_category_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('image_media_id')->nullable();
            $table->text('banner')->nullable();
            $table->unsignedBigInteger('banner_media_id')->nullable();
            $table->bigInteger('total_view')->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1=featured, 0=no featured');
            $table->dateTime('published_date')->nullable();
            $table->tinyInteger('is_newspaper')->default(1)->comment('1=newspaper, 0=Not newspaper');
            $table->string('status')->default('published')->comment('published, draft, pending');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'title'             => 'The Future of Online Learning in 2026',
                'short_description' => 'Explore the upcoming trends in e-learning, from artificial intelligence driven personalized paths to immersive virtual classrooms.',
                'description'       => 'The e-learning landscape is rapidly evolving. With advancements in AI and virtual reality, education is becoming more accessible and engaging than ever before. In this article, we dive deep into the technologies that are shaping the future of education and how institutions can adapt.',
                'user_id'           => 1,
                'blog_category_id'  => 1,
                'status'            => 'published',
                'slug'              => Str::slug('The Future of Online Learning in 2026'),
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'Top 10 Programming Languages to Learn',
                'short_description' => 'Discover the most in-demand programming languages that will help you land a job in the tech industry this year.',
                'description'       => 'Choosing the right programming language to learn can be daunting. From Python to Go, we break down the top languages based on industry demand, salary potential, and ease of learning. Whether you are a beginner or an experienced developer, this guide will help you decide your next learning goal.',
                'user_id'           => 1,
                'blog_category_id'  => 1,
                'status'            => 'published',
                'slug'              => Str::slug('Top 10 Programming Languages to Learn'),
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'Balancing Work and Online Studies',
                'short_description' => 'Practical tips and strategies for managing a full-time job while pursuing your online degree or certification.',
                'description'       => 'Juggling work, personal life, and studies requires excellent time management skills. In this post, we share actionable advice from successful adult learners on how to create a study schedule, avoid burnout, and stay motivated throughout your educational journey.',
                'user_id'           => 1,
                'status'            => 'published',
                'slug'              => Str::slug('Balancing Work and Online Studies'),
                'blog_category_id'  => 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        Blog::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
