<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->bigInteger('parent_id')->nullable();
            $table->text('icon')->nullable();
            $table->text('image')->nullable();
            $table->text('image_media_id')->nullable();
            $table->integer('position')->nullable();
            $table->integer('ordering')->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1=featured, 0=not feature');
            $table->integer('total_courses')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->string('type')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'id'               => 1,
                'title'            => 'Computer Science',
                'slug'             => Str::slug('Computer Science'),
                'parent_id'        => 0,
                'position'         => 1,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 1,
                'meta_title'       => 'Computer Science',
                'meta_keywords'    => 'Computer Science, IT, Programming',
                'meta_description' => 'Explore the world of Computer Science and Programming.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'id'               => 2,
                'title'            => 'Business Administration',
                'slug'             => Str::slug('Business Administration'),
                'parent_id'        => 0,
                'position'         => 2,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 1,
                'meta_title'       => 'Business Administration',
                'meta_keywords'    => 'Business, Management, Finance',
                'meta_description' => 'Learn essential business administration skills.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'id'               => 3,
                'title'            => 'Data Science',
                'slug'             => Str::slug('Data Science'),
                'parent_id'        => 0,
                'position'         => 3,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 0,
                'meta_title'       => 'Data Science',
                'meta_keywords'    => 'Data Science, Machine Learning, AI',
                'meta_description' => 'Master data science, machine learning, and AI.',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        Category::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catgeories');
    }
};
