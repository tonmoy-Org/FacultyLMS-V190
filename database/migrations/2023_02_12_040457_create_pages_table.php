<?php

use App\Models\Page;
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('type', 100)->nullable();
            $table->string('link')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('meta_image_id')->nullable();
            $table->text('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->timestamps();
        });

        $data = [
            [
                'id'               => 404,
                'title'            => 'Page Not Found.',
                'content'          => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please return to the homepage.',
                'type'             => 'error_page_404',
                'link'             => '#',
                'meta_title'       => 'Page not found',
                'meta_keywords'    => 'not found, 404',
                'meta_description' => 'The requested page could not be found.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id'               => 403,
                'title'            => 'Permission Denied.',
                'content'          => 'You do not have permission to access this resource. If you believe this is an error, please contact support.',
                'type'             => 'error_page_403',
                'link'             => '#',
                'meta_title'       => 'Permission Denied',
                'meta_keywords'    => 'Permission Denied, 403',
                'meta_description' => 'You do not have permission to access this page.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id'               => 500,
                'title'            => 'Internal Server Error.',
                'content'          => 'An unexpected condition was encountered by the server that prevented it from fulfilling the request. We are working to resolve it.',
                'type'             => 'error_page_500',
                'link'             => '#',
                'meta_title'       => 'Internal Server Error',
                'meta_keywords'    => 'Server Error, 500',
                'meta_description' => 'An internal server error occurred.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        Page::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
